<?php
# =======================================================
# need the below vars/info for templating
# =======================================================
$intro_page_url = get_permalink();
$intro_language = isset($_GET['l']) ? $_GET['l'] : 'english';
$all_blogs = voa_get_intro_blogs_all();
$blogs = voa_get_intro_blogs( $all_blogs, $intro_language );
$intro_languages = voa_get_languages($all_blogs);	

# =======================================================
# custom css for the intro page (blog directory)
# =======================================================
function voa_intro_fix_styles() {

?>

<style type="text/css">
/* .post ul li, .page ul li { list-style: none inside !important } */
div.content_column2_1 { width: 998px; overflow: hidden }
div.content_column2_2 { display: none }
div.articleContent { width: 974px; }
/*
#mainNav li { float: left }
a.tabOn { background-color: #374EC5; color: white; padding:5px }
*/


<?php /*
#blogNav {
	text-align: justify;
	min-width: 500px;

	font-size: 1px;
}
#blogNav:after {
	content: '';
	display: inline-block;
	width: 100%;
}

#blogNav li {
	display: inline-block;

	padding: 10px 0;
}

#blogNav li a {
	xxxxdisplay: block;
	width: 100%;

	display: inline;
	background-color: #F4F4F4;
	border-bottom: 4px solid #DFDFDF;
	border-top: 1px solid #DFDFDF;
	padding: 10px 15px;
}

#blogNav li a:hover {
	background: #999;
	border-bottom: 4px solid #999;
	color: #fff;
	text-decoration: none;
}

#blogNav li a.list-head {
	background: #374EC5;
	border-color: #374EC5;
	color: #fff;
}

#blogNav li a.tabOn,
#blogNav li a.tabOn:hover {
	background: #EDEDED;
	border-bottom: 4px solid #999;
	color: #374EC5;
}

*/ ?>

#blogNav {
	text-align: justify;
	min-width: 500px;

	background: #F4F4F4 url(<?php echo get_stylesheet_directory_uri(); ?>/img/blogNav-bg.png) left bottom repeat-x;
	font-size: 1px;
}
#blogNav:after {
	content: '';
	display: inline-block;
	width: 100%;
}

#blogNav a {
	border-bottom: 4px solid #DFDFDF;
	display: inline-block;
	font-size: 15px;
	padding: 8px 15px 7px;
	text-decoration: none;
}

#blogNav a:hover {
	background: #EDEDED;
	border-bottom: 4px solid #374EC5;
	color: #374EC5;
}

#blogNav a.tabOn {
	background: #374EC5;
	border-color: #374EC5;
	color: #fff;
}

.voa_wp_clear {
	height: 60px;
}

.blog-block {
	float: left;
	margin-bottom: 45px;
	padding: 0;
	width: 475px;
}

.left-block {
	clear: left;
	padding-right: 24px;
}

.blog-block h1 {
	margin: 0;
	padding: 0;
}

.blog-block p {
	text-align: left;
	padding: 6px;
	color: #666;
	border-bottom: 1px solid #ccc;
	line-height: 140%;
	font-style: normal;
	margin: 0 0 12px 0;
	width: 461px;
	font-size: 12px;
}

.blog-block h1 img {
	width: 475px;
}

.blog-block ul > li {
	color: #666;
	list-style: circle outside none;
	margin-bottom: 6px;
	margin-left: 20px;
	padding-left: 0;
}



@media only screen and (max-width: 500px) {

	html#html1, body#bd1 {
		min-width: 100%;
		overflow-x: hidden;
		width: 100%;
	}

	div.articleContent,
	.content_centered,
	div.content_column2_1 {
		width: 100%;
	}

	#top_bar, 
	#top_bar_expanded,
	#header_services,
	ul.header_navigation,
	#footerServices {
		display: none;
		visibility: hidden;
	}

	.columns {
		padding-top: 0;
	}

	#header {
		background: none;
		height: 70px !important;
	}

	#header .content_centered {
		height: auto;
	}

	#header .content_centered h2#header_logo {
		background-image: url( <?php echo get_stylesheet_directory_uri(); ?>/img/VOA_en-US-top_logo_blog-mobile.gif);
		background-size: contain;
		height: auto;
		max-width: 90%;
		width: 90%;
	}

	#header .content_centered h2#header_logo a {
		margin-top: 0;
	}

	#blogNav {
		background-image: none;
		min-width: 100%;
	}

	#blogNav a, #blogNav a:hover {
		border: 0;
		font-size: 14px;
	}

	.blog-block {
		clear: both;
		float: none;
		width: 100%;
	}

	.left-block {
		clear: both;
		padding-right: 0;
	}

	.blog-block h1 img {
		width: 100%;
	}

	.blog-block p {
		font-size: 1em;
		padding: .5em 0;
		width: 100%;
	}

	.voa_wp_clear {
		height: 2em;
	}

	#footer #footerLinks {
		border-top: 2px #2C45C3 solid;
	}

}

</style>

<meta name="viewport" content="initial-scale=1">

<?php

}

add_action( 'wp_head', 'voa_intro_fix_styles' );

get_header();
# get_template_part( 'header', 'wp-menu' );	# optional

# =======================================================
# custom HTML starts here
# =======================================================

?>

<div id="voa-blog-intro">

	<div id="blogNav">
		<!-- <a href="<?php echo $intro_page_url ?>" class="list-head">Blogs</a> -->
		<?php foreach( $intro_languages as $language => $blog_count ) { ?>
		<a href="<?php echo $intro_page_url ?><?php if( $language != 'english' ) { ?>?l=<?php echo $language ?><?php } ?>" class="<?php if( $language == $intro_language ) { echo "tabOn"; } ?>"><?php echo ($language != $intro_language ? ucfirst( $language ) : ucfirst( $language ) . ' Blogs'); ?></a>
		<?php } ?>
	</div>

	<div class="voa_wp_clear"></div>

	<?php foreach( $blogs as $blog ) { ?>
	<?php $c++ ?>

	<div class="blog-block<?php if( $c % 2 ) { echo ' left-block'; } ?>">
		<h1><a href="http://blogs.voanews.com<?php echo $blog->path ?>" title="<?php echo htmlentities($blog->meta->blog_name, ENT_QUOTES) ?>"><img alt="<?php echo htmlentities($blog->meta->blog_name, ENT_QUOTES) ?>" src="http://blogs.voanews.com/resize/?img=<?php echo $blog->meta->header_image ?>&w=475" border="0" /></a></h1>
		<p><?php echo $blog->meta->blog_desc ?></p>

		<ul>
			<?php foreach( $blog->meta->posts as $entry ) { ?>
			<li><a href="<?php echo $entry->permalink ?>"><?php echo $entry->post_title ?></a></li>
			<?php } ?>
		</ul>
	</div>

	<?php } #end foreach blogs ?>

</div>

<?php

# =======================================================
# custom HTML ends here
# =======================================================

get_footer();
