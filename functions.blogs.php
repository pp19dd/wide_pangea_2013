<?php

define( VOA_DEFAULT_LOGO_URL, "http://blogs.voanews.com/wp-content/themes/wide_pangea_2013/setta.jpg" );

/**
 * Returns a list of installed themes
 * Transforms it for an easy name-to-slug lookup, since slug is used in meta option keys
 * @return mixed
 */
function voa_get_themes() {
	$themes = wp_get_themes();
	
	# $themes is a complex structure, but without a way to easily go from theme name to slug. 
	# instead, it's keyed from slug to complex. building a lookup table for later use:
	$theme_names_to_keys = array();
	foreach( $themes as $theme_key => $theme_data ) {
		$theme_names_to_keys[$theme_data->__get('name')] = $theme_key;
	}

	return( $theme_names_to_keys );
}


/**
 * Replacement for WP's get_option(), avoiding switch_to_blog()
 * @return mixed
 */
function voa_get_option( $blog_id = 0, $option_name, $simple = false ) {
	global $wpdb;
	
	$sql = sprintf(
		"select * from wp_%s_options where option_name='%s' limit 1",
		intval( $blog_id ),
		$wpdb->escape( $option_name )
	);

	$option = $wpdb->get_row( $sql );
	
	if( $simple == true ) return( $option->option_value );
	
	return( @unserialize( $option->option_value ) );
}
 

/**
 * Returns <image /> from html
 * @return mixed
 */
function voa_get_image($html) {
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $xpath = new DOMXPath($doc);
    
    $images = $xpath->query("//img");
    foreach( $images as $img ) {
        return(array(
            "src" => $img->getAttribute("src"),
            "width" => $img->getAttribute("width"),
            "height" => $img->getAttribute("height")
        ));
    }
    return( false );
}

/**
 * Returns 3 latest posts: permalinks, post titles
 * @return mixed
 */
function voa_get_latest_posts( $blog_id, &$meta, $limit = 3 ) {
	global $wpdb;

	switch_to_blog( $blog_id );
	
	$entries = $wpdb->get_results(sprintf(
		"select 
            ID, post_date, post_name, post_title, post_content, post_author 
        from
            wp_%s_posts
        where
            post_type='post' and
            post_status='publish'
        order by
            post_date desc
        limit %s",
		$blog_id,
        $limit
	));
	
	// expected: http://blogs.voanews.com/african-music-treasures/2013/10/15/bassekou-kouyates/
	foreach( $entries as $k => $entry ) {
		
		$ts = strtotime( $entry->post_date );
	
		$entries[$k]->permalink = sprintf(
			"%s%s/%s/%s/%s/",
			$meta->blog_url,
			date("Y", $ts),
			date("m", $ts),
			date("d", $ts),
			$entry->post_name
		);
        
		// image, author, and post thumbnail
        $entries[$k]->image = voa_get_image($entry->post_content);
        $entries[$k]->author = $wpdb->get_row(sprintf(
            "select * from wp_users where ID=%s limit 1",
            $entry->post_author
        ));
		
		unset( $entries[$k]->author->user_pass );

		#$entries[$k]->thumbnail = null;
		$entries[$k]->thumbnail = get_the_post_thumbnail( $entry->ID, array(113, 80) );
		/*
		$thumbnail = $wpdb->get_row(sprintf(
			"select * from wp_%s_postmeta where meta_key='_thumbnail_id' and post_id=%s limit 1",
			$blog_id,
			$entry->ID
		));

		
		if( !is_null($thumbnail) ) {
			$thumbnail_meta = $wpdb->get_row(sprintf(
				"select * from wp_%s_postmeta where meta_key='_wp_attached_file' and post_id=%s limit 1",
				$blog_id,
				$thumbnail->meta_value
			));
			
			if( !is_null($thumbnail_meta) ) {
				$entries[$k]->thumbnail = $thumbnail_meta->meta_value;
			}
		}
		*/
		
        unset( $entry->post_content );
	}

	restore_current_blog();
	
	return( $entries );
}

/**
 * resolves or returns a header image of a blog_id
 * @return string
 */

