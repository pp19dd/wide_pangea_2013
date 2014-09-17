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

		$voa_author_facebook = get_the_author_meta( 'facebook', $curauth->ID );
		$voa_author_gplus = get_the_author_meta( 'gplus', $curauth->ID );
		$voa_author_instagram = get_the_author_meta( 'instagram', $curauth->ID );
		$voa_author_pinterest = get_the_author_meta( 'pinterest', $curauth->ID );
		$voa_author_soundcloud = get_the_author_meta( 'soundcloud', $curauth->ID );
		$voa_author_twitter = get_the_author_meta( 'twitter', $curauth->ID );
		$voa_author_youtube = get_the_author_meta( 'youtube', $curauth->ID );
		
	} else {

		$voa_avatar = get_avatar( get_the_author_meta('user_email'), 80 );
		$voa_author_name = get_the_author();
		$voa_author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$voa_author_bio = get_the_author_meta("description");

		$voa_author_facebook = get_the_author_meta( 'facebook' );
		$voa_author_gplus = get_the_author_meta( 'gplus' );
		$voa_author_instagram = get_the_author_meta( 'instagram' );
		$voa_author_pinterest = get_the_author_meta( 'pinterest' );
		$voa_author_soundcloud = get_the_author_meta( 'soundcloud' );
		$voa_author_twitter = get_the_author_meta( 'twitter' );
		$voa_author_youtube = get_the_author_meta( 'youtube' );
	}
	
	if( strlen(trim($voa_author_bio)) > 0 ) {

?>

<div class="voa_wp_author_box">
	<div class="voa_wp_author_box_inner">
		<div class="author_gravatar">
			<a title="Show all posts by <?php echo $voa_author_name ?>" href="<?php echo $voa_author_url; ?>"><?php echo $voa_avatar ?></a>
		</div>

		
		
		<div class="author_name">
			<a title="Show all posts by <?php echo $voa_author_name ?>" href="<?php echo $voa_author_url; ?>">
				<?php echo $voa_author_name ?>
			</a>

			<span class="author-social">
				<?php /* aastuti recommended the following order: facebook, twitter, instagram, pinterest, gplus, youtube, soundcloud */ ?>

				<?php if ($voa_author_facebook) { ?>
					<a class="voa-social-fb" href="<?php echo $voa_author_facebook; ?>" title="<?php echo $voa_author_name ?> on Facebook"><span class="replaced">Facebook</span></a>
				<?php } ?>

				<?php if ($voa_author_twitter) { ?>
					<a class="voa-social-twitter" href="<?php echo $voa_author_twitter; ?>" title="<?php echo $voa_author_name ?> on Twitter"><span class="replaced">Twitter</span></a>
				<?php } ?>

				<?php if ($voa_author_instagram) { ?>
					<a class="voa-social-instagram" href="<?php echo $voa_author_instagram; ?>" title="<?php echo $voa_author_name ?> on Instagram"><span class="replaced">Instagram</span></a>
				<?php } ?>

				<?php if ($voa_author_pinterest) { ?>
					<a class="voa-social-pinterest" href="<?php echo $voa_author_pinterest; ?>" title="<?php echo $voa_author_name ?> on Pinterest"><span class="replaced">Pinterest</span></a>
				<?php } ?>

				<?php if ($voa_author_gplus) { ?>
					<a class="voa-social-gplus" href="<?php echo $voa_author_gplus; ?>" title="<?php echo $voa_author_name ?> on Google Plus"><span class="replaced">Google+</span></a>
				<?php } ?>

				<?php if ($voa_author_youtube) { ?>
					<a class="voa-social-youtube" href="<?php echo $voa_author_youtube; ?>" title="<?php echo $voa_author_name ?> on YouTube"><span class="replaced">YouTube</span></a>
				<?php } ?>

				<?php if ($voa_author_soundcloud) { ?>
					<a class="voa-social-soundcloud" href="<?php echo $voa_author_soundcloud; ?>" title="<?php echo $voa_author_name ?> on SoundCloud"><span class="replaced">SoundCloud</span></a>
				<?php } ?>
			</span>
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
