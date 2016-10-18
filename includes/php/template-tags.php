<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Steed
 */
if ( ! function_exists( 'steed_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function steed_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'steed' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'steed' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'steed_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function steed_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'steed' ) );
		if ( $categories_list && steed_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'steed' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'steed' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'steed' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'steed' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'steed' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function steed_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'steed_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'steed_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so steed_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so steed_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in steed_categorized_blog.
 */
function steed_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'steed_categories' );
}
add_action( 'edit_category', 'steed_category_transient_flusher' );
add_action( 'save_post',     'steed_category_transient_flusher' );

function steed_mal(){
	return apply_filters('steed_mal_ready', false);
}

if ( ! function_exists( 'steed_site_header' ) ) :

	function steed_site_header(){
		do_action('steed_before_site_header');
		get_template_part( 'includes/parts/part', 'header');
		do_action('steed_after_site_header');
	}

endif;

if ( ! function_exists( 'steed_site_subheader' ) ) :

	function steed_site_subheader(){
		do_action('steed_before_site_subheader');
		get_template_part( 'includes/parts/part', 'subheader');
		do_action('steed_after_site_subheader');
	}

endif;

if ( ! function_exists( 'steed_site_footer' ) ) :

	function steed_site_footer(){
		do_action('steed_before_site_footer');
		get_template_part( 'includes/parts/part', 'footer');
		do_action('steed_before_site_footer');
	}

endif;


if ( ! function_exists( 'steed_before_site_content' ) ) :

	function steed_before_site_content($arg){
		$arg = array_merge(array( 'class' => '', 'in_class' => '' ), $arg);
		echo '<div id="content" class="site-content '.$arg['class'].'">';
			echo '<div id="content-in" class="site-content-in '.$arg['in_class'].'">';
				do_action('steed_before_site_content');
	}

endif;


if ( ! function_exists( 'steed_after_site_content' ) ) :

	function steed_after_site_content(){
				do_action('steed_after_site_content');
			echo '</div><!-- #content-in -->';
		echo '</div><!-- #content -->';
		
	}

endif;


if ( ! function_exists( 'steed_before_primary_content' ) ) :

	function steed_before_primary_content(){
		
		echo '<div id="primary" class="content-area">';
			echo '<main id="main" class="site-main" role="main">';
				do_action('steed_before_primary_content');
	}

endif;


if ( ! function_exists( 'steed_after_primary_content' ) ) :

	function steed_after_primary_content(){
				do_action('steed_after_primary_content');
			echo '</main><!-- #main -->';
		echo '</div><!-- #primary -->';
		
	}

endif;


if ( ! function_exists( 'steed_custom_logo' ) ) :
	function steed_custom_logo() {
		
		$output = '';
		$description = get_bloginfo( 'description', 'display' );
		
		// Try to retrieve the Custom Logo
		if (function_exists('get_custom_logo')){
			$output = get_custom_logo();
		}
	
		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
		if ($output == ''){
			if ( is_front_page() && is_home() ){
				$output .= '<h1  class="site-title"><a href="' . esc_url(home_url('/')) . '">'.get_bloginfo( 'name' ).'</a></h1>';
			}else{
				$output .= '<p  class="site-title"><a href="' . esc_url(home_url('/')) . '">'.get_bloginfo( 'name' ).'</a></p>';
			}
			if ( $description || is_customize_preview() ){
				$output .= '<p  class="site-description">'.$description.'</p>';
			}
		}
		
		/*Validating using wp_kses as the output contain images and h1 tags*/
		echo wp_kses($output, wp_kses_allowed_html( 'post' ));
	}
endif;


function steed_css_background($prefix, $std){
	$std_image = (isset($std['image'])) ? $std['image'] : '';
	$std_color = (isset($std['color'])) ? $std['color'] : '';
	$std_repeat = (isset($std['repeat'])) ? $std['repeat'] : '';
	$std_attachment = (isset($std['attachment'])) ? $std['attachment'] : '';
	$std_position = (isset($std['position'])) ? $std['position'] : '';
	$std_size = (isset($std['size'])) ? $std['size'] : '';
	
	$image = esc_url(get_theme_mod($prefix.'image', $std_image));
	$color = sanitize_hex_color(get_theme_mod($prefix.'color', $std_color));
	$repeat = esc_attr(get_theme_mod($prefix.'repeat', $std_repeat));
	$attachment = esc_attr(get_theme_mod($prefix.'attachment', $std_attachment));
	$position = esc_attr(get_theme_mod($prefix.'position', $std_position));
	$size = esc_attr(get_theme_mod($prefix.'size', $std_size));
	
	
	$css = '';
	$css .= ($image != '') ? 'background-image:url('.$image.'); ' : '';
	$css .= ($color != '') ? 'background-color:'.$color.'; ' : '';
	$css .= ($repeat != '') ? 'background-repeat:'.$repeat.'; ' : '';
	$css .= ($attachment != '') ? 'background-attachment:'.$attachment.'; ' : '';
	$css .= ($position != '') ? 'background-position:'.$position.'; ' : '';
	$css .= ($size != '') ? 'background-size:'.$size.'; ' : '';
	
	return $css;
}

