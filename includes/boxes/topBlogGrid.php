<?php 
global $marketeer_data;
$postmeta = get_post_custom(get_the_id());  
		
?>

<div class="topBlog">	
	<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
</div>		