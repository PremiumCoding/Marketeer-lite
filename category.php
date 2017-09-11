<?php get_header(); 
global $marketeer_data;
wp_enqueue_script('marketeer_bxSlider');		?><!-- main content start --><div class="mainwrap blog <?php if(is_front_page()) echo 'home' ?> <?php if(!isset($marketeer_data['use_fullwidth'])) echo 'sidebar' ?> default">	<div class="main clearfix">		<div class="pad"></div>					<div class="content blog">			<?php if (have_posts()) : ?>						<?php while (have_posts()) : the_post(); ?>			<?php if(is_sticky(get_the_id())) { ?>			<div class="marketeer_sticky">			<?php } ?>			<?php			$postmeta = get_post_custom(get_the_id()); ?>
				
			
			<?php			if ( has_post_format( 'gallery' , get_the_id())) { 			?>			<div class="slider-category">								<div class="blogpostcategory">
					<div class="topBlog">	
						<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'marketeer-lite' ) ) . '</em>'; ?> </div>
						<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if(isset($marketeer_data['display_post_meta'])) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_time('F j, Y') ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php _e('by ','marketeer-lite'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>				
						</div>
						<?php } ?> <!-- end of post meta -->
					</div>									<?php
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
						<?php } ?>				<?php get_template_part('includes/boxes/loopBlog','single'); ?>				</div>			</div>			<?php } 			if ( has_post_format( 'video' , get_the_id())) { ?>			<div class="slider-category">							<div class="blogpostcategory">
					<div class="topBlog">	
						<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'marketeer-lite' ) ) . '</em>'; ?> </div>
						<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if(isset($marketeer_data['display_post_meta'])) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_time('F j, Y') ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php _e('by ','marketeer-lite'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>			
						</div>
						<?php } ?> <!-- end of post meta -->
					</div>									<?php										if(!empty($postmeta["video_post_url"][0])) {						echo do_shortcode('[video src='.esc_url($postmeta["video_post_url"][0]).' width=800 height=490]');
					}					else{ 						  $image = 'http://placehold.it/800x490'; 						  					?>						  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo marketeer_getImage(get_the_id(),'marketeer-lite-postBlock'); ?></a>											<?php } ?>						<?php get_template_part('includes/boxes/loopBlog','single'); ?>
				</div>
							</div>			<?php } 			if ( has_post_format( 'link' , get_the_id())) {
			$postmeta = get_post_custom(get_the_id()); 
			if(isset($postmeta["link_post_url"][0])){
				$link = $postmeta["link_post_url"][0];
			} else {
				$link = "#";
			}			
			?>			<div class="link-category">				<div class="blogpostcategory">
					<div class="topBlog">	
						<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'marketeer-lite' ) ) . '</em>'; ?> </div>
						<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if(isset($marketeer_data['display_post_meta'])) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_time('F j, Y') ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php _e('by ','marketeer-lite'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>				
						</div>
						<?php } ?> <!-- end of post meta -->
					</div>			
					<?php if(marketeer_getImage(get_the_id(), 'marketeer-lite-postBlock') != '') { ?>	

					<a class="overdefultlink" href="<?php echo esc_url($link) ?>">
					<div class="overdefult">
					</div>
					</a>

					<div class="blogimage">	
						<div class="loading"></div>		
						<a href="<?php echo esc_url($link) ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo marketeer_getImage(get_the_id(), 'marketeer-lite-postBlock'); ?></a>
					</div>
					<?php } ?>										<?php get_template_part('includes/boxes/loopBlogLink','single'); ?>												</div>			</div>						<?php 			} 	
			if ( has_post_format( 'quote' , get_the_id())) {?>
			<div class="quote-category">
				<div class="blogpostcategory">				
					<?php get_template_part('includes/boxes/loopBlogQuote','single'); ?>								
				</div>
			</div>
			
			<?php 
			} 						?>			<?php if ( has_post_format( 'audio' , get_the_id())) {?>			<div class="blogpostcategory">
				<div class="topBlog">	
					<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'marketeer-lite' ) ) . '</em>'; ?> </div>
					<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php if(isset($marketeer_data['display_post_meta'])) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_time('F j, Y') ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php _e('by ','marketeer-lite'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>			
						</div>
						<?php } ?> <!-- end of post meta -->
				</div>							<div class="audioPlayerWrap">					<div class="audioPlayer">
						<?php 
						if(isset($postmeta["audio_post_url"][0]))
							echo do_shortcode('[soundcloud  params="auto_play=false&hide_related=false&visual=true" width="100%" height="150"]'. esc_url($postmeta["audio_post_url"][0]) .'[/soundcloud]') ?>
					</div>				</div>				<?php get_template_part('includes/boxes/loopBlog','single'); ?>					</div>				<?php			}			?>														<?php			if ( !get_post_format() ) {?>		
			<div class="blogpostcategory">				<div class="topBlog">	
					<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'marketeer-lite' ) ) . '</em>'; ?> </div>
					<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php if(isset($marketeer_data['display_post_meta'])) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_time('F j, Y') ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php _e('by ','marketeer-lite'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>		
						</div>
						<?php } ?> <!-- end of post meta -->
				</div>									<?php if(marketeer_getImage(get_the_id(), 'marketeer-lite-postBlock') != '' && (!isset($postmeta["marketeer_featured_category"][0]) || $postmeta["marketeer_featured_category"][0] == 1)) { ?>	
					<a class="overdefultlink" href="<?php the_permalink() ?>">					<div class="overdefult">					</div>					</a>
					<div class="blogimage">							<div class="loading"></div>								<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo marketeer_getImage(get_the_id(), 'marketeer-lite-postBlock'); ?></a>					</div>					<?php } ?>					<?php get_template_part('includes/boxes/loopBlog','single'); ?>			</div>
						<?php } ?>					<?php if(is_sticky()) { ?>				</div>			<?php } ?>
							<?php endwhile; ?>									<?php											get_template_part('includes/wp-pagenavi','navigation');						if(function_exists('wp_pagenavi')) { wp_pagenavi(); }					?>										<?php else : ?>											<div class="postcontent">							<h1><?php marketeer_security($marketeer_data['errorpagetitle']) ?></h1>							<div class="posttext">								<?php marketeer_security($marketeer_data['errorpage']) ?>							</div>						</div>											<?php endif; ?>						</div>		<!-- sidebar -->
		<?php if(!isset($marketeer_data['use_fullwidth'])) { ?>			<div class="sidebar">					<?php dynamic_sidebar( 'sidebar' ); ?>			</div>
		<?php } ?>	</div>	</div>											<?php get_footer(); ?>