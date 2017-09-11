<?php
global $marketeer_data; 
$use_bg = ''; $background = ''; $custom_bg = ''; $body_face = ''; $use_bg_full = ''; $bg_img = ''; $bg_prop = '';



if(isset($marketeer_data['background_image_full'])) {
	$use_bg_full = $marketeer_data['background_image_full'];
	
}

if(isset($marketeer_data['use_boxed'])){
	$use_boxed = $marketeer_data['use_boxed'];
}
else{
	$use_boxed = 0;
}

if($use_bg_full) {


	if($use_bg_full && isset($marketeer_data['use_boxed']) && $marketeer_data['use_boxed'] == 1) {
		$bg_img = $marketeer_data['image_background'];
		$bg_prop = '';
	}

	

	
	$background = 'url('. $bg_img .') '.$bg_prop ;

}

function ieOpacity($opacityIn){
	
	$opacity = explode('.',$opacityIn);
	if($opacity[0] == 1)
		$opacity = 100;
	else
		$opacity = $opacity[1] * 10;
		
	return $opacity;
}

function HexToRGB($hex,$opacity) {
		$hex = preg_replace("/#/", "", $hex);
		$color = array();
 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
 
		return 'rgba('.$color['r'] .','.$color['g'].','.$color['b'].','.$opacity.')';
	}
	
	if(isset($marketeer_data['google_menu_custom']) && $marketeer_data['google_menu_custom'] != ''){
		$font_menu = explode(':',$marketeer_data['google_menu_custom']);
		if(count($font_menu)>1) {
			$font_menu = $font_menu[0];
		}
		else{
			$font_menu = $marketeer_data['google_menu_custom'];
		}
	}else{
		$font_menu = explode(':',$font_menu);
		if(count($font_menu)>1) {
			$font_menu = $font_menu[0];
		}
		else{
			$font_menu = $font_menu;
		}
	}		
	
	if(isset($marketeer_data['google_quote_custom']) && $marketeer_data['google_quote_custom'] != ''){
		$font_quote = explode(':',$marketeer_data['google_quote_custom']);
		if(count($font_quote)>1) {
			$font_quote = $font_quote[0];
		}
		else{
			$font_quote = $marketeer_data['google_quote_custom'];
		}
	}else{
		$font_quote = explode(':',$font_quote);
		if(count($font_quote)>1) {
			$font_quote = $font_quote[0];
		}
		else{
			$font_quote = $font_quote;
		}
	}	

	if(isset($marketeer_data['google_heading_custom']) && $marketeer_data['google_heading_custom'] != ''){
		$font_heading = explode(':',$marketeer_data['google_heading_custom']);
		if(count($font_heading)>1) {
			$font_heading = $font_heading[0];
		}
		else{
			$font_heading= $marketeer_data['google_heading_custom'];
		}	
	}else{
		$font_heading = explode(':',$font_heading);
		if(count($font_heading)>1) {
			$font_heading = $font_heading[0];
		}
		else{
			$font_heading=$font_heading;
		}	
	}

	if(isset($marketeer_data['google_body_custom']) && $marketeer_data['google_body_custom'] != ''){
		$font_body = explode(':',$marketeer_data['google_body_custom']);
		if(count($font_body)>1) {
			$font_body = $font_body[0];
		}
		else{
			$font_body = $marketeer_data['google_body_custom'];
		}
	}else{
		$font_body = explode(':',$font_body);
		if(count($font_body)>1) {
			$font_body = $font_body[0];
		}
		else{
			$font_body = $font_body;
		}		
	}	

?>