function voa_get_blog_header_image($image, $blog_id) {
    global $wpdb;

    // sigh: no header specified
    if( is_null($image) ) return( VOA_DEFAULT_LOGO_URL );
    
    // okay: only one header uploaded
    if( $image !== "random-uploaded-image" ) return( $image );

    // otherwise: sigh, rotate through a random header
    $images = array();
    
    // get post IDs of possible headers
    $headers = $wpdb->get_results(sprintf(
        "select * from wp_%s_postmeta where `meta_key`='_wp_attachment_is_custom_header'",
        $blog_id
    ));
    
    // resolve them to URLs (post_content or guid)
    foreach( $headers as $header ) {
        $images[] = $wpdb->get_row(sprintf(
            "select * from wp_%s_posts where ID=%s limit 1",
            $blog_id,
            $header->post_id
        ));
    }
    
    // pick a random one, return URL
    $random = rand(0,count($images) - 1);
    return( $images[$random]->guid );
}


/**
 * Gets a simple list of all WPMU blogs -- live blogs, with their options
 * Each blog entry contains:
 * ->meta
 *     ->directory: 	object array (language preferences, option whether to hide entry)
 *     ->posts: 		object array (3 most recent posts, urls, titles)
 *     ->header image: 	string (url)
 *     ->blog_name: 	string
 *     ->blog_url: 		string
 *     ->blog_desc:		blog tag
 * @return mixed
 */

function voa_get_intro_blogs_all( $show_hidden = false ) {
	global $wpdb;

	$themes = voa_get_themes();
	
	$sql = "select * from wp_blogs where blog_id!=1 and `deleted`=0 and `public`=1 order by `path` asc";
	$blogs = $wpdb->get_results($sql);
	
	foreach( $blogs as $k => $blog ) {
		$blogs[$k]->meta->directory = voa_get_option( $blog->blog_id, "voa_opt_directory" );
		
		# need to find theme first 				(ex: b_Pangea african music)
		# from it, locate theme slug			(ex: 
		# then locate theme_mods_{$theme_name}  (ex: theme_mods_azerbaijani_pangea_2013)
		#$blogs[$k]->meta->theme = voa_get_option( $blog->blog_id, "theme_mods_" . , true );
		
		$blogs[$k]->meta->current_theme = voa_get_option( $blog->blog_id, "current_theme", true );
		$blogs[$k]->meta->current_theme_slug = $themes[$blogs[$k]->meta->current_theme];
		
		$theme_mods = voa_get_option(
			$blog->blog_id, "theme_mods_" . $blogs[$k]->meta->current_theme_slug
		);
		
        $blogs[$k]->meta->header_image = voa_get_blog_header_image($theme_mods["header_image"], $blog->blog_id);

		$blogs[$k]->meta->blog_name = voa_get_option( $blog->blog_id, "blogname", true );
		$blogs[$k]->meta->blog_url = sprintf( "http://blogs.voanews.com%s", $blog->path );
		$blogs[$k]->meta->blog_desc = voa_get_option( $blog->blog_id, "blogdescription", true );
		
		$blogs[$k]->meta->posts = voa_get_latest_posts( $blog->blog_id, $blogs[$k]->meta );
	}
	
	return( $blogs );
}


/**
 * Gets a list of WPMU blogs by specific Language
 * Comes back with header images, taglines, etc
 * @return mixed
 */
function voa_get_intro_blogs( $blogs, $language = null ) {
	global $wpdb;

	#$blogs = voa_get_intro_blogs_all();

	// filter any results, if needed. normally we need all the additional information
	// to discern languages, etc, so start with the large list and whittle it down
	if( is_null( $language ) ) {
		return( $blogs );
	} else {
		$ret = array_filter( $blogs, function($e) use( $language ) {
			
			// hide option override
			if( $e->meta->directory["voa_introgroup_cfg"] == "hide" ) return( false );
			
			// languages match
			if( $e->meta->directory["voa_language"] == $language ) return( true );
		
			// unknown, so assume entry doesn't match
			return( false );
		});
		return( $ret );
	}

}


/**
 * Returns available languages as seen by query
 * @return mixed
 */
function voa_get_languages( &$blogs ) {
	$languages = array();
	foreach( $blogs as $blog ) {
		$language = $blog->meta->directory['voa_language'];
		$cfg = $blog->meta->directory['voa_introgroup_cfg'];
		
		if( is_null( $language ) ) continue;
		if( $language == "" ) continue;
		if( $cfg == "hide" ) continue;
		
		$languages[$language]++;
	}
	return( $languages );
}

