<?php

if( !function_exists( 'voa_custom_date_kurdi' ) ) {
function voa_custom_date_kurdi( $ts ) {

	$months = array(
		1 => "Meha Yek",		2 => "Meha Du",		3 => "Meha Sê",		4 => "Meha Çar",
		5 => "Meha Pênc",		6 => "Meha Şeş",	7 => "Meha Heft",	8 => "Meha Heşt",
		9 => "Meha Neh",		10 => "Meha Deh",	11 => "Meha Yazde",	12 => "Meha Duwazda"
	);

	$days = array(
		1 => "Duşembî",			2 => "Sêşembî",			3 => "Çarşembî",		4 => "Pêncşembî",
		5 => "Heynî",			6 => "Şembî‌",			7 => "Yekşembî"
	);

	//return date("d ", $pul).$months[date("n", $pul)].date(" Y ", $pul).$days[date("w", $pul)];
	
	$y = date("Y", $ts);
	$day = date("N", $ts);
	$d = date("j", $ts );
	$m = date("n", $ts);
	
	return( "{$days[$day]}, {$d} {$months[$m]} {$y}" );
}
}


if( !function_exists( 'voa_custom_date_kurdish' ) ) {

function voa_custom_date_kurdish( $ts ) {

	$months = array(
		1 => "ی مانگی یه‌کی",		2 => "ی مانگی دووی",		3 => "ی مانگی سێی",		4 => "ی مانگی چواری",
		5 => "ی مانگی پـێنجی",		6 => "ی مانگی شه‌شی",		7 => "ی مانگی حه‌وتی",		8 => "ی مانگی هه‌شتی",
		9 => "ی مانگی نۆی",		10 => "ی مانگی ده‌ی",		11 => "ی مانگی یازده‌ی",		12 => "ی مانگی دوازده‌ی"
	);

	$days = array(
		1 => "دووشه‌ممه‌",			2 => "سێشه‌ممه‌",			3 => "چوارشه‌ممه‌",		4 => "پـێنجشه‌ممه‌",
		5 => "هه‌ینی",				6 => "شه‌ممه‌",			7 => "یه‌کشه‌ممه‌"
	);

	//return date("d ", $pul).$months[date("n", $pul)].date(" Y ", $pul).$days[date("w", $pul)];
	
	$y = date("Y", $ts);
	$day = date("N", $ts);
	$d = date("j", $ts );
	$m = date("n", $ts);
	
	return( "{$days[$day]}, {$d} {$months[$m]} {$y}" );
}
}