function steed_css_padding($prefix, $std){
	$std_top= (isset($std['top'])) ? $std['top'] : '';
	$std_bottom = (isset($std['bottom'])) ? $std['bottom'] : '';

	$top = esc_attr(get_theme_mod($prefix.'top', $std_top));
	$bottom = esc_attr(get_theme_mod($prefix.'bottom', $std_bottom));
	
	$css = '';
	$css .= ($top != '') ? 'padding-top:'.$top.'; ' : '';
	$css .= ($bottom != '') ? 'padding-bottom:'.$bottom.'; ' : '';
	
	return $css;
}


function steed_css_colorMood($prefix, $std){
	$std_colorMood= (isset($std['colorMood'])) ? $std['colorMood'] : '';
	$colorMood = esc_attr(get_theme_mod($prefix.'colorMood', $std_colorMood));
	return $colorMood;
}


function steed_search_replace_style_of_part($prefix, $string, $data){
	
	$std_bg = '';
	$std_padding = '';
	$std_colorMood = '';
		
	if(isset($data['style_bg'])){
		if($data['style_bg'] != 'n/a'){
			$std_bg = $data['style_bg'];
		}
	}
	if(isset($data['style_padding'])){
		if($data['style_padding'] != 'n/a'){
			$std_padding = $data['style_padding'];
		}
	}
	if(isset($data['style_colorMood'])){
		if($data['style_colorMood'] != 'n/a'){
			$std_colorMood = $data['style_colorMood'];
		}
	}
	
	$bg = steed_css_background($prefix.'bg_', $std_bg);
	$padding = steed_css_padding($prefix.'padding_', $std_padding);
	$colorMood = 'color-'.steed_css_colorMood($prefix.'colorMood_', $std_colorMood);
	
	$search = array('%bg%', '%padding%', '%colorMood%');
	$replace = array($bg, $padding, $colorMood);
	return str_replace($search, $replace, $string);
}



function steed_site_part_html_render($name){
	$configs = apply_filters('steed_site_part_render__'.$name, NULL);
	$mal = steed_mal();
	
	if(is_array($configs)){
		$prefix = $configs['prefix'];
		$title = $configs['title'];
	
		echo $configs['before']."\n";
			foreach($configs['section'] as $section_key => $section){
				
				if(isset($section['prefix'])){
					$section_prefix = $prefix.$section['prefix'];
				}else{
					$section_prefix = $prefix.$section_key;
				}
				
				echo steed_search_replace_style_of_part($section_prefix, $section['before'], $section)."\n";
					foreach($section['items'] as $item_key => $item){
						
						if(isset($item['prefix'])){
							$item_prefix = $prefix.$item['prefix'];
						}else{
							$item_prefix = $prefix.$item_key;
						}
				
						echo steed_search_replace_style_of_part($item_prefix, $item['before'], $item)."\n";
							foreach($item['elements'] as $element){
								$function = 'steed_element_'.$element['fn'];
								$e_prefix = $prefix.$element['prefix'];
								$show_hide_std = (isset($element['show_hide_std'])) ? $element['show_hide_std'] : 'yes';
								$mod_active = esc_attr(get_theme_mod($e_prefix.'active', $show_hide_std));
								if(function_exists($function)){
									$e_active  = ($show_hide_std == 'n/a')? 'yes' : $mod_active;
									if($e_active == 'yes'){
										echo $element['before']."\n";
											$function($e_prefix, $element['settings']);
										echo $element['after']."\n";
									}
									
								}
							}
						echo $item['after']."\n";
					}
				echo $section['after']."\n";
			}
		echo $configs['after']."\n";
	}
}