.block_footer_text, .quote-category .blogpostcategory {font-family: <?php echo $font_quote; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
body {	 
	background:<?php echo $marketeer_data['body_background_color'].' '.$background ?>  !important;
	color:<?php echo $marketeer_data['body_font']['color']; ?>;
	font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;
	font-size: <?php echo $marketeer_data['body_font']['size']; ?>;
	font-weight: normal;
}

::selection { background: #000; color:#fff; text-shadow: none; }

h1, h2, h3, h4, h5, h6, .block1 p {font-family: <?php echo $font_heading; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
h1 { 	
	color:<?php echo $marketeer_data['heading_font_h1']['color']; ?>;
	font-size: <?php echo $marketeer_data['heading_font_h1']['size'] ?> !important;
	}
	
h2, .term-description p { 	
	color:<?php echo $marketeer_data['heading_font_h2']['color']; ?>;
	font-size: <?php echo $marketeer_data['heading_font_h2']['size'] ?> !important;
	}

h3 { 	
	color:<?php echo $marketeer_data['heading_font_h3']['color']; ?>;
	font-size: <?php echo $marketeer_data['heading_font_h3']['size'] ?> !important;
	}

h4 { 	
	color:<?php echo $marketeer_data['heading_font_h4']['color']; ?>;
	font-size: <?php echo $marketeer_data['heading_font_h4']['size'] ?> !important;
	}	
	
h5 { 	
	color:<?php echo $marketeer_data['heading_font_h5']['color']; ?>;
	font-size: <?php echo $marketeer_data['heading_font_h5']['size'] ?> !important;
	}	

h6 { 	
	color:<?php echo $marketeer_data['heading_font_h6']['color']; ?>;
	font-size: <?php echo $marketeer_data['heading_font_h6']['size'] ?> !important;
	}	

.pagenav a {font-family: <?php echo $font_menu; ?> !important;
			  font-size: <?php echo $marketeer_data['menu_font']['size'] ?>;
			  font-weight:<?php echo $marketeer_data['menu_font']['style'] ?>;
			  color:<?php echo $marketeer_data['menu_font']['color'] ?>;
}
.block1_lower_text p,.widget_wysija_cont .updated, .widget_wysija_cont .login .message, p.edd-logged-in, #edd_login_form, #edd_login_form p  {font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;color:#444;font-size:14px;}

a, select, input, textarea, button{ color:<?php echo $marketeer_data['body_link_coler']; ?>;}
h3#reply-title, select, input, textarea, button, .link-category .title a{font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}

.prev-post-title, .next-post-title, .blogmore, .more-link {font-family: <?php echo $font_heading; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}

/* ***********************
--------------------------------------
------------MAIN COLOR----------
--------------------------------------
*********************** */

a:hover, span, .current-menu-item a, .blogmore, .more-link, .pagenav.fixedmenu li a:hover, .widget ul li a:hover,.pagenav.fixedmenu li.current-menu-item > a,.block2_text a,
.blogcontent a, .sentry a, .post-meta a:hover, .sidebar .social_icons i:hover, .content.blog .single-date

{
	color:<?php echo $marketeer_data['mainColor']; ?>;
}

.su-quote-style-default  {border-left:5px solid <?php echo $marketeer_data['mainColor']; ?>;}

 
/* ***********************
--------------------------------------
------------BACKGROUND MAIN COLOR----------
--------------------------------------
*********************** */

.top-cart, .blog_social .addthis_toolbox a:hover, .widget_tag_cloud a:hover, .sidebar .widget_search #searchsubmit,
.menu ul.sub-menu li:hover, .specificComment .comment-reply-link:hover, #submit:hover, .addthis_toolbox a:hover, .wpcf7-submit:hover, #submit:hover,
.link-title-previous:hover, .link-title-next:hover, .specificComment .comment-edit-link:hover, .specificComment .comment-reply-link:hover, h3#reply-title small a:hover, .pagenav li a:after,
.widget_wysija_cont .wysija-submit,.sidebar-buy-button a, .widget ul li:before, #footer .widget_search #searchsubmit, .marketeer-lite-read-more a:hover, .blogpost .tags a:hover,
.mainwrap.single-default.sidebar .link-title-next:hover, .mainwrap.single-default.sidebar .link-title-previous:hover, .marketeer-lite-home-deals-more a:hover, .top-search-form i:hover, .edd-submit.button.blue:hover,
ul#menu-top-menu, a.catlink:hover
  {
	background:<?php echo $marketeer_data['mainColor']; ?> ;
}
.pagenav  li li a:hover {background:none;}
.edd-submit.button.blue:hover, .cart_item.edd_checkout a:hover {background:<?php echo $marketeer_data['mainColor']; ?> !important;}
.link-title-previous:hover, .link-title-next:hover {color:#fff;}
#headerwrap {background:<?php echo $marketeer_data['menu_background_color']; ?>;border-top:5px solid <?php echo $marketeer_data['mainColor']; ?>;}


 /* ***********************
--------------------------------------
------------BOXED---------------------
-----------------------------------*/
<?php if($use_boxed == 0 &&  isset($marketeer_data['use_background']) && $marketeer_data['use_background'] == 1){ ?>
	body, .cf, .mainwrap, .post-full-width, .titleborderh2, .sidebar  {
	background:<?php echo $marketeer_data['body_background_color'].' '.$background ?>  !important; 
	}
	
<?php	} ?>
 <?php if(isset($marketeer_data['use_boxed']) &&  $use_boxed == 1){ ?>
header,.outerpagewrap{background:none !important;}
header,.outerpagewrap,.mainwrap{background-color:<?php echo $marketeer_data['body_background_color'] ?> ;}
@media screen and (min-width:1220px){
body {width:1220px !important;margin:0 auto !important;}
.top-nav ul{margin-right: -21px !important;}
.mainwrap.shop {float:none;}
.pagenav.fixedmenu { width: 1220px !important;}
.bottom-support-tab,.totop{right:5px;}
<?php if($use_bg_full){ ?>
	body {
	background:<?php echo $marketeer_data['body_background_color'].' '.$background ?>  !important; 
	background-attachment:fixed !important;
	background-size:cover !important; 
	-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
	}	
<?php	} ?>
 <?php if(!$use_bg_full){ ?>
	body {
	background:<?php echo $marketeer_data['body_background_color'].' '.$background ?>  !important; 
	
	}
	
<?php	} ?>	
}
<?php } ?>
 
 
/* ***********************
--------------------------------------
------------CUSTOM CSS----------
--------------------------------------
*********************** */

<?php echo marketeer_stripText($marketeer_data['custom_style']) ?>