<?php get_header(); ?>

<div class="voa_wp_wrap">

	<div class="voa_wp_header_wrap">
		<?php get_template_part( 'header', 'wp-menu' ); ?>
	</div><!-- .voa_wp_header_wrap -->

<?php get_template_part( 'index', 'posts' ); ?>

</div><!-- .voa_wp_wrap -->

<?php get_footer(); ?>
