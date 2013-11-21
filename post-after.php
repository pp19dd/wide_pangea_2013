

<div class="post_after">

<?php get_template_part( 'post', 'author' ); ?>

	<div class="post_meta">

<?php get_template_part( 'post', 'share' ); ?>
		<div class="post_meta_left">
<?php if( comments_open() ) { ?>
			<div class="post_commentcount"><?php get_template_part( 'post', 'commentcount' ); ?></div>
<?php } ?>		
			<div class="post_tags"><?php the_tags(); ?></div>
			<div class="post_categories">Posted in <?php the_category(", "); ?></div>
		</div>

		<div style="clear:both"></div>
		
	</div>

</div>