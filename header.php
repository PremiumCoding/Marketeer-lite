<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" >
<!-- start -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) {wp_enqueue_script( 'comment-reply' ); }?>
	
	<?php wp_head();?>
</head>		
<!-- start body -->
<body <?php body_class(); ?> >
	<!-- start header -->
			<!-- fixed menu -->		
			<?php 
			global $marketeer_data;	
			?>	
			
			<div class="pagenav fixedmenu">						
				<div class="holder-fixedmenu">							
					<div class="logo-fixedmenu">								
					<?php 
					if(isset($marketeer_data['scroll_logo'])){
						$logo = esc_url($marketeer_data['scroll_logo']); 
					} else {
						$logo = esc_url($marketeer_data['logo']); 
					} ?>							
					<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php if ($logo != '') {?><?php echo esc_url($logo); ?><?php } else {?><?php get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" ></a>
					</div>
						<div class="menu-fixedmenu home">
						<?php
						if ( has_nav_menu( 'pmcscrollmenu' ) ) {
						wp_nav_menu( array(
						'container' =>false,
						'container_class' => 'menu-scroll',
						'theme_location' => 'pmcscrollmenu',
						'echo' => true,
						'fallback_cb' => 'marketeer_fallback_menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => new marketeer_Walker_Main_Menu())
						);
						}
						?>	
					</div>
				</div>	
			</div>
				<header>
				<!-- top bar -->
				<?php if(isset($marketeer_data['top_bar'])) { ?>
					<div class="top-wrapper">
						<div class="top-wrapper-content">
							<div class="top-left">
								<?php dynamic_sidebar( 'sidebar-top-left' ); ?>
							</div>
							<div class="top-right">
								<?php dynamic_sidebar( 'sidebar-top-right' ); ?>
							</div>
						</div>
					</div>
					<?php } ?>			
					<div id="headerwrap">			
						<!-- logo and main menu -->
						<div id="header">
							<!-- respoonsive menu main-->
							<!-- respoonsive menu no scrool bar -->
							<div class="respMenu noscroll">
								<div class="resp_menu_button"><i class="fa fa-list-ul fa-2x"></i></div>
								<?php 
								if ( has_nav_menu( 'pmcrespmenu' ) ) {
									$menuParameters =  array(
									  'theme_location' => 'pmcrespmenu', 
									  'walker'         => new marketeer_Walker_Responsive_Menu(),
									  'echo'            => false,
									  'container_class' => 'menu-main-menu-container',
									  'items_wrap'     => '<div class="event-type-selector-dropdown">%3$s</div>',
									);
									echo strip_tags(wp_nav_menu( $menuParameters ), '<a>,<br>,<div>,<i>,<strong>' );
								}
								?>	
							</div>			
							<!-- main menu -->
							<div class="pagenav"> 
							<div id="logo">
							<?php $logo = $marketeer_data['logo']; ?>
							<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php if ($logo != '') {?>
							<?php echo esc_url($logo); ?><?php } else {?><?php get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" /></a>
							</div>							
							<?php
								if ( has_nav_menu( 'pmcmainmenu' ) ) {	
									wp_nav_menu( array(
									'container' =>false,
									'container_class' => 'menu-header home',
									'menu_id' => 'menu-main-menu-container',
									'theme_location' => 'pmcmainmenu',
									'echo' => true,
									'fallback_cb' => 'marketeer_fallback_menu',
									'before' => '',
									'after' => '',
									'link_before' => '',
									'link_after' => '',
									'depth' => 0,
									'walker' => new marketeer_Walker_Main_Menu()));								
								} ?>
								<div class="menu-top">
									<?php
									if ( has_nav_menu( 'pmctopmenu' ) ) {
									wp_nav_menu( array(
									'container' =>false,
									'container_class' => 'menu-top',
									'theme_location' => 'pmctopmenu',
									'echo' => true,
									'fallback_cb' => 'marketeer_fallback_menu',
									'before' => '',
									'after' => '',
									'link_before' => '',
									'link_after' => '',
									'depth' => 0,
									'walker' => new marketeer_Walker_Main_Menu())
									);
									}
									?>	
								</div>								
								<div class = "top-search-form">
									<?php get_search_form(true); ?>
								</div>									
								<div class="social_icons">
									<div><?php marketeer_socialLink() ?></div>
								</div>							
							</div> 	
						</div>
					</div> 		
					<div class="news-wrapper-content">
						<div class="news">
							<?php if(is_front_page()) { ?>
							<?php dynamic_sidebar( 'news' ); ?>
							<?php } ?>
						</div>
					</div>					
					<?php
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					if(is_plugin_active( 'revslider/revslider.php')){						
						if(isset($marketeer_data['rev_slider']) && $marketeer_data['rev_slider'] != ''){ ?>
							<div id="marketeer-lite-slider-wrapper">
								<div id="marketeer-lite-slider">
									<?php putRevSlider($marketeer_data['rev_slider'],"homepage") ?>
								</div>
							</div>
						<?php } ?>
					<?php } ?>							
				
					<?php 					
					if(is_front_page() && isset($marketeer_data['use_block1'])){ ?>
						<div class="block1">
							<a href="<?php echo esc_url($marketeer_data['block1_link1']) ?>" title="Image">
								<div class="block1_all_text">
									<div class="block1_text">
										<p><?php echo esc_html($marketeer_data['block1_text1']) ?></p>
									</div>
									<div class="block1_lower_text">
										<p><?php echo esc_html($marketeer_data['block1_lower_text1']) ?></p>
									</div>
								</div>								
								<div class="block1_img">
									<img src="<?php echo esc_url($marketeer_data['block1_img1']) ?>" alt="<?php echo esc_html($marketeer_data['block1_text1']) ?>">
								</div>
							</a>
							<a href="<?php echo esc_url($marketeer_data['block1_link2']) ?>" title="Image" >
								<div class="block1_all_text">
									<div class="block1_text">
										<p><?php echo esc_html($marketeer_data['block1_text2']) ?></p>
									</div>
									<div class="block1_lower_text">
										<p><?php echo esc_html($marketeer_data['block1_lower_text2']) ?></p>
									</div>
								</div>								
								
								<div class="block1_img">
									<img src="<?php echo esc_url($marketeer_data['block1_img2']) ?>" alt="<?php echo esc_html($marketeer_data['block1_text2']) ?>">
								</div>
								
							</a>
							<a href="<?php echo esc_url($marketeer_data['block1_link3']) ?>" title="Image" >
								<div class="block1_all_text">
									<div class="block1_text">
										<p><?php echo esc_html($marketeer_data['block1_text3']) ?></p>
									</div>
									<div class="block1_lower_text">
										<p><?php echo esc_html($marketeer_data['block1_lower_text3']) ?></p>
									</div>
								</div>								
								<div class="block1_img">
									<img src="<?php echo esc_url($marketeer_data['block1_img3']) ?>" alt="<?php echo esc_html($marketeer_data['block1_text3']) ?>">
								</div>
							</a>							
						</div>
					<?php } ?>	
					<?php if(is_front_page() && isset($marketeer_data['use_block2']) && $marketeer_data['use_block2'] == 1 ){ ?>	
						<div class="block2">
							<div class="block2_content">
										
								<div class="block2_img">
									<img class="block2_img_big" src="<?php echo esc_url($marketeer_data['block2_img']) ?>" alt="<?php echo esc_html($marketeer_data['block2_title']) ?>">
								</div>						
								
								<div class="block2_text">
									<p><?php marketeer_security($marketeer_data['block2_text']) ?></p>
								</div>
							</div>								
						</div>
					<?php } ?>
				</header>	
