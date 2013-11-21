<?php
/*
Template Name: Blank page
*/

?>
<!doctype html>
<html>
<head>
	<title><?php the_title(); ?></title>
<?php wp_head(); ?>
</head>

<body>
<?php
the_post();
the_content();
?>
</body>
</html>
