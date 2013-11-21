<?php get_header(); ?>

<div class="voa_wp_wrap">

	<div class="voa_wp_header_wrap">
		<?php get_template_part( 'header', 'wp-menu' ); ?>
	</div><!-- .voa_wp_header_wrap -->

	<div class="voa_wp_posts_wrap voa_wp_archive">

	<div class="posts_by_author">
		<h3>Showing Archived Posts</h3>
	</div>
	
<div style="border-bottom:4px solid silver">
<?php if( !is_single() ) { ?>
<div class="voa_wp_page_numbers_wrap">
<?php if( function_exists('wp_page_numbers') ) wp_page_numbers(); ?>
</div>
<?php } ?>
</div>

<?php $voa_wp_excerpts_only = true; ?>
<?php get_template_part( 'index', 'posts' ); ?>
		
	</div><!-- .voa_wp_posts_wrap -->

</div><!-- .voa_wp_wrap -->

<?php get_footer(); ?>
