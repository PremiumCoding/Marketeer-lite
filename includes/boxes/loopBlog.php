<?php global $marketeer_data; ?>
	
	<div class="entry">
		<div class = "meta">		
			<div class="blogContent">
				<div class="blogcontent"><?php the_content() ?></div>
			<?php if($marketeer_data['display_post_meta'] || $marketeer_data['display_socials'] != 0) { ?>
			
				<div class="bottomBlog">
			
					<?php if(isset($marketeer_data['display_socials'])) { ?>
					
					<div class="blog_social"> <?php marketeer_socialLinkSingle(get_the_permalink(),get_the_title())  ?></div>
					<?php } ?>
					
				</div> <!-- end of socials -->
		
		<?php } ?> <!-- end of bottom blog -->
			</div>
			
			
		
</div>		
	</div>
