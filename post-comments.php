
<?php $o = get_option("voa_opt_comm"); ?>

<?php
// if commenting option is not set, default to this type of commenting
// otherwise, if it is set, check for traditional type
if(
	!isset( $o['voa_commenting'] ) ||
	(isset( $o['voa_commenting'] ) && $o['voa_commenting'] == 'traditional' )
) { ?>

<div class="commentlist">
	<?php comments_template(); ?>
</div>

<?php } ?>

<?php if( isset( $o['voa_commenting'] ) && $o['voa_commenting'] == 'facebook' ) { ?>

<div class="f8_box">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=143810538983556";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-comments" data-href="<?php the_permalink() ?>" data-num-posts="6" data-width="610"></div>

</div>

<?php } ?>
