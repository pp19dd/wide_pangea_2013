<?php
/*
Template Name: Redirect page
*/

the_post();

$title = trim(get_the_title());
$results = preg_match("/([0-9]+)/", $title, $matches);
$redir = trim(get_the_content());

if( $results > 0 ) {
	$code = $matches[0];
	
	if( $code == 301 ) {
		header("HTTP/1.1 301 Moved Permanently");
	}
}

header("location: {$redir}");
die;


?>
