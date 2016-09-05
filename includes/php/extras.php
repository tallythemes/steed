<?php
$steed_mod_std = apply_filters('steed_mod_std', false);

/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Steed
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function steed_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'steed_body_classes' );


if(!function_exists('steed_get_post_data')):
	function steed_get_post_data($p, $type, $arg = 'thumbnail'){
		$post_id = $p;
		
		if(!is_numeric($p)){ $post_id = get_page_by_path( $p ); }
		
		wp_reset_postdata();
		
		$post = get_post($post_id); 
		setup_postdata($post);
		
		if($type == 'content'){
			the_content();
		}elseif($type == 'title'){
			the_title();
		}elseif($type == 'excerpt'){
			the_excerpt();
		}elseif($type == 'permalink'){
			the_permalink();
		}elseif($type == 'thumbnail'){
			echo get_the_post_thumbnail($post_id, $arg);
		}elseif($type == 'thumbnail_url'){
			the_post_thumbnail_url($arg);
		}
		
		wp_reset_postdata();
	}
endif;


function steed_mod($name, $std = NULL){
	global $steed_mod_std;
	
	if(isset($steed_mod_std[$name])){
		$std = $steed_mod_std[$name];
	}
	
	return get_theme_mod($name, $std);
}

function steed_mod_std($name, $std = NULL){
	global $steed_mod_std;
	
	if(isset($steed_mod_std[$name])){
		$std = $steed_mod_std[$name];
	}
	
	return $std;
}