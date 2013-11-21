<?php get_header(); ?>

<div class="voa_wp_wrap">

	<div class="voa_wp_header_wrap">
		<?php get_template_part( 'header', 'wp-menu' ); ?>
	</div><!-- .voa_wp_header_wrap -->

	<div class="voa_wp_posts_wrap voa_wp_404">

		<?php get_template_part( '404', 'notfound' ); ?>
	
		<?php get_search_form(); ?>
		
	</div><!-- .voa_wp_posts_wrap -->

</div><!-- .voa_wp_wrap -->

<?php get_footer(); ?>
