<?php
$o = get_option("voa_opt_comm");
if( isset( $o['show_author'] ) ) {

	// make this module work in either a single post, or on author page
	if( is_author() ) {
		
		$curauth = get_user_by('slug', $author_name);
		
		$voa_avatar = get_avatar( get_the_author_meta('user_email', $curauth->ID), 80 );
		$voa_author_name = get_the_author_meta('display_name', $curauth->ID );
		$voa_author_url = get_author_posts_url( $curauth->ID );
		$voa_author_bio = get_the_author_meta("description", $curauth->ID );
		
	} else {

		$voa_avatar = get_avatar( get_the_author_meta('user_email'), 80 );
		$voa_author_name = get_the_author();
		$voa_author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$voa_author_bio = get_the_author_meta("description");
	}
	
	if( strlen(trim($voa_author_bio)) > 0 ) {

?>

<div class="voa_wp_author_box">
	<div class="voa_wp_author_box_inner">
		<div class="author_gravatar">
			<?php echo $voa_avatar ?>
		</div>

		<div class="author_name">
			<a title="Show all posts by <?php echo $voa_author_name ?>" href="<?php echo $voa_author_url; ?>">
				<?php echo $voa_author_name ?>
			</a>
		</div>
		
		<div class="author_bio">
			<?php echo $voa_author_bio; ?>
		</div>

	</div>
	
	<div class="voa_wp_clear"></div>

</div>

<?php

} # end if empty bio

} # end if show author
