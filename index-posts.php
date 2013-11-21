
<?php if (have_posts()) { ?>
	<div class="voa_wp_posts_wrap">
<?php while (have_posts()) { the_post(); ?>
<?php get_template_part( 'post' ); ?>
<?php } # end while have_posts ?>
	</div><!-- .voa_wp_posts_wrap -->
<?php } # end have_posts ?>

<?php if( !is_single() ) { ?>
<div class="voa_wp_page_numbers_wrap">
<?php if( function_exists('wp_page_numbers') ) wp_page_numbers(); ?>
</div>
<?php } ?>
