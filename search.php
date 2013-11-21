<?php get_header(); ?>

<?php
global $wp_query;
$total_results = $wp_query->found_posts;
?>

<div class="voa_wp_wrap">

	<div class="voa_wp_header_wrap">
		<?php get_template_part( 'header', 'wp-menu' ); ?>
	</div><!-- .voa_wp_header_wrap -->

	<div class="voa_wp_posts_wrap voa_wp_search">

<h1>Search results</h1>

<?php if( $total_results == 0 ) { ?>
<p>Sorry, there are no search results for "<?php echo the_search_query() ?>."</p>
<p>Please visit the <a href="<?php bloginfo('home') ?>"><?php bloginfo("name") ?></a> homepage or use the search box below.</p>
<?php } else { ?>

<p>Showing search results for "<?php echo the_search_query() ?>."</p>

<?php $voa_wp_excerpts_only = true; ?>
<?php get_template_part( 'index', 'posts' ); ?>

<?php } ?>

		<?php get_search_form(); ?>
		
	</div><!-- .voa_wp_posts_wrap -->

</div><!-- .voa_wp_wrap -->

<?php get_footer(); ?>
