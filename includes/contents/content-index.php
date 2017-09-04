<?php
if(!function_exists('steed_content_index')){
	function steed_content_index(){
		if ( have_posts() ) :		
			while ( have_posts() ) : the_post();
				steed_content_post_item();
			endwhile;
			the_posts_navigation();
			
		else :
			steed_content_not_found();
		endif;
	}
}
add_action('steed_content_index', 'steed_content_index');