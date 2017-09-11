<?php get_header();  ?>
<?php global $marketeer_data;
?>
<!-- top bar with breadcrumb and post navigation -->

<!-- main content start -->
<div class="mainwrap single-default <?php if(!isset($marketeer_data['use_fullwidth'])) echo 'sidebar' ?>">
	<?php if (have_posts()) : while (have_posts()) : the_post();  $postmeta = get_post_custom(get_the_id());  ?>
	<!--rev slider-->
	<?php
	if(isset($postmeta["custom_post_rev"][0]) && ($postmeta["custom_post_rev"][0] != 'empty')) { ?>
		<div class="marketeer-lite-rev-slider">
		<?php putRevSlider($postmeta["custom_post_rev"][0]); ?>
		</div>
		<?php
	}
	?>
	
	<div class="main clearfix">	
	<div class="content singledefult">
		<div class="postcontent singledefult" id="post-<?php  get_the_id(); ?>" <?php post_class(); ?>>		
			<div class="blogpost">		
				<div class="posttext">
					<div class="topBlog">	
						<?php if(isset($marketeer_data['display_post_meta'])) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_date('d');
							$month= get_the_date('m');
							$year= get_the_date('Y');
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
					<?php if ( !has_post_format( 'gallery' , get_the_id())) { ?>
						 
						<div class="blogsingleimage">			
							
							<?php	
							if ( !get_post_format() && (!isset($postmeta["marketeer_featured_post"][0]) || $postmeta["marketeer_featured_post"][0] == 1)) { ?>
							
								<?php echo marketeer_getImage(get_the_id(), 'marketeer-lite-postBlock'); ?>
							<?php } ?>
							<?php if ( has_post_format( 'video' , get_the_id())) {?>
							
								<?php  
									if(!empty($postmeta["video_post_url"][0])) {
										echo do_shortcode('[video src='.esc_url($postmeta["video_post_url"][0]).' width=800 height=490]');
									}
								?>
							<?php } ?>	
							<?php if ( has_post_format( 'audio' , get_the_id())) {?>
							<div class="audioPlayer">
								<?php 
								if(isset($postmeta["audio_post_url"][0]))
									echo do_shortcode('[soundcloud  params="auto_play=false&hide_related=false&visual=true" width="100%" height="150"]'. esc_url($postmeta["audio_post_url"][0]) .'[/soundcloud]') ?>
							</div>
							<?php
							}
							?>	

						</div>
		

					<?php } else {?>

					<?php
						$attachments = '';
						add_filter( 'shortcode_atts_gallery', 'marketeer_gallery' );
						function marketeer_gallery( $out )
						{
							remove_filter( current_filter(), __FUNCTION__ );
							$out['size'] = 'marketeer-lite-news';
							return $out;
						}
						$attachments =  get_post_gallery_images( $post->ID);
						if ($attachments) {?>
							<div id="slider-category" class="slider-category">
							<script type="text/javascript">
							jQuery(document).ready(function($){
								jQuery('.bxslider').bxSlider({
								  easing : 'easeInOutQuint',
								  captions: true,
								  speed: 800,
								   buildPager: function(slideIndex){
									switch(slideIndex){
									<?php
									$i = 0;
									foreach ($attachments as  $image_url) { 
										echo 'case '.$i.':return "<img src=\"'. esc_url( $image_url) .'\"";';
										$i++;
									} ?>									
									}
								  }
								});
							});	
							</script>	
								<ul id="slider" class="bxslider">
									<?php 
										foreach ($attachments as  $image_url) {
										

											?>	
												<li>
													<img src="<?php echo esc_url( $image_url) ?>" alt="<?php ?>"/>							
												</li>
												<?php } ?>
								</ul>

							</div>
						<?php } ?>

					<?php }  ?>
					<div class="sentry">
						<?php if ( has_post_format( 'video' , get_the_id())) {?>
							<div><?php the_content(); ?></div>
						<?php
						}
					    if ( has_post_format( 'audio' , get_the_id())) { ?>
							<div><?php the_content(); ?></div>
						<?php
						}						
						if(has_post_format( 'gallery' , get_the_id())){?>
							<div class="gallery-content"><?php the_content(); 	?></div>
						<?php } 
						if( !get_post_format()){?> 
						    <?php add_filter('the_content', 'marketeer_addlightbox'); ?>
							<div><?php the_content(); ?></div>		
						<?php } ?>
						<div class="post-page-links"><?php wp_link_pages(); ?></div>
						<div class="singleBorder"></div>
					</div>
				</div>
				
				<?php if(isset($marketeer_data['single_display_tags'])) { ?>
				<?php if(has_tag()) { ?>
					<div class="tags"><?php the_tags('',' ',''); ?></div>	
				<?php } ?>
				<?php } ?>
				
				<?php if($marketeer_data['single_display_post_meta'] || $marketeer_data['single_display_socials'] != 0) { ?>
				<div class="blog-info">
					
				
					<?php if(isset($marketeer_data['single_display_socials'])) { ?>
					<div class="blog_social"> <?php marketeer_socialLinkSingle(get_the_permalink(),get_the_title())  ?></div>	
					<?php } ?>
				
				</div>
				<?php } ?> <!-- end of blog-info -->
				
				<?php if(isset($marketeer_data['display_author_info'])) { ?>
				<div class = "author-info-wrap">
					<div class="blogAuthor">
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta( 'ID' ), 100); ?></a>
					</div>
					<div class="authorBlogName">	
						<?php esc_html_e('Written by ','marketeer-lite'); ?> <?php echo get_the_author(); ?>  
					</div>
					<div class = "bibliographical-info"><?php echo get_the_author_meta('description')?></div>
				</div>
				<?php } ?> <!-- end of author info -->
				
			</div>						
			
		</div>	
		
		<?php if(isset($marketeer_data['display_related'])) { ?>
		<?php
		$posttags = wp_get_post_tags(get_the_id(), array( 'fields' => 'slugs' ));
		$args = array( 
				'posts_per_page' => 3,
				'tax_query'      => array(
					array(
						'taxonomy'  => 'post_tag',
						'field'     => 'slug',
						'terms'     => $posttags
					)
				)
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
				if($count != 2){ ?>
					<div class="one_third">
				<?php } else { ?>
					<div class="one_third last">
				<?php } ?>
						<div class="image"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php marketeer_security($image_related) ?></a></div>
						<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<?php
						$day = get_the_time('d');
						$month= get_the_time('m');
						$year= get_the_time('Y');
						?>
						<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_time('F j, Y') ?></a>						
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
		<?php } ?> <!-- end of related -->
		
		
		<?php comments_template(); ?>
		
		<?php if(isset($marketeer_data['single_display_post_navigation'])) { ?>
		<div class = "post-navigation">
			<?php next_post_link('%link', '<div class="link-title-previous"><span>&#171; '.esc_html__('Previous post','marketeer-lite').'</span><div class="prev-post-title">%title</div></div>' ,false,''); ?> 
			<?php previous_post_link('%link','<div class="link-title-next"><span>'.esc_html__('Next post','marketeer-lite').' &#187;</span><div class="next-post-title">%title</div></div>',false,''); ?> 
		</div>
		<?php } ?> <!-- end of post navigation -->
		
		<?php endwhile; else: ?>
						
			<?php get_template_part('404','error-page'); ?>
		<?php endif; ?>
		</div>
		
		
	<?php if(!isset($marketeer_data['use_fullwidth'])) { ?>
		<div class="sidebar">	
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	<?php } ?>
</div>
</div>
<?php get_footer(); ?>
