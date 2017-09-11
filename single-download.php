<?php get_header();  ?>
<?php global $marketeer_data;
?>
<!-- top bar with breadcrumb and post navigation -->

<!-- main content start -->
<div class="mainwrap single-default sidebar">
	<div class="main clearfix">	
	<?php if (have_posts()) : while (have_posts()) : the_post();  $postmeta = get_post_custom(get_the_id());  ?>
	
	<div class="content singledefult">
		<div class="postcontent singledefult" id="post-<?php  get_the_id(); ?>" <?php post_class(); ?>>		
			<div class="blogpost">		
				<div class="posttext">
					<div class="topBlog">	
						<?php if(isset($marketeer_data['display_post_meta'])) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php echo get_the_date() ?></a><a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','marketeer-lite'); echo get_the_author(); ?></a><a href="#commentform"><?php comments_number(); ?></a><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'marketeer-lite' ) ) . '</em>'; ?>
						</div>
						<?php } ?> 					
						<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if(isset($postmeta["subtitle"][0])) { ?>
							<div class="subtitle">
								<?php marketeer_security($postmeta["subtitle"][0]); ?>
							</div>				
						<?php } ?>
						<!-- end of post meta -->
					</div>		
						 
						<div class="blogsingleimage">			
								<?php echo marketeer_getImage(get_the_id(), 'marketeer-lite-postBlock'); ?>
						</div>
		

	
					<div class="sentry">
						    <?php add_filter('the_content', 'marketeer_addlightbox'); ?>
							<div><?php the_content(); ?></div>		
						<div class="post-page-links"><?php wp_link_pages(); ?></div>
						<div class="singleBorder"></div>
					</div>
				</div>
				
				<?php if(isset($marketeer_data['single_display_tags'])) { ?>
				<?php if(has_tag()) { ?>
					<div class="tags"><?php the_tags('',' ',''); ?></div>	
				<?php } ?>
				<?php } ?>
				
				
			</div>						
			
		</div>	

		
		<?php if(isset($marketeer_data['single_display_post_navigation'])) { ?>
		<div class = "post-navigation">
			<?php next_post_link('%link', '<div class="link-title-previous"><span>&#171; '.esc_html__('Previous boundle','marketeer-lite').'</span><div class="prev-post-title">%title</div></div>' ,false,''); ?> 
			<?php previous_post_link('%link','<div class="link-title-next"><span>'.esc_html__('Next bundle','marketeer-lite').' &#187;</span><div class="next-post-title">%title</div></div>',false,''); ?> 
		</div>
		<?php } ?> <!-- end of post navigation -->
		
		<?php endwhile; else: ?>
						
			<?php get_template_part('404','error-page'); ?>
		<?php endif; ?>
		</div>
		
		

		<div class="sidebar product-page">		
			<div class="bundle-price">
				<div class="big-price"><?php edd_price($post->ID); ?></div>
				<div class="small-price"><?php echo edd_currency_filter(esc_html($postmeta["price"][0])); ?> <?php esc_html_e('regular price','marketeer-lite') ?></div>
			</div>
			<div class="bundle-purchase">
				<?php echo do_shortcode('[purchase_link id="'.get_the_id().'" text="'.esc_html__('Buy this bundle','marketeer-lite').'"]'); ?>
			</div>
			<?php if(!empty($postmeta["price"][0])) { ?>
			<div class="bundle-calculate">
				<?php
				$price_full = $postmeta["price"][0]; 
				$price =str_replace(edd_currency_symbol(),'',edd_price($post->ID,false));
				$price = strip_tags($price);
				$save = $price_full - $price;
				$save_proc = ((float)$price / (float)$price_full) * 100;
				$save_proc = 100 - $save_proc;
				?>
				<div class="left"><?php echo round($save_proc) . esc_html__('%','marketeer-lite') ?><?php esc_html_e(' saving','marketeer-lite') ?></div>
				<div class="center"><?php echo edd_currency_filter(esc_html($postmeta["price"][0])) ?><?php esc_html_e(' value','marketeer-lite') ?></div>
				<div class="right"><span><?php esc_html_e('you save','marketeer-lite') ?> <?php echo edd_currency_filter($save); ?></span></div>
			</div>	
			<?php } ?>
			<?php if(!empty($postmeta["date"][0])) { 
				marketeer_countdown(esc_attr($postmeta["date"][0]));
			} ?>	
		</div>
		<div class="sidebar">
			<?php dynamic_sidebar( 'sidebar-download' ); ?>
		</div>

</div>
<div class="related-wrap">
		<?php
		$posttags = wp_get_post_tags(get_the_id(), array( 'fields' => 'slugs' ));
		$args = array( 'post_type' => 'download',
			   "orderby" => 'rand',
			   "showposts" => 4,
			   "post__not_in" => array(get_the_id())
			   
			   );

		$postslist = get_posts( $args ); ?>
		<div class="titleborderOut">
			<div class="titleborder"></div>
		</div>
	
		<div class="relatedPosts">
			<div class="relatedtitle">
				<h4><?php  esc_html_e('Related Posts','marketeer-lite'); ?></h4>
			</div>
			<div class="related">	
			
			<?php
			$count = 0;
			foreach($postslist as $post) {
				setup_postdata( $post );
				if(!has_post_format( 'quote' , get_the_id()) && !has_post_format( 'link' , get_the_id())) {
				if(marketeer_getImage(get_the_id(), 'marketeer-lite-related') !=''){
					$image_related = marketeer_getImage(get_the_id(), 'marketeer-lite-related');
				}
				else{
					$image_related = '<img src="http://placehold.it/235x130">';
				}
				if($count != 3){ ?>
					<div class="one_fourth">
				<?php } else { ?>
					<div class="one_fourth last">
				<?php } ?>
						<div class="image"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php marketeer_security($image_related) ?></a></div>
						<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h4>					
					</div>
						
				<?php 
				$count++;
				}
			} ?>
			</div>
			</div>
			<?php 
			wp_reset_postdata();
			
			?>	
</div>
</div>
<?php get_footer(); ?>
