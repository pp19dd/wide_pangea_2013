<?php

include_once( "functions.blogs.php" );
include_once( "functions.date.php" );


# =======================================================
# ordinary templating below
# =======================================================

# add_theme_support( 'post-thumbnails', array( 'picthumbs' ) );
add_theme_support( 'post-thumbnails' );
// set_post_thumbnail_size( 100, 75, true );
set_post_thumbnail_size( 113, 80, true );
add_image_size( "bloglister-thumb", 113, 80, true );


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
$voa_header_w = 640;
$voa_header_h = 125;
$header_options = get_option("voa_opt_style");
if(
    isset( $header_options['voa_header_w'] ) && 
    strlen(trim($header_options['voa_header_w'])) > 0
) {
    $voa_header_w = intval($header_options['voa_header_w']);
}
if(
    isset( $header_options['voa_header_h'] ) &&
    strlen(trim($header_options['voa_header_h'])) > 0
) {
    $voa_header_h = intval($header_options['voa_header_h']);
}

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


function voa_add_editor_styles() {
    add_editor_style( 'voa-editor-style.css' );
}

add_action( 'init', 'voa_add_editor_styles' );


// Callback function to insert 'styleselect' into the $buttons array
function voa_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'voa_mce_buttons_2');


// Callback function to filter the MCE settings
function voa_mce_additional_formats( $init_array ) {
	
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with its own settings
		array(
			'title'   => 'Basic Boxout Left',
			'block'  => 'blockquote',
			'classes' => 'boxout boxout-basic boxout-left',
			'wrapper' => true
		),

		array(
			'title'   => 'Basic Boxout Right',
			'block'  => 'blockquote',
			'classes' => 'boxout boxout-basic boxout-right',
			'wrapper' => true
		),

		array(
			'title'   => 'Dark Boxout Left',
			'block'  => 'blockquote',
			'classes' => 'boxout boxout-dark boxout-left',
			'wrapper' => true
		),

		array(
			'title'   => 'Dark Boxout Right',
			'block'  => 'blockquote',
			'classes' => 'boxout boxout-dark boxout-right',
			'wrapper' => true
		),

		array(
			'title'   => 'Plain Boxout Left',
			'block'  => 'blockquote',
			'classes' => 'boxout boxout-plain boxout-left',
			'wrapper' => true
		),

		array(
			'title'   => 'Plain Boxout Right',
			'block'  => 'blockquote',
			'classes' => 'boxout boxout-plain boxout-right',
			'wrapper' => true
		)
	);

	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;
}

// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'voa_mce_additional_formats' );



// adds social media links to user profile page
// added by smekosh on 2014-08-26
function voa_social_media_links($profile_fields) {

	// Add new fields
	$profile_fields['facebook']   = 'Facebook URL';
	$profile_fields['gplus']      = 'Google+ URL';
	$profile_fields['instagram']  = 'Instagram URL';
	$profile_fields['pinterest']  = 'Pinterest URL';
	$profile_fields['soundcloud'] = 'SoundCloud URL';
	$profile_fields['twitter']    = 'Twitter URL';
	$profile_fields['youtube']    = 'YouTube URL';

	return $profile_fields;
}

add_filter('user_contactmethods', 'voa_social_media_links');
