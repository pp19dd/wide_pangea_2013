<?php
$o = get_option("voa_opt_comm");
if( isset( $o['show_author'] ) ) {
?>

	<div class="post-author-top author-<?php echo get_the_author_meta( 'user_login' ) ?>">
		<a title="Show all posts by <?php the_author() ?>" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php the_author() ?>
		</a>
	</div>
	
<?php } # end if show author
