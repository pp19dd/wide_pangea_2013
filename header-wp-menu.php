
<div id="proto_header">
	<a href="<?php echo get_option('home'); ?>/"></a>
</div>

<?php wp_nav_menu( array(
	'menu' => 'wide',
	'menu_class' => 'digital_menu',
	#'container_class' => 'cat-item',#menu-{menu slug}-container cat-item', 
	'fallback_cb' => 'menu_wide_fallback_cb',
	'container_class' => 'menu-header'#,
	#'theme_location' => 'wide'
)); ?>

<div class="voa_wp_clear"></div>
