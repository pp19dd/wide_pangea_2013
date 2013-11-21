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
 * Returns 3 latest posts: permalinks, post titles
 * @return mixed
 */
function voa_get_latest_posts( $blog_id, &$meta ) {
	global $wpdb;
	
	$entries = $wpdb->get_results(sprintf(
		"select ID, post_date, post_name, post_title from wp_%s_posts where post_type='post' and post_status='publish' order by post_date desc limit 3",
		$blog_id
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
	}
	
	return( $entries );
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
		if( is_null($theme_mods["header_image"]) ) $theme_mods["header_image"] = VOA_DEFAULT_LOGO_URL;
		$blogs[$k]->meta->header_image = $theme_mods["header_image"];
		
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


# =======================================================
# ordinary templating below
# =======================================================

add_theme_support( 'post-thumbnails', array( 'picthumbs' ) );

set_post_thumbnail_size( 100, 75, true );

include_once( "functions.date.php" );

function _ago($tm,$rcs = 0, $cur_tm = null) {
	if( is_null($cur_tm) ) $cur_tm = time();
	$dif = $cur_tm-$tm;
	$pds = array('second','minute','hour','day','week','month','year','decade');
	$lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
	for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
	
	$no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
	if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
	return $x;
}

function voa_wide_pangea_widgets_init() {

	register_sidebar(
		array(
			'id' => 'sidebar_right',
			'name' => 'Sidebar: Right side',
			'before_widget' => '<div id="%1$s" class="listBox widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="boxwidget_part">',
			'after_title' => '</h3>',
			'description' => 'Right-side sidebar'
		)
	);

	register_sidebar(
		array(
			'id' => 'sidebar_post',
			'name' => 'Sidebar: Below Single Post',
			'before_widget' => '<td class="below_col"><div id="%1$s" class="listBox widget %2$s">',
			'after_widget' => '</div></td>',
			'before_title' => '<h3 class="boxwidget_part">',
			'after_title' => '</h3>',
			'description' => 'Shows up underneath an individual single post'
		)
	);

}

add_action( 'widgets_init', 'voa_wide_pangea_widgets_init' );

	
// make changeable header - dimensions changeable in options
$voa_header_w = 630;
$voa_header_h = 125;
$header_options = get_option("voa_opt_style");
if( isset( $header_options['voa_header_w'] ) && strlen(trim($header_options['voa_header_w'])) > 0 ) $voa_header_w = intval($header_options['voa_header_w']);
if( isset( $header_options['voa_header_h'] ) && strlen(trim($header_options['voa_header_h'])) > 0 ) $voa_header_h = intval($header_options['voa_header_h']);

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/setta.jpg'); // %s is theme dir uri
#define('HEADER_IMAGE', get_bloginfo('stylesheet_directory') . '/setta.jpg');
define('HEADER_IMAGE_WIDTH', $voa_header_w );
define('HEADER_IMAGE_HEIGHT', $voa_header_h );
define('NO_HEADER_TEXT', true );

// todo: why is this here?
function atypxmas_admin_header_style() {

}

function header_style() {
?>

<meta name="viewport" content="initial-scale=1">

<style type="text/css">

#proto_header{
	background-image: url(<?php header_image() ?>);
	background-repeat: no-repeat;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
}

#proto_header a {
	padding-right: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	padding-bottom: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	display: block;
}

</style>
<?php
}

add_custom_image_header('header_style', 'atypxmas_admin_header_style');

// empty menu, in case of a default
function menu_wide_fallback_cb($a) {

}

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
	'wide' => __( 'Primary Navigation', 'wide' ),
) );