function steed_site_part_customize_render($name, $wp_customize){
	$configs = apply_filters('steed_site_part_render__'.$name, NULL);
	$mal = steed_mal();
	
	if(is_array($configs)){
		$prefix = $configs['prefix'];
		$title = $configs['title'];
		
		$section_prefix_id = $prefix.'panel';
		$wp_customize->add_section( $section_prefix_id, array(
			'title' => $title.' Settings',
			'priority' => 10,
		));
		
		foreach($configs['section'] as $section_key => $section){
			
			if(isset($section['prefix'])){
				$section_prefix = $prefix.$section['prefix'];
			}else{
				$section_prefix = $prefix.$section_key;
			}
			
			foreach($section['items'] as $item_key => $item){
				
				if(isset($item['prefix'])){
					$item_prefix = $prefix.$item['prefix'];
				}else{
					$item_prefix = $prefix.$item_key;
				}
				
				foreach($item['elements'] as $element){
					$function = 'steed_element_customize_'.$element['fn'];
					$e_prefix = $prefix.$element['prefix'];
					$show_hide_std = (isset($element['show_hide_std'])) ? $element['show_hide_std'] : 'yes';
					
					if(function_exists($function)){
												
						$wp_customize->add_setting($e_prefix.'infoheading', array( 'default' => '', 'sanitize_callback' => '', ));
						$wp_customize->add_control( new steed_Customize_Control_heading($wp_customize, $e_prefix.'infoheading', 
							array(
								'label' => $element['title'],
								'description' => '',
								'section'    => $section_prefix_id,
							)) 
						);
						
						if($mal && ($show_hide_std != 'n/a')){
							$uid = $e_prefix.'active';
							$wp_customize->add_setting($uid, array( 'default' => $show_hide_std, 'sanitize_callback' => 'sanitize_text_field', ));
							$wp_customize->add_control( $uid, array(
								'label'      => __('Active', 'steed'),
								'section'    => $section_prefix_id,
								'settings'   => $uid,
								'type'       => 'select',
								'description' => '',
								'choices' => array(
									'yes' => 'yes',
									'no' => 'no',
								),
							));
						}
											
						$function($e_prefix, $section_prefix_id, $element['settings'], $wp_customize);
					}
				}
				
				steed_customizer_print_part_style($wp_customize, $section_prefix_id, $item_prefix, $item);
			}
			steed_customizer_print_part_style($wp_customize, $section_prefix_id, $section_prefix, $section);
		}
	}
	
	return $wp_customize;	
}



function steed_site_part_widget_init() {
	$all_configs = array();
	
	$all_configs[] = apply_filters('steed_site_part_render__site_header', NULL);
	$all_configs[] = apply_filters('steed_site_part_render__after_site_header', NULL);
	$all_configs[] = apply_filters('steed_site_part_render__site_footer', NULL);
	$all_configs[] = apply_filters('steed_site_part_render__site_subheader', NULL);
	
	foreach($all_configs as $configs){
		if(is_array($configs)){
			$prefix = $configs['prefix'];
			if(isset($configs['section'])){
				foreach($configs['section'] as $section){		
					foreach($section['items'] as $item){
						foreach($item['elements'] as $element){
							$e_prefix = $prefix.$element['prefix'];
							if($element['fn'] == 'widget'){
								register_sidebar( array(
									'name'          => $element['title'],
									'id'            => $e_prefix,
									'description'   => '',
									'before_widget' => '<section id="%1$s" class="widget %2$s">',
									'after_widget'  => '</section>',
									'before_title'  => '<h2 class="widget-title">',
									'after_title'   => '</h2>',
								));
							}
							if($element['fn'] == 'footerWidgets'){
								register_sidebar( array(
									'name'          => $element['title']. '#1',
									'id'            => $e_prefix.'_1',
									'description'   => '',
									'before_widget' => '<section id="%1$s" class="widget %2$s">',
									'after_widget'  => '</section>',
									'before_title'  => '<h2 class="widget-title">',
									'after_title'   => '</h2>',
								));
								register_sidebar( array(
									'name'          => $element['title']. '#2',
									'id'            => $e_prefix.'_2',
									'description'   => '',
									'before_widget' => '<section id="%1$s" class="widget %2$s">',
									'after_widget'  => '</section>',
									'before_title'  => '<h2 class="widget-title">',
									'after_title'   => '</h2>',
								));
								register_sidebar( array(
									'name'          => $element['title']. '#3',
									'id'            => $e_prefix.'_3',
									'description'   => '',
									'before_widget' => '<section id="%1$s" class="widget %2$s">',
									'after_widget'  => '</section>',
									'before_title'  => '<h2 class="widget-title">',
									'after_title'   => '</h2>',
								));
								register_sidebar( array(
									'name'          => $element['title']. '#4',
									'id'            => $e_prefix.'_4',
									'description'   => '',
									'before_widget' => '<section id="%1$s" class="widget %2$s">',
									'after_widget'  => '</section>',
									'before_title'  => '<h2 class="widget-title">',
									'after_title'   => '</h2>',
								));
							}
						}
					}
				}
			}
		}
	}
}
add_action( 'widgets_init', 'steed_site_part_widget_init' );