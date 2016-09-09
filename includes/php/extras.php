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
	return get_theme_mod($name, $std);
}

function steed_mod_std($name, $std = NULL){
	global $steed_mod_std;
	
	if(isset($steed_mod_std[$name])){
		$std = $steed_mod_std[$name];
	}
	
	return $std;
}

if ( ! function_exists( 'steed_fonts_url' ) ) :
/**
 * Register Google fonts for Steed.
 *
 * Create your own steed_fonts_url() function to override in a child theme.
 *
 * @since Steed 1.3
 *
 * @return string Google fonts URL for the theme.
 * 
 * Code Source Twenty Sixteen Theme
 */
 
function steed_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* #0 Heading Font */
	$fonts[] = 'Arvo:400,400i,700,700i';

	/* #1 Menu Font */
	$fonts[] = 'PT+Sans:400,400i,700,700i';

	/* #2 Body Font */
	$fonts[] = 'PT+Sans:400,400i,700,700i';
	
	$fonts = apply_filters('steed_fonts', $fonts);

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


if(! function_exists( 'steed_fonts_style' ) ):
	function steed_fonts_style($i){
		
		$fonts = array();
		/* #0 Heading Font */
		$fonts[] = 'Arvo:400,400i,700,700i';
	
		/* #1 Menu Font */
		$fonts[] = 'PT+Sans:400,400i,700,700i';
	
		/* #2 Body Font */
		$fonts[] = 'PT+Sans:400,400i,700,700i';
		
		$fonts = apply_filters('steed_fonts', $fonts);
		$font_string = NULL;
		$font_name = NULL;
		
		if(isset($fonts[$i])){
			$font_string = $fonts[$i];
		}
		
		if($font_string != NULL){
			$font_name = str_replace("+", " ", strstr($font_string, ':', true));
			if($font_name == ''){  
				$font_name = "'".str_replace("+", " ", $font_string)."', sans-serif";
			}else{
				$font_name = "'".str_replace("+", " ", strstr($font_string, ':', true))."', sans-serif";
			}
		}
		
		return sanitize_text_field($font_name);
	}
endif;


function steed_custom_css(){
	$css = '';
	
	$css .= 'body{ font-family:'. steed_fonts_style(2) .'; }';
	$css .= '.main-navigation, .main-navigation a{ font-family:'. steed_fonts_style(1) .'; }';
	$css .= 'h1, h2, h3, h4, h5, h6{ font-family:'. steed_fonts_style(0) .'; }';
	
	return $css;
}