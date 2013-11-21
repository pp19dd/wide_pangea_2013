<?php 
global $voa_wp_excerpts_only;	// if true, don't display full posts
global $wp_query;

$post_classes = array();
$post_classes[] = "post_{$post->ID}";
$post_classes[] = "post_count_{$wp_query->current_post}";

if( is_single() ) $post_classes[] = "post_single";
if( $wp_query->post_count-1 == $wp_query->current_post ) $post_classes[] = "post_last";
?>

<div <?php post_class($post_classes) ?>>

<?php if( $voa_wp_excerpts_only === true ) { ?>

	<?php get_template_part( 'post', 'title' ); ?>
	<?php get_template_part( 'post', 'before' ); ?>
	<div class="post_content">
		<?php get_template_part( 'post', 'excerpt' ) ?>
	</div>

<?php } else { ?>

	<?php get_template_part( 'post', 'title' ); ?>
	<?php get_template_part( 'post', 'authortop' ); ?>
	<?php get_template_part( 'post', 'before' ); ?>
	
	<div class="post_content">
		<?php get_template_part( 'post', 'entry' ) ?>
	</div>

	<?php get_template_part( 'post', 'after' ); ?>
<?php if( is_single() ) { ?>
<?php } ?>

<?php } ?>

<?php if( is_single() ) { ?>
<?php get_template_part( 'post', 'nav' ); ?>
<?php get_template_part( 'post', 'comments' ); ?>
<?php } ?>

<div class="voa_wp_clear"></div>

</div>
