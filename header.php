<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html id="html1" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en"> <head id="ctl00_ctl00_Head1"><title><?php  wp_title('&laquo;', true, 'right');  ?> <?php  bloginfo('name');  ?></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/29cd71bef50aa7b2d4bcc22a197fb4b1.css" /> <!--[if IE 6]><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/2e35c59a170bc85a00c5211521f855e7.css" /><![endif]--> <!--[if IE 7]><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/3c0ccf6ce7481d4d398a3d5bed40249f.css" /><![endif]--> <!--[if IE 8]><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/cba2b0022ca2e0ab4b9ed79c2413c6fd.css" /><![endif]--> <!--[if IE 9]><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/8334660d7eab92dc4d02b6e3844fb0a5.css" /><![endif]-->   <link rel="stylesheet" type="text/css" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/00f8d126ce8d97b38df5a1bd72a16319.css" />  <link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/7867e175954aaf133205f7d419950f84.css" /> <!--[if IE 6]><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/b876aa3967c408c18533cb53e248d945.css" /><![endif]--> <!--[if IE 7]><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/4ad4d3b9586298555f04f77984361027.css" /><![endif]--> <link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/32b23f71d213595a5eeb4c7abab41e68.css" /><link rel="stylesheet" type="text/css" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/504f934ebb7428cffba3a210ade569b6.css" /> <link rel="stylesheet" type="text/css" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/52189933c975e6d554d0a2a8e14cab31.css" /><meta http-equiv="Content-Language" content="en" /><!--[if lte IE 7]><link type="text/css" rel="stylesheet" href="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/a64f926a0421083887de4712ba14831a.css" /><![endif]--><link rel="alternate" type="application/rss+xml" href="<?php  bloginfo('rss2_url');  ?>" title="<?php  printf( __( '%s latest posts', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) );  ?>" /><?php  get_template_part('header', 'head'); ?>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
<script type='text/javascript'>

/*
this replaces pangea routines
*/
jQuery(document).ready( function() {
	$('.sites_by_language a.trigger').click( function() {
		$('#top_bar_expanded').stop().slideToggle('fast');
		return( false );
	});

	$('#keywords_header,#keywords_footer').keypress( function(e) {
		if( e.keyCode == 13 ) SearchButton( this );
	});

	$('#search_loupe_btn,#search_loupe_btn_footer').click( function() {
		SearchButton( $(this).next() );
	});

});

function SearchButton( that ) {
	var search_term = $(that).val();
	window.location = '<?php  bloginfo('home')  ?>/?s=' + escape(search_term);
}

</script>

<?php  wp_head();  ?></head> <body id="bd1" class="body_article">     
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="" />























 <!--[if lte IE 7]><div id="ctl00_ctl00_ctl20" class="ie6nomore" style="display:none;">
	<button type="button" title="Close" onclick="(function (){$(document.getElementById(&#39;ctl00_ctl00_ctl20&#39;)).hide(1000);var cookieExpiration = new Date();cookieExpiration.setTime(cookieExpiration.getTime() + 1000 * 1814400);$.cookie(&#39;IE6NoMore_Closed&#39;,true,{path:&#39;/&#39;,expires: cookieExpiration});(function(){$(&#39;#ctl00_ctl00_ctl20&#39;).prev(&#39;.ie6nomore-bg&#39;).remove();$(&#39;object, embed&#39;).filter(function(){try{return $(this).attr(&#39;IE6NoMoreHidden&#39;) == &#39;true&#39;;}catch(ex){return false;}}).css(&#39;visibility&#39;, function(){return $(this).attr(&#39;IE6NoMoreVisibility&#39;);});})();})()"><img class="ie6nomoreClose" src="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/92377761d92455295e3c33f88746361a.gif" alt="Close" /></button><h2>
		Did you know that your Internet Explorer is out of date?
	</h2><p>To get best possible experience using our website we recommend that you upgrade to a newer version or other web browser. A list of the most popular web browsers can be found below.</p><div>
		<p>Just click on the icons to get to the download page</p><a href="http://getfirefox.com/"><img alt="Firefox 14+" title="Firefox 14+" class="ie6nomoreFF" src="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/92377761d92455295e3c33f88746361a.gif" /><span>Firefox 14+</span></a><a href="http://www.opera.com/browser/"><img alt="Opera 12+" title="Opera 12+" class="ie6nomoreOP" src="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/92377761d92455295e3c33f88746361a.gif" /><span>Opera 12+</span></a><a href="http://www.google.com/chrome/"><img alt="Chrome 21+" title="Chrome 21+" class="ie6nomoreCH" src="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/92377761d92455295e3c33f88746361a.gif" /><span>Chrome 21+</span></a><a href="http://www.apple.com/safari/"><img alt="Safari 5.1+" title="Safari 5.1+" class="ie6nomoreSF" src="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/92377761d92455295e3c33f88746361a.gif" /><span>Safari 5.1+</span></a><a href="http://www.microsoft.com/windows/internet-explorer/"><img alt="Internet Explorer 9+" title="Internet Explorer 9+" class="ie6nomoreIE" src="http://blogs.voanews.com/test/wp-content/themes/wide_pangea_2013/dep/92377761d92455295e3c33f88746361a.gif" /><span>Internet Explorer 9+</span></a>
	</div>
</div><![endif]-->
        <div id="superheader"><?php  get_template_part( 'header', 'super' );  ?></div>

            
            
            

            <div class="main-content">
                
                <div class="content_centered">
                    
                    <div class="content" dir="ltr">
                        
                        
                            
         
                        <div class="columns">
                              <div class="content_column2_1"> <a name="content" id="content"></a>  
    
    
    <div id="article" class="middle_content">
        
        <h1></h1>
        
        
        
        
        <div id="mainMediaBig">
            </div>
        
        <div class="articleContent">