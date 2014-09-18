
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>?v8" />
<?php /* <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" /> */ ?>

<!-- next line needed for Font Awesome on IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!--[if lt IE 9]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php $voa_seo_keywords = get_option( 'voa_seo_keywords', false );?>

<?php if( !$voa_seo_keywords ) { ?>

<meta name="keywords" content="Afghanistan, Africa, America, asia, audio, barack, Central America, central asia, Clinton, culture, economy, english, entertainment, Eurasia, Europe, foreign, foreign policy, Global, hillary, information, international, iran, Iraq, latest, Latin America, learning, Michelle, Middle East, Near East, news, obama, Pacific, podcast, Policy, politics, radio, shortwave, South Asia, special, television, Trade, United States, US, USA, video, VOA, Voice of America, world" />

<?php } else { ?>

<meta name="keywords" content="<?php echo $voa_seo_keywords ?>" />

<?php } ?>

<?php 

	$description = "The Voice of America is one of the world&#39;s most trusted sources for news and information from the United States and around the world. VOA is a multimedia news organization using radio, television, and the internet to distribute content in 45 languages.";
	
	$voa_seo_description = get_option( 'voa_seo_description', false );
	$voa_seo_override = (is_single()) ? get_post_meta( $post->ID, "META Description", true ) : false ;
	
	if( strlen($voa_seo_override) == 0 ) $voa_seo_override = false;
	if( strlen($voa_seo_description) == 0 ) $voa_seo_description = false;
	
	if( $voa_seo_description != false) $description = $voa_seo_description;
	if( is_single() && $voa_seo_override ) $description = $voa_seo_override;

	if( is_single() && $voa_seo_override == false ) {
		ob_start();
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				the_excerpt_rss();
			}
		}
		$description = ob_get_clean();
	}
	
	if( is_category() ) {
		$possible_description = trim(strip_tags(category_description()));
		if( strlen($possible_description) > 0 ) $description = $possible_description;
	}
	if( is_tag() ) {
		$possible_description = trim(strip_tags(tag_description()));
		if( strlen($possible_description) > 0 ) $description = $possible_description;
	}
	
?>

<meta name="description" content="<?php echo trim($description); ?>" />
