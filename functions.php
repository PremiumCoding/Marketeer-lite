<?php
add_action( 'after_setup_theme', 'marketeer_theme_setup' );
function marketeer_theme_setup() {
	global $marketeer_data;
	/*woocommerce support*/
	add_theme_support( 'post-formats', array( 'link', 'marketeer-lite-gallery', 'video' , 'audio', 'quote') );
	/*feed support*/
	add_theme_support( 'automatic-feed-links' );
	/*post thumb support*/
	add_theme_support( 'post-thumbnails' ); // this enable thumbnails and stuffs
	/*title*/
	add_theme_support( 'title-tag' );
	/*lang*/
	load_theme_textdomain( 'marketeer-lite', get_template_directory() . '/lang' );
	/*setting thumb size*/
	add_image_size( 'marketeer-lite-gallery', 120,80, true ); 
	add_image_size( 'marketeer-lite-widget', 285,180, true );
	add_image_size( 'marketeer-lite-postBlock', 1160, 770, true );
	add_image_size( 'marketeer-lite-related', 345,230, true );
	add_image_size( 'marketeer-lite-postGridBlock', 590,390, true );
	add_image_size( 'marketeer-lite-postGridBlock-2', 590,437, true );	
	register_nav_menus(array(
	
			'pmcmainmenu' => esc_html__('Main Menu','marketeer-lite'),
			'pmcrespmenu' => esc_html__('Responsive Menu','marketeer-lite'),	
			'pmcscrollmenu' => esc_html__('Scroll Menu','marketeer-lite'),	
			'pmctopmenu' => esc_html__('Top Menu','marketeer-lite'),	
			
	));	
	
	

	require( get_template_directory() . '/updater/theme-updater.php' );
	
		
    register_sidebar(array(
        'id' => 'sidebar',
        'name' => esc_html__('Sidebar main','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));	
	
    register_sidebar(array(
        'id' => 'sidebar-download',
        'name' => esc_html__('Sidebar on product page','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));	
		
	
    register_sidebar(array(
        'id' => 'news',
        'name' => esc_html__('Main newsletter','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));		

    register_sidebar(array(
        'id' => 'sidebar-deals-page',
        'name' => esc_html__('Sidebar for page deals','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));		 


    register_sidebar(array(
        'id' => 'sidebar-delas-blog',
        'name' => esc_html__('Blog deals sidebar','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));	 	

    register_sidebar(array(
        'id' => 'sidebar-top-left',
        'name' => esc_html__('Top sidebar left','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));		  

    register_sidebar(array(
        'id' => 'sidebar-top-right',
        'name' => esc_html__('Top sidebar right','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));		
		
 
    register_sidebar(array(
        'id' => 'footer1',
        'name' => esc_html__('Footer sidebar 1','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'id' => 'footer2',
        'name' => esc_html__('Footer sidebar 2','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
	
    
    register_sidebar(array(
        'id' => 'footer3',
        'name' => esc_html__('Footer sidebar 3','marketeer-lite'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
	
	if(isset($marketeer_data['sidebar'])){
	$sidebars = $marketeer_data['sidebar'];
	$sidebarOut = '';
		foreach($sidebars as $sidebar){
			$title = $sidebar['title'];
			$id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $sidebar['title']);
			$id = strtolower(str_replace(' ', '' , $id));
			register_sidebar(array(
				'id' => $id,
				'name' => $title ,
				'description' =>esc_html__('This is custom widget added via theme options.', 'marketeer-lite'),
				'before_widget' => '<div class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			));			
		}
	}		


	
	// Responsive walker menu
	class marketeer_Walker_Responsive_Menu extends Walker_Nav_Menu {
		
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			global $wp_query;		
			$item_output = $attributes = $prepend ='';
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( '', array_filter( $classes ), $item ) );			
			$class_names = ' class="'. esc_attr( $class_names ) . '"';			   
			// Create a visual indent in the list if we have a child item.
			$visual_indent = ( $depth ) ? str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i>', $depth) : '';
			// Load the item URL
			$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
			// If we have hierarchy for the item, add the indent, if not, leave it out.
			// Loop through and output each menu item as this.
			if($depth != 0) {
				$item_output .= '<a '. $class_names . $attributes .'>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i>' . $item->title. '</a><br>';
			} else {
				$item_output .= '<a ' . $class_names . $attributes .'><strong>'.$prepend.$item->title.'</strong></a><br>';
			}
			// Make the output happen.
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	
	// Main walker menu	
	class marketeer_Walker_Main_Menu extends Walker_Nav_Menu
	{		
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		   $this->curItem = $item;
		   global $wp_query;
		   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		   $class_names = $value = '';
		   $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		   $class_names = ' class="'. esc_attr( $class_names ) . '"';
		   $image  = ! empty( $item->custom )     ? ' <img src="'.esc_attr($item->custom).'">' : '';
		   $output .= $indent . '<li id="menu-item-'.rand(0,9999).'-'. $item->ID . '"' . $value . $class_names .'>';
		   $attributes_title  = ! empty( $item->attr_title ) ? ' <i class="fa '  . esc_attr( $item->attr_title ) .'"></i>' : '';
		   $attributes  = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		   $prepend = '';
		   $append = '';
		   if($depth != 0)
		   {
				$append = $prepend = '';
		   }
			$item_output = $args->before;
			$item_output .= '<a '. $attributes .'>';
			$item_output .= $attributes_title.$args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $args->link_after;
			$item_output .= '</a>';	
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	

}




/*-----------------------------------------------------------------------------------*/
// Options Framework
/*-----------------------------------------------------------------------------------*/
// Paths to admin functions
define('ADMIN_PATH', get_template_directory() . '/admin/');
define('BOX_PATH', get_template_directory() . '/includes/boxes/');
define('ADMIN_DIR', get_template_directory_uri() . '/admin/');
define('LAYOUT_PATH', ADMIN_PATH . '/layouts/');
define('OPTIONS', 'of_options_pmc'); // Name of the database row where your options are stored
add_option('IMPORT_MARKETEER', 'false');
require_once (get_template_directory() . '/admin/import/plugins/options-importer.php');   // Options panel settings and custom settings
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	if(get_option('IMPORT_MARKETEER') == 'false'){
		import(get_template_directory() . '/admin/import/options.json');
		update_option('IMPORT_MARKETEER', 'true');
		wp_redirect(  esc_url_raw(admin_url( 'themes.php?page=optionsframework&pmc_import=false' )) );
	}
	else{
		wp_redirect(  esc_url_raw(admin_url( 'themes.php?page=optionsframework' )) );
	}
}

// Build Options

require_once (get_template_directory() . '/admin/theme-options.php');   // Options panel settings and custom settings
require_once (get_template_directory() . '/admin/admin-interface.php');  // Admin Interfaces
require_once (get_template_directory() . '/admin/admin-functions.php');  // Theme actions based on options settings
$includes =  get_template_directory() . '/includes/';
$widget_includes =  get_template_directory() . '/includes/widgets/';
/* include custom widgets */
require_once ($widget_includes . 'recent_post_widget.php'); 
require_once ($widget_includes . 'popular_post_widget.php');
require_once ($widget_includes . 'social_widget.php');
require_once ($widget_includes . 'deals_widget.php');
/* include scripts */
function marketeer_scripts() {
	global $marketeer_data;
	/*scripts*/
	wp_enqueue_script('fitvideos', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'),true,true);	
	wp_enqueue_script('scrollto', get_template_directory_uri() . '/js/jquery.scrollTo.js', array('jquery'),true,true);	
	wp_enqueue_script('retinaimages', get_template_directory_uri() . '/js/retina.min.js', array('jquery'),true,true);	
	wp_enqueue_script('marketeer_customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'),true,true);  	      
	wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'),true,true);
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'),true,true);
	wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', array('jquery'),true,true);		
	wp_register_script('news', get_template_directory_uri() . '/js/jquery.li-scroller.1.0.js', array('jquery'),true,true);  
	wp_enqueue_script('gistfile', get_template_directory_uri() . '/js/gistfile_pmc.js', array('jquery') ,true,true);  
	wp_enqueue_script('bxSlider', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery') ,true,false);  	
	wp_enqueue_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery') ,true,true);  
	wp_enqueue_script('infinity', get_template_directory_uri() . '/js/pmc_infinity.js', array('jquery') ,true,false);  	
	/*style*/
	wp_enqueue_style( 'main', get_stylesheet_uri(), 'style');
	wp_enqueue_style( 'prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style');
	/*style*/
	wp_enqueue_style( 'main', get_stylesheet_uri(), 'style');
	
	
	if(isset($marketeer_data['body_font'])){			
		if(($marketeer_data['body_font']['face'] != 'verdana') and ($marketeer_data['body_font']['face'] != 'trebuchet') and 
			($marketeer_data['body_font']['face'] != 'georgia') and ($marketeer_data['body_font']['face'] != 'Helvetica Neue') and 
			($marketeer_data['body_font']['face'] != 'times,tahoma') and ($marketeer_data['body_font']['face'] != 'arial')) {	
				if(isset($marketeer_data['google_body_custom']) && $marketeer_data['google_body_custom'] != ''){
					$font_explode = explode(' ' , $marketeer_data['google_body_custom']);
					$font_body  = '';
					$size = count($font_explode);
					$count = 0;
					if(count($font_explode) > 0){
						foreach($font_explode as $font){
							if($count < $size-1){
								$font_body .= $font_explode[$count].'+';
							}
							else{
								$font_body .= $font_explode[$count];
							}
							$count++;
						}
					}else{
						$font_body = $marketeer_data['google_body_custom'];
					}
				}else{
					$font_body = $marketeer_data['body_font']['face'];
				}			
				wp_enqueue_style('googleFontbody', 'https://fonts.googleapis.com/css?family='.$font_body ,'',NULL);			
		}						
	}		
	if(isset($marketeer_data['heading_font'])){			
		if(($marketeer_data['heading_font']['face'] != 'verdana') and ($marketeer_data['heading_font']['face'] != 'trebuchet') and 
			($marketeer_data['heading_font']['face'] != 'georgia') and ($marketeer_data['heading_font']['face'] != 'Helvetica Neue') and 
			($marketeer_data['heading_font']['face'] != 'times,tahoma') and ($marketeer_data['heading_font']['face'] != 'arial')) {	
				if(isset($marketeer_data['google_heading_custom']) && $marketeer_data['google_heading_custom'] != ''){
					$font_explode = explode(' ' , $marketeer_data['google_heading_custom']);
					$font_heading  = '';
					$size = count($font_explode);
					$count = 0;
					if(count($font_explode) > 0){
						foreach($font_explode as $font){
							if($count < $size-1){
								$font_heading .= $font_explode[$count].'+';
							}
							else{
								$font_heading .= $font_explode[$count];
							}
							$count++;
						}
					}else{
						$font_heading = $marketeer_data['google_heading_custom'];
					}
				}else{
					$font_heading = $marketeer_data['heading_font']['face'];
				}
		
				wp_enqueue_style('googleFontHeading', 'https://fonts.googleapis.com/css?family='.$font_heading ,'',NULL);			
		}						
	}
	if(isset($marketeer_data['menu_font']['face'])){			
		if(($marketeer_data['menu_font']['face'] != 'verdana') and ($marketeer_data['menu_font']['face'] != 'trebuchet') and 
			($marketeer_data['menu_font']['face']!= 'georgia') and ($marketeer_data['menu_font']['face'] != 'Helvetica Neue') and 
			($marketeer_data['menu_font']['face'] != 'times,tahoma') and ($marketeer_data['menu_font']['face'] != 'arial')) {	
				if(isset($marketeer_data['google_menu_custom']) && $marketeer_data['google_menu_custom'] != ''){
					$font_explode = explode(' ' , $marketeer_data['google_menu_custom']);
					$font_menu  = '';
					$size = count($font_explode);
					$count = 0;
					if(count($font_explode) > 0){
						foreach($font_explode as $font){
							if($count < $size-1){
								$font_menu .= $font_explode[$count].'+';
							}
							else{
								$font_menu .= $font_explode[$count];
							}
							$count++;
						}
					}else{
						$font_menu = $marketeer_data['google_menu_custom'];
					}
					wp_enqueue_style('googleFontMenu', 'https://fonts.googleapis.com/css?family='.$font_menu ,'',NULL);	
				}
		}						
	}	
	
	/* FONT FOR QUOTE */
	
	if(isset($marketeer_data['google_quote_custom']) && $marketeer_data['google_quote_custom'] != ''){
		$font_explode = explode(' ' , $marketeer_data['google_quote_custom']);
		$font_quote  = '';
		$size = count($font_explode);
		$count = 0;
		if(count($font_explode) > 0){
			foreach($font_explode as $font){
				if($count < $size-1){
					$font_quote .= $font_explode[$count].'+';
							}
				else{
					$font_quote .= $font_explode[$count];
					}
				$count++;
			}
		}else{
			$font_quote = $marketeer_data['google_quote_custom'];
		}
		wp_enqueue_style('googleFontQuote', 'https://fonts.googleapis.com/css?family='.$font_quote ,'',NULL);
	}


	wp_enqueue_script('font-awesome_pms', 'https://use.fontawesome.com/30ede005b9.js' , '',null,true);
	
			
}
add_action( 'wp_enqueue_scripts', 'marketeer_scripts' );
 
/*add boxed to body class*/

add_filter('body_class','marketeer_body_class');

function marketeer_body_class($classes) {
	global $marketeer_data;
	$class = '';
	if(isset($marketeer_data['use_boxed'])){
		$classes[] = 'marketeer_boxed';
	}
	return $classes;
}

/* custom breadcrumb */
function marketeer_breadcrumb($title = false) {
	global $marketeer_data;
	$breadcrumb = '';
	if (!is_home()) {
		if($title == false){
			$breadcrumb .= '<a href="';
			$breadcrumb .=  esc_url(home_url('/'));
			$breadcrumb .=  '">';
			$breadcrumb .= esc_html__('Home', 'marketeer-lite');
			$breadcrumb .=  "</a> &#187; ";
		}
		if (is_single()) {
			if (is_single()) {
				$name = '';
				if(!get_query_var($marketeer_data['port_slug']) && !get_query_var('product')){
					$category = get_the_category(); +
					$category_id = get_cat_ID($category[0]->cat_name);
					$category_link = get_category_link($category_id);					
					$name = '<a href="'. esc_url( $category_link ).'">'.$category[0]->cat_name .'</a>';
				}
				else{
					$taxonomy = 'portfoliocategory';
					$entrycategory = get_the_term_list( get_the_ID(), $taxonomy, '', ',', '' );
					$catstring = $entrycategory;
					$catidlist = explode(",", $catstring);	
					$name = $catidlist[0];
				}
				if($title == false){
					$breadcrumb .= $name .' &#187; <span>'. get_the_title().'</span>';
				}
				else{
					$breadcrumb .= get_the_title();
				}
			}	
		} elseif (is_page()) {
			$breadcrumb .=  '<span>'.get_the_title().'</span>';
		}
		elseif(get_query_var('portfoliocategory')){
			$term = get_term_by('slug', get_query_var('portfoliocategory'), 'portfoliocategory'); $name = $term->name; 
			$breadcrumb .=  '<span>'.$name.'</span>';
		}	
		else if(is_tag()){
			$tag = get_query_var('tag');
			$tag = str_replace('-',' ',$tag);
			$breadcrumb .=  '<span>'.$tag.'</span>';
		}
		else if(is_search()){
			$breadcrumb .= esc_html__('Search results for ', 'marketeer-lite') .'"<span>'.get_search_query().'</span>"';			
		} 
		else if(is_category()){
			$cat = get_query_var('cat');
			$cat = get_category($cat);
			$breadcrumb .=  '<span>'.$cat->name.'</span>';
		}
		else if(is_archive()){
			$breadcrumb .=  '<span>'.esc_html__('Archive','marketeer-lite').'</span>';
		}	
		else{
			$breadcrumb .=  esc_html__('Home','marketeer-lite');
		}

	}
	return $breadcrumb ;
}
/* social share links */
function marketeer_socialLinkSingle($link,$title) {
	$social = '';
	$social  .= '<div class="addthis_toolbox">';
	$social .= '<div class="custom_images">';
	$social .= '<a class="addthis_button_facebook" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'" ><i class="fa fa-facebook"></i></a>';
	$social .= '<a class="addthis_button_twitter" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-twitter"></i></a>';  
	$social .= '<a class="addthis_button_pinterest_share" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-pinterest"></i></a>'; 
	$social .= '<a class="addthis_button_google_plusone_share" addthis:url="'.esc_url($link).'" g:plusone:count="false" addthis:title="'.esc_attr($title).'"><i class="fa fa-google-plus"></i></a>'; 	
	$social .= '<a class="addthis_button_stumbleupon" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-stumbleupon"></i></a>';
	$social .='</div><script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js"></script>';	
	$social .= '</div>'; 
	echo $social;
	
	
}
/* links to social profile */
function marketeer_socialLink() {
	$social = '';
	global $marketeer_data; 
	$icons = $marketeer_data['socialicons'];
	if(is_array($icons)){
		foreach ($icons as $icon){
			$social .= '<a target="_blank"  href="'.esc_url($icon['link']).'" title="'.esc_attr($icon['title']).'"><i class="fa '.esc_attr($icon['url']).'"></i></a>';	
		}
	}
	echo $social;
}

add_filter('the_content', 'marketeer_addlightbox');
/* add lightbox to images*/
function marketeer_addlightbox($content)
{	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
  	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox[%LIGHTID%]"$6>';
    $content = preg_replace($pattern, $replacement, $content);
	if(isset($post->ID))
		$content = str_replace("%LIGHTID%", $post->ID, $content);
    return $content;
}
/* remove double // char */
function marketeer_stripText($string) 
{ 
    return str_replace("\\",'',$string);
} 
	
/* custom post types */	
add_action('save_post', 'marketeer_update_post_type');
add_action("admin_init", "marketeer_add_meta_box");
add_action("admin_init", "marketeer_add_meta_box_sidebar");

function marketeer_add_meta_box_sidebar(){
	add_meta_box("marketeer_post_sidebar", "Image options", "marketeer_post_sidebar", "post", "side", "high");		
	add_meta_box("marketeer_post_sidebar", "marketeer-lite options", "marketeer_post_sidebar_download", "download", "side", "high");		
}	

function marketeer_post_sidebar(){
	global $post;
	$marketeer_data = get_post_custom(get_the_id());
	
	
	if (isset($marketeer_data["marketeer_featured_category"][0])){
		$marketeer_featured_category = $marketeer_data["marketeer_featured_category"][0];
	}else{
		$marketeer_featured_category = 1;
		$marketeer_data["marketeer_featured_category"][0] = 1;
	}	
	if (isset($marketeer_data["marketeer_featured_post"][0])){
		$marketeer_featured_post = $marketeer_data["marketeer_featured_post"][0];
	}else{
		$marketeer_featured_post = 1;
		$marketeer_data["marketeer_featured_post"][0] = 1;
	}		
?>
    <div id="marketeer-lite-sidebar">
        <table cellpadding="15" cellspacing="15">
            <tr>
                <td><input type="checkbox" name="marketeer_featured_category" value="1" <?php if( isset($marketeer_featured_category)){ checked( '1', $marketeer_data["marketeer_featured_category"][0] ); } ?> /><td><label>Show featured Image in category:</label></td></td>	
            </tr>
            <tr>
                <td><input type="checkbox" name="marketeer_featured_post" value="1" <?php if( isset($marketeer_featured_post)){ checked( '1', $marketeer_data["marketeer_featured_post"][0] ); } ?> /><td><label>Show featured Image in post view:</label></td></td>	
            </tr>			
        </table>
    </div>
      
<?php
	
}

function marketeer_post_sidebar_download(){
	global $post;
	$marketeer_data = get_post_custom(get_the_id());
	
	
	if (isset($marketeer_data["date"][0])){
		$date = $marketeer_data["date"][0];
	}else{
		$date = '';
	}	
	if (isset($marketeer_data["price"][0])){
		$price = $marketeer_data["price"][0];
	}else{
		$price = '';
	}		
	
?>
    <div id="marketeer-lite-sidebar">
        <table cellpadding="15" cellspacing="15">
            <tr>
                <td>
				<label>Select date for countdown: <br><b>(leave empty if you don't wish to display countdown)</b></label>
				<input type="datetime-local" name="date" value="<?php echo $date ?>" /><td></td></td>	
            </tr>	
            <tr>
                <td>
				<label>Regular price:<br><b> (without currency symbol !!!)</b></label>
				<input type="number" name="price" value="<?php echo $price ?>" /><td></td></td>	
            </tr>			
        </table>
    </div>
      
<?php
	
}

function marketeer_add_meta_box(){
	add_meta_box("marketeer_post_type", "marketeer-lite options", "marketeer_post_type", "post", "normal", "high");	
	
}	





function marketeer_post_type(){
	global $post;
	$marketeer_data = get_post_custom(get_the_id());

	if (isset($marketeer_data["video_post_url"][0])){
		$video_post_url = $marketeer_data["video_post_url"][0];
	}else{
		$video_post_url = "";
	}	
	
	if (isset($marketeer_data["link_post_url"][0])){
		$link_post_url = $marketeer_data["link_post_url"][0];
	}else{
		$link_post_url = "";
	}	
	
	if (isset($marketeer_data["audio_post_url"][0])){
		$audio_post_url = $marketeer_data["audio_post_url"][0];
	}else{
		$audio_post_url = "";
	}
	if (isset($marketeer_data["subtitle"][0])){
		$subtitle = $marketeer_data["subtitle"][0];
	}else{
		$subtitle = "";		
	}	

?>
    <div id="portfolio-category-options">
        <table cellpadding="15" cellspacing="15">
            <tr class="subtitle" style="border-bottom:1px solid #000;">
            	<td><label>Post subtitle: <i style="color: #999999;"></i></label><br><textarea name="subtitle" /><?php echo esc_attr($subtitle); ?></textarea> </td>	
			</tr>			
            <tr class="videoonly" style="border-bottom:1px solid #000;">
            	<td><label>Video URL(*required) - add if you select video post: <i style="color: #999999;"></i></label><br><input name="video_post_url" value="<?php echo esc_attr($video_post_url); ?>" /> </td>	
			</tr>		
            <tr class="linkonly" >
            	<td><label>Link URL - add if you select link post : <i style="color: #999999;"></i></label><br><input name="link_post_url"  value="<?php echo esc_attr($link_post_url); ?>" /></td>
            </tr>				
            <tr class="audioonly">
            	<td><label>Audio URL - add if you select audio post (audio from <a target="_blank"  href="https://soundcloud.com/">SoundCloud</a>)<br>You also need to install plugin <a target="_blank" href="https://wordpress.org/plugins/soundcloud-shortcode/">SoundCloud Shortcode</>: <i style="color: #999999;"></i></label><br><input name="audio_post_url"  value="<?php echo esc_attr($audio_post_url); ?>" /></td>
            </tr>	
            <tr class="nooptions">
            	<td>No options for this post type.</td>
            </tr>				
        </table>
    </div>
	<style>
	div#portfolio-category-options table {width:100%;}
	div#portfolio-category-options td textarea {width:100%; height:80px}
	#portfolio-category-options input {width:100%}
	</style>
	<script>
	jQuery(document).ready(function(){	
			if (jQuery("input[name=post_format]:checked").val() == 'video'){
				jQuery('.videoonly').show();
				jQuery('.audioonly, .linkonly , .nooptions').hide();}
				
			else if (jQuery("input[name=post_format]:checked").val() == 'link'){
				jQuery('.linkonly').show();
				jQuery('.videoonly, .select_video,.nooptions').hide();	}	
				
			else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
				jQuery('.videoonly, .linkonly,.nooptions').hide();	
				jQuery('.audioonly').show();}						
			else{
				jQuery('.videoonly').hide();
				jQuery('.audioonly').hide();
				jQuery('.linkonly').hide();
				jQuery('.nooptions').show();}	
			
			jQuery("input[name=post_format]").change(function(){
			if (jQuery("input[name=post_format]:checked").val() == 'video'){
				jQuery('.videoonly').show();
				jQuery('.audioonly, .linkonly,.nooptions').hide();}
				
			else if (jQuery("input[name=post_format]:checked").val() == 'link'){
				jQuery('.linkonly').show();
				jQuery('.videoonly, .audioonly,.nooptions').hide();	}	
				
			else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
				jQuery('.videoonly, .linkonly,.nooptions').hide();	
				jQuery('.audioonly').show();}	
				
			else{
				jQuery('.videoonly').hide();
				jQuery('.audioonly').hide();
				jQuery('.linkonly').hide();
				jQuery('.nooptions').show();}				
		});
	});
	</script>	
      
<?php
	
}
function marketeer_update_post_type(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){

		if( isset($_POST["video_post_url"]) ) {
			update_post_meta($post->ID, "video_post_url", $_POST["video_post_url"]);
		}		
		if( isset($_POST["link_post_url"]) ) {
			update_post_meta($post->ID, "link_post_url", $_POST["link_post_url"]);
		}	
		if( isset($_POST["audio_post_url"]) ) {
			update_post_meta($post->ID, "audio_post_url", $_POST["audio_post_url"]);
		}		
		if( isset($_POST["marketeer_featured_category"]) ) {
			update_post_meta($post->ID, "marketeer_featured_category", $_POST["marketeer_featured_category"]);
		}else{
			update_post_meta($post->ID, "marketeer_featured_category", 0);
		}		
		if( isset($_POST["marketeer_featured_post"]) ) {
			update_post_meta($post->ID, "marketeer_featured_post", $_POST["marketeer_featured_post"]);
		}else{
			update_post_meta($post->ID, "marketeer_featured_post", 0);
		}		
		if( isset($_POST["subtitle"]) ) {
			update_post_meta($post->ID, "subtitle", $_POST["subtitle"]);
		}	
		if( isset($_POST["date"]) ) {
			update_post_meta($post->ID, "date", $_POST["date"]);
		}			
		if( isset($_POST["price"]) ) {
			update_post_meta($post->ID, "price", $_POST["price"]);
		}					
		
	}
	
	
	
}
if( !function_exists( 'marketeer_fallback_menu' ) )
{

	function marketeer_fallback_menu()
	{
		$current = "";
		if (is_front_page()){$current = "class='current-menu-item'";} 
		echo "<div class='fallback_menu'>";
		echo "<ul class='marketeer_fallback menu'>";
		echo "<li $current><a href='".esc_url(esc_url(home_url('/')))."'>Home</a></li>";
		wp_list_pages('title_li=&sort_column=menu_order');
		echo "</ul></div>";
	}
}

add_filter( 'the_category', 'marketeer_add_nofollow_cat' );  

function marketeer_add_nofollow_cat( $text ) { 
	$text = str_replace('rel="category tag"', "", $text); 
	return $text; 
}

/* get image from post */
function marketeer_getImage($id, $image){
	$return = '';
	if ( has_post_thumbnail() ){
		$return = get_the_post_thumbnail($id,$image);
		}
	else
		$return = '';
	
	return 	$return;
}

if ( ! isset( $content_width ) ) $content_width = 800;


function marketeer_add_this_script_footer(){ 
	global $marketeer_data;


?>
<script>	
	jQuery(document).ready(function(){	
		jQuery('.searchform #s').attr('value','<?php _e('Search and hit enter...','marketeer-lite'); ?>');
		
		jQuery('.searchform #s').focus(function() {
			jQuery('.searchform #s').val('');
		});
		
		jQuery('.searchform #s').focusout(function() {
			if(jQuery('.searchform #s').attr('value') == '')
				jQuery('.searchform #s').attr('value','<?php _e('Search and hit enter...','marketeer-lite'); ?>');
		});	
		jQuery("a[rel^='lightbox']").prettyPhoto({theme:'light_rounded',show_title: true, deeplinking:false,callback:function(){scroll_menu()}});		
	});	</script>

<?php  }


add_action('wp_footer', 'marketeer_add_this_script_footer'); 

function marketeer_security($string){
	echo stripslashes(wp_kses(stripslashes($string),array('img' => array('src' => array(),'alt'=>array()),'a' => array('href' => array()),'span' => array(),'div' => array('class' => array()),'b' => array(),'strong' => array(),'br' => array(),'p' => array()))); 

}

/* SEARCH FORM */
function marketeer_search_form( $form ) {
	$form = '<form method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<i class="fa fa-search search-desktop"></i>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'marketeer_search_form' );



	add_action('save_post', 'marketeer_update_post_rev');
	add_action("admin_init", "marketeer_add_rev");
	
	function marketeer_add_rev(){
	
	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			"marketeer_post_content", "marketeer-lite Options", "marketeer_post_content",
			$screen,'side','high'
		);
	}	
		
		
	}	
	


	
	function marketeer_post_content(){	
		global $post;	
		$marketeer_data = get_post_custom(get_the_id());
		if (isset($marketeer_data["custom_post_rev"][0])){		
			$custom_post_rev = $marketeer_data["custom_post_rev"][0];	
		}else{		
			$custom_post_rev = "";	
		}		
		global $wp_registered_sidebars;
		if (isset($marketeer_data["sidebar"][0])){
			$sidebar = $marketeer_data["sidebar"][0];
		}else{
			$sidebar = "";
		}	?>	
         <table cellpadding="15" cellspacing="0">	
			<tr class="sidebar">
			<td><label>Select custom sidebar for deals page: </label>	
			<br>
		     <select id="sidebar" name="sidebar">
				<?php foreach ( $wp_registered_sidebars as $sidebar_out ) : ?>
					  
					<option value="<?php echo $sidebar_out['id']; ?>"<?php if($sidebar_out['id'] == $sidebar) echo 'selected'; ?>><?php echo $sidebar_out['name']; ?></option>
				<?php endforeach; ?>
			</select>	
			</td>
			</tr>
			<tr>
			<td><label>Select custom revolution slider: </label>				
			<br>	
				<?php if(shortcode_exists( 'rev_slider')) {  ?>
				<select id="custom_post_rev"  name="custom_post_rev">	
				<option value="empty" <?php if($custom_post_rev == 'empty') echo 'selected'; ?>>Empty</option>	
				<?php 				
				$slider = new RevSlider();				
				$arrSliders = $slider->getArrSliders();				
				if(!empty($arrSliders)){ 	
					$revSliderArray = array();					
					foreach($arrSliders as $sliders){ ?>
						<option value="<?php echo $sliders->getAlias(); ?>" <?php if($sliders->getAlias() == $custom_post_rev) echo 'selected'; ?>>
						<?php echo $sliders->getShowTitle() ?>
						</option>						
					<?php
					} 						
				}																
				?>

				<?php } ?>
			</td>            
			</tr>		
		</table>  
	<script>
	jQuery(document).ready(function(){	
			if (jQuery("#page_template").val() == 'page-sidebar-deals.php'){
				jQuery('.sidebar').show();

				}				
			else{
				jQuery('.sidebar').hide();}	
				
			jQuery("#page_template").change(function(){
			if (jQuery("#page_template").val() == 'page-sidebar-deals.php'){
				jQuery('.sidebar').show();

				}				
			else{
				jQuery('.sidebar').hide();}					
		});				
			
	});
	</script>		
		
	<?php	
	}
	
	function marketeer_update_post_rev()
	{
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){

		if( isset($_POST["custom_post_rev"]) ) {
			update_post_meta($post->ID, "custom_post_rev", $_POST["custom_post_rev"]);
		}		
		if( isset($_POST["sidebar"]) ) {
			update_post_meta($post->ID, "sidebar", $_POST["sidebar"]);
		}	
	}
	}
	
/*the_excerpt*/

function marketeer_excerpt_length( $length ) {
	global $marketeer_data;
	if(isset($marketeer_data['grid_blog'])){
		switch($marketeer_data['grid_blog']){
		case 2:
			return 45;
		break;		
		case 3:
			return 30;
		break;	
		}
	}
	else {
		return 30;
	}

}
add_filter( 'excerpt_length', 'marketeer_excerpt_length', 999 );


add_filter( 'the_content_more_link', 'marketeer_modify_read_more_link' );
function marketeer_modify_read_more_link() {
return '<div class="marketeer-lite-read-more"><a class="more-link" href="' . get_permalink() . '">'.esc_html__('Continue reading','marketeer-lite').'</a></div>';
}

add_filter('dynamic_sidebar_params','marketeer_blog_widgets');
 
/* Register our callback function */
function marketeer_blog_widgets($params) {	 
 
     global $blog_widget_num; //Our widget counter variable
 
     //Check if we are displaying "Footer Sidebar"
      if(isset($params[0]['id']) && $params[0]['id'] == 'sidebar-delas-blog'){
         $blog_widget_num++;
		$divider = 2; //This is number of widgets that should fit in one row		
 
         //If it's third widget, add last class to it
         if($blog_widget_num % $divider == 0){
	    $class = 'class="last '; 
	    $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);
	 }
 
	}
 
      return $params;
}

function marketeer_countdown($date){
	$product_until = explode('T',$date);
	$product_until_date = explode('-',$product_until[0]);
	$year = $product_until_date['0'];
	$month = $product_until_date['1'];
	$day = $product_until_date['2'];
	$product_until_time = explode(':',$product_until[1]);
	$hour = $product_until_time[0];
	$minute = $product_until_time[1];

	?>
	<div class="single-date">
		<input type="hidden" value="<?php echo $date ?>">
		 <?php 
		 if(shortcode_exists( 'countdown' )){
			echo esc_html__('ends in:','marketeer-lite').' '.do_shortcode('[countdown id="'.rand().'" until="'.$month.','.$day.','.$year.','.$hour.','.$minute.'"]'); 
		 }
		 ?>

	</div>	
	<?php
}

/*edd*/
add_filter( 'edd_add_schema_microdata', '__return_false' );


?>