<?php
/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/
function of_head() { do_action( 'of_head' ); }
/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/
function optionsframework_admin_message() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
    	
        var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
	
}
add_action('admin_head', 'optionsframework_admin_message'); 
function optionsframework_woo_hide() { 
	
	//Tweaked the message on theme activate
	if (!function_exists( 'is_woocommerce' ) ) : 
		?>
		<script type="text/javascript">
		jQuery(function(){
			
			jQuery(document).ready(function(){	
				jQuery('.woocommercesettings').hide();
			});
		
		});
		</script>
		<?php
	endif;
	
}
add_action('admin_head', 'optionsframework_woo_hide'); 
/*-----------------------------------------------------------------------------------*/
/* Small function to get all header classes */
/*-----------------------------------------------------------------------------------*/
	function of_get_header_classes_array() {
		global $of_options_pmc;
		$hooks = '';
		foreach ($of_options_pmc as $value) {
			
			if ($value['type'] == 'heading') {
				$hooks[] = preg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			}
			
		}
		
		return $hooks;
		
	}
	
/*-----------------------------------------------------------------------------------*/
/* function to output css options */
/*-----------------------------------------------------------------------------------*/
	
function generate_options_css($newdata) {	$pmc_data = $newdata;	$css_dir = get_stylesheet_directory() . '/css/'; // Shorten code, save 1 call	ob_start(); // Capture all output (output buffering)	require($css_dir . 'style_options.php'); // Generate CSS	$css = ob_get_clean(); // Get generated CSS (output buffering)	    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );    wp_add_inline_style( 'style', $css );	//file_put_contents($css_dir . 'options.css', $css, LOCK_EX); // Save it}	add_action( 'wp_enqueue_scripts', 'generate_options_css' );
/* For use in themes */
$marketeer_data = get_option(OPTIONS);
?>