
<?php if( is_single() ) { ?>
<?php get_template_part( 'post', 'nav' ); ?>
<h1><?php the_title() ?></h1>
<?php } else { ?>
<h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
<?php } ?>
