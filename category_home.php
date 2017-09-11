<?php 
get_header(); 
global $marketeer_data ?>
			<?php
			$taxonomy = 'download_category'; // EDD's taxonomy for categories
			$categories_download = get_terms( $taxonomy );			
					
			
			?>
			<?php if(!empty($marketeer_data['use_sort'])) { ?>
				<div id="remove" class="portfolioremove" data-option-key="filter">
					<h2>
					<a class="catlink" href="#filter" data-option-value="*"><?php _e('Show All','marketeer-lite'); ?> <span> </span></a>
					<?php
					foreach ($categories_download as $category) {
					$find =     array("&", "/", " ","amp;","&#38;");
					$replace  = array("", "", "", "","");
					$entrycategory = str_replace($find , $replace, $category->name);
						echo '<a class="catlink" href="#filter" data-option-value=".'.$entrycategory .'" >'.$category->name.' <span class="aftersortingword"> </span></a>';
					}
					?>
					</h2>
				</div>		
			<?php } ?>

			$count = $advertise = 0;
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$query_custom = new WP_Query(
			array( 
				   'post_type' => 'download',
				   'paged'         => $paged,
			) );			
			if ($query_custom->have_posts()) : ?>
			$count++;$advertise++;
			$category_download_single = get_the_terms(get_the_ID(), 'download_category' );
			$category_sort = $entrycategory = '';
			foreach ($category_download_single as $category) {
				$find =     array("&", "/", " ","amp;","&#38;");
				$replace  = array("", "", "", "","");		
				$entrycategory = str_replace($find , $replace, $category->name);				
				$category_sort = $category_sort .' '. $entrycategory;
			}
			?>
			<div class="blogpostcategory <?php if($count == 3){ echo 'last';$count=0;}?> item <?php echo $category_sort ?>"  data-option-value="<?php echo $category_sort ?>">
					<a class="overdefultlink" href="<?php the_permalink() ?>">
					<div class="blogimage">	
				<?php if(!has_post_thumbnail(get_the_id())) { ?>
				<?php } ?>
				<?php if(!empty($postmeta["date"][0])) { 
					marketeer_countdown(esc_html($postmeta["date"][0]));
				} ?>
				<div class="bundle-price <?php if(empty($postmeta["date"][0])) { echo 'no-countdown' ;}?> ">
					<div class="big-price"><?php if(empty($postmeta["date"][0])) { esc_html_e('Special price:','marketeer-lite') ;}?> <?php edd_price($post->ID); ?></div>
					<?php if (!empty($postmeta["price"][0])) {?>
						<div class="small-price"><?php if(empty($postmeta["date"][0])) { esc_html_e('Regular price:','marketeer-lite') ;}?> <?php echo edd_currency_filter(esc_html($postmeta["price"][0])); ?></div>
					<?php } ?>
				</div>


			
				endwhile; 
				?>
				
		<?php
			get_template_part('includes/wp-pagenavi','navigation');
			if(function_exists('wp_pagenavi') && ($query_custom->found_posts > get_option('posts_per_page'))) { wp_pagenavi(); }
		?>		
		<?php wp_reset_postdata();  ?>	
		<script>
		<?php if(!empty($marketeer_data['use_sort'])) { ?>
			jQuery(function(){
		
			  var $container = jQuery('#marketeer-lite-grid-sort');
			  $container.isotope({
				itemSelector : '.item',
				transitionDuration: '0.8s'
			  });
			  
			  
			  var $optionSets = jQuery('#remove'),
				  $optionLinks = $optionSets.find('a');
			  $optionLinks.click(function(){

				var $this = jQuery(this);
				// don't proceed if already selected
				if ( $this.hasClass('selected') ) {
				  return false;
				}
				var $optionSet = $this.parents('#remove');
				$optionSet.find('.selected').removeClass('selected');
				$this.addClass('selected');

				// make option object dynamically, i.e. { filter: '.my-filter-class' }
				var options = {},
					key = $optionSet.attr('data-option-key'),
					value = $this.attr('data-option-value');
				// parse 'false' as false boolean
				value = value === 'false' ? false : value;
				options[ key ] = value;
				if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
				  // changes in layout modes need extra logic
				  changeLayoutMode( $this, options )
				} else {
				  // otherwise, apply new options
				  $container.isotope( options );
				}
				
				return false;
			  });
			  

			jQuery(window).on('load', function(){
		
				$container.isotope('layout');
			});

			  
			jQuery( window ).resize(function() {	
				$container.isotope('layout');
						
			});	
			<?php } ?>



	
			
			});
			
			
			</script>

