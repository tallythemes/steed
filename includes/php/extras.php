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
	$std_colors = array(
		'primary' => '#359a34',
		'accent' => '#2a6b29',
		'dark' => array(
			'text' => '#555',
			'meta' => '#999',
			'heading' => '#000',
			'sub_heading' => '#333',
			'border' => '#999',
			'sub_border' => '#f0f0f0',
			'bg' => '#fff',
			'sub_bg' => '#f1f1f1',
		),
		'light' => array(
			'text' => '#d6d6d6',
			'meta' => '#999',
			'heading' => '#fff',
			'sub_heading' => '#333',
			'border' => '#999',
			'sub_border' => '#f0f0f0',
			'bg' => '#000',
			'sub_bg' => '#f1f1f1',
		),
	);
	$colors = apply_filters('steed_colors', $std_colors);
	
	$primary_color = $colors['primary'];
	$accent_color = $colors['accent'];
	
	$dark_colors = $colors['dark'];
	$light_colors = $colors['light'];
	
	$css = '';
	
	/* Font */
	$css .= 'body{ font-family:'.steed_fonts_style(2).'; }';
	$css .= '.main-navigation, .main-navigation a{ font-family:'. steed_fonts_style(1).'; }';
	$css .= 'h1, h2, h3, h4, h5, h6{ font-family:'. steed_fonts_style(0).'; }';
	
	/* Primary & Accent */
	$css .= 'a, a:visited{ color:'.$primary_color.'; }';
	$css .= 'a:hover{ color:'.$accent_color.'; }';
	
	$css .= '.pc_bg{ background-color:'.$primary_color.'; }';
	$css .= '.pc_bg_hover:hover{ background-color:'.$primary_color.'; }';
	$css .= '.pc_border{ border-color:'.$primary_color.'; }';
	$css .= '.pc_border_hover:hover{ border-color:'.$primary_color.'; }';
	$css .= '.pc_text{ color:'.$primary_color.'; }';
	$css .= '.pc_text_hover:hover{ color:'.$primary_color.'; }';
	
	$css .= '.ac_bg{ background-color:'.$accent_color.'; }';
	$css .= '.ac_bg_hover:hover{ background-color:'.$accent_color.'; }';
	$css .= '.ac_border{ border-color:'.$accent_color.'; }';
	$css .= '.ac_border_hover:hover{ border-color:'.$accent_color.'; }';
	$css .= '.ac_text{ color:'.$accent_color.'; }';
	$css .= '.ac_text_hover:hover{ color:'.$accent_color.'; }';
	
	/* Dark Text */
	$css .= 'body{ color:'.$dark_colors['text'].'; }';
	$css .= '.tc_bg{ background-color:'.$dark_colors['text'].'; }';
	$css .= '.tc_bg_hover:hover{ background-color:'.$dark_colors['text'].'; }';
	$css .= '.tc_border{ border-color:'.$dark_colors['text'].'; }';
	$css .= '.tc_border_hover:hover{ border-color:'.$dark_colors['text'].'; }';
	$css .= '.tc_text{ color:'.$dark_colors['text'].'; }';
	$css .= '.tc_text_hover:hover{ color:'.$dark_colors['text'].'; }';
	
	/* Dark heading */
	$css .= 'h1, h2, h3, h4, h5, h6{ color:'.$dark_colors['heading'].'; }';
	$css .= '.hc_bg{ background-color:'.$dark_colors['heading'].'; }';
	$css .= '.hc_bg_hover:hover{ background-color:'.$dark_colors['heading'].'; }';
	$css .= '.hc_border{ border-color:'.$dark_colors['heading'].'; }';
	$css .= '.hc_border_hover:hover{ border-color:'.$dark_colors['heading'].'; }';
	$css .= '.hc_text{ color:'.$dark_colors['heading'].'; }';
	$css .= '.hc_text_hover:hover{ color:'.$dark_colors['heading'].'; }';
	
	/* Dark Sub-Heading */
	$css .= '.hsc_bg{ background-color:'.$dark_colors['sub_heading'].'; }';
	$css .= '.hsc_bg_hover:hover{ background-color:'.$dark_colors['sub_heading'].'; }';
	$css .= '.hsc_border{ border-color:'.$dark_colors['sub_heading'].'; }';
	$css .= '.hsc_border_hover:hover{ border-color:'.$dark_colors['sub_heading'].'; }';
	$css .= '.hsc_text{ color:'.$dark_colors['sub_heading'].'; }';
	$css .= '.hsc_text_hover:hover{ color:'.$dark_colors['sub_heading'].'; }';
	
	/* Dark Meta */
	$css .= '.mc_bg{ background-color:'.$dark_colors['meta'].'; }';
	$css .= '.mc_bg_hover:hover{ background-color:'.$dark_colors['meta'].'; }';
	$css .= '.mc_border{ border-color:'.$dark_colors['meta'].'; }';
	$css .= '.mc_border_hover:hover{ border-color:'.$dark_colors['meta'].'; }';
	$css .= '.mc_text{ color:'.$dark_colors['meta'].'; }';
	$css .= '.mc_text_hover:hover{ color:'.$dark_colors['meta'].'; }';
	
	/* Dark Border */
	$css .= '.bc_bg{ background-color:'.$dark_colors['border'].'; }';
	$css .= '.bc_bg_hover:hover{ background-color:'.$dark_colors['border'].'; }';
	$css .= '.bc_border{ border-color:'.$dark_colors['border'].'; }';
	$css .= '.bc_border_hover:hover{ border-color:'.$dark_colors['border'].'; }';
	$css .= '.bc_text{ color:'.$dark_colors['border'].'; }';
	$css .= '.bc_text_hover:hover{ color:'.$dark_colors['border'].'; }';
	
	/* Dark Sub-Border */
	$css .= '.bsc_bg{ background-color:'.$dark_colors['sub_border'].'; }';
	$css .= '.bsc_bg_hover:hover{ background-color:'.$dark_colors['sub_border'].'; }';
	$css .= '.bsc_border{ border-color:'.$dark_colors['sub_border'].'; }';
	$css .= '.bsc_border_hover:hover{ border-color:'.$dark_colors['sub_border'].'; }';
	$css .= '.bsc_text{ color:'.$dark_colors['sub_border'].'; }';
	$css .= '.bsc_text_hover:hover{ color:'.$dark_colors['sub_border'].'; }';
	
	/* Dark BG */
	$css .= '.bgc_bg{ background-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgc_bg_hover:hover{ background-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgc_border{ border-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgc_border_hover:hover{ border-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgc_text{ color:'.$dark_colors['bg'].'; }';
	$css .= '.bgc_text_hover:hover{ color:'.$dark_colors['bg'].'; }';
	
	/* Dark Sub BG */
	$css .= '.bgsc_bg{ background-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgsc_bg_hover:hover{ background-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgsc_border{ border-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgsc_border_hover:hover{ border-color:'.$dark_colors['bg'].'; }';
	$css .= '.bgsc_text{ color:'.$dark_colors['bg'].'; }';
	$css .= '.bgsc_text_hover:hover{ color:'.$dark_colors['bg'].'; }';
	
		
	
	/* Light Text */
	$css .= '.color-light { color:'.$light_colors['text'].'; }';
	$css .= '.color-light .tc_bg{ background-color:'.$light_colors['text'].'; }';
	$css .= '.color-light .tc_bg_hover:hover{ background-color:'.$light_colors['text'].'; }';
	$css .= '.color-light .tc_border{ border-color:'.$light_colors['text'].'; }';
	$css .= '.color-light .tc_border_hover:hover{ border-color:'.$light_colors['text'].'; }';
	$css .= '.color-light .tc_text{ color:'.$light_colors['text'].'; }';
	$css .= '.color-light .tc_text_hover:hover{ color:'.$light_colors['text'].'; }';
	
	/* Light heading */
	$css .= '.color-light h1, .color-light h2, .color-light h3, .color-light h4, .color-light h5, .color-light h6{ color:'.$light_colors['heading'].'; }';
	$css .= '.color-light .hc_bg{ background-color:'.$light_colors['heading'].'; }';
	$css .= '.color-light .hc_bg_hover:hover{ background-color:'.$light_colors['heading'].'; }';
	$css .= '.color-light .hc_border{ border-color:'.$light_colors['heading'].'; }';
	$css .= '.color-light .hc_border_hover:hover{ border-color:'.$light_colors['heading'].'; }';
	$css .= '.color-light .hc_text{ color:'.$light_colors['heading'].'; }';
	$css .= '.color-light .hc_text_hover:hover{ color:'.$light_colors['heading'].'; }';
	
	/* Light Sub-Heading */
	$css .= '.color-light .hsc_bg{ background-color:'.$light_colors['sub_heading'].'; }';
	$css .= '.color-light .hsc_bg_hover:hover{ background-color:'.$light_colors['sub_heading'].'; }';
	$css .= '.color-light .hsc_border{ border-color:'.$light_colors['sub_heading'].'; }';
	$css .= '.color-light .hsc_border_hover:hover{ border-color:'.$light_colors['sub_heading'].'; }';
	$css .= '.color-light .hsc_text{ color:'.$light_colors['sub_heading'].'; }';
	$css .= '.color-light .hsc_text_hover:hover{ color:'.$light_colors['sub_heading'].'; }';
	
	/* Light Meta */
	$css .= '.color-light .mc_bg{ background-color:'.$light_colors['meta'].'; }';
	$css .= '.color-light .mc_bg_hover:hover{ background-color:'.$light_colors['meta'].'; }';
	$css .= '.color-light .mc_border{ border-color:'.$light_colors['meta'].'; }';
	$css .= '.color-light .mc_border_hover:hover{ border-color:'.$light_colors['meta'].'; }';
	$css .= '.color-light .mc_text{ color:'.$light_colors['meta'].'; }';
	$css .= '.color-light .mc_text_hover:hover{ color:'.$light_colors['meta'].'; }';
	
	/* Light Border */
	$css .= '.color-light .bc_bg{ background-color:'.$light_colors['border'].'; }';
	$css .= '.color-light .bc_bg_hover:hover{ background-color:'.$light_colors['border'].'; }';
	$css .= '.color-light .bc_border{ border-color:'.$light_colors['border'].'; }';
	$css .= '.color-light .bc_border_hover:hover{ border-color:'.$light_colors['border'].'; }';
	$css .= '.color-light .bc_text{ color:'.$light_colors['border'].'; }';
	$css .= '.color-light .bc_text_hover:hover{ color:'.$light_colors['border'].'; }';
	
	/* Light Sub-Border */
	$css .= '.color-light .bsc_bg{ background-color:'.$light_colors['sub_border'].'; }';
	$css .= '.color-light .bsc_bg_hover:hover{ background-color:'.$light_colors['sub_border'].'; }';
	$css .= '.color-light .bsc_border{ border-color:'.$light_colors['sub_border'].'; }';
	$css .= '.color-light .bsc_border_hover:hover{ border-color:'.$light_colors['sub_border'].'; }';
	$css .= '.color-light .bsc_text{ color:'.$light_colors['sub_border'].'; }';
	$css .= '.color-light .bsc_text_hover:hover{ color:'.$light_colors['sub_border'].'; }';
	
	/* Light BG */
	$css .= '.color-light .bgc_bg{ background-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgc_bg_hover:hover{ background-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgc_border{ border-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgc_border_hover:hover{ border-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgc_text{ color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgc_text_hover:hover{ color:'.$light_colors['bg'].'; }';
	
	/* Light Sub BG */
	$css .= '.color-light .bgsc_bg{ background-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgsc_bg_hover:hover{ background-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgsc_border{ border-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgsc_border_hover:hover{ border-color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgsc_text{ color:'.$light_colors['bg'].'; }';
	$css .= '.color-light .bgsc_text_hover:hover{ color:'.$light_colors['bg'].'; }';
	
	
	
	/* Navigation */
	$css .= '.main-navigation a, .main-navigation a:visited{ color:'.$dark_colors['heading'].'; }';
	$css .= '.main-navigation a:hover, .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a{ color:'.$primary_color.'; }';
	
	return $css;
}



if ( ! function_exists( 'steed_element_menu' ) ) :
	function steed_element_menu($prefix, $settings) {
		wp_nav_menu( array( 'theme_location' => $settings['theme_location'], 'menu_id' => $settings['menu_id'] ) );
	}
endif;


if ( ! function_exists( 'steed_element_menuHand' ) ) :
	function steed_element_menuHand($prefix, $settings) {
		echo '<a href="#'.$settings['menu_id'].'" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>';
	}
endif;


if ( ! function_exists( 'steed_element_ResponsiveMenu' ) ) :
	function steed_element_ResponsiveMenu($prefix, $settings) {
		echo '<div class="responsive-menu">';
			echo '<a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a>';
		echo '</div>';
	}
endif;


if ( ! function_exists( 'steed_element_socialIcons' ) ) :
	function steed_element_socialIcons($the_prefix) {
		$prefix = esc_attr($the_prefix);
		$icon_1 = get_theme_mod($prefix.'social_icon_1', 'fa-facebook');
		$text_1 = esc_url(get_theme_mod($prefix.'social_text_1', '#'));
		$icon_2 = get_theme_mod($prefix.'social_icon_2', 'fa-twitter');
		$text_2 = esc_url(get_theme_mod($prefix.'social_text_2', '#'));
		$icon_3 = get_theme_mod($prefix.'social_icon_3', 'fa-linkedin');
		$text_3 = esc_url(get_theme_mod($prefix.'social_text_3', '#'));
		$icon_4 = get_theme_mod($prefix.'social_icon_4', '');
		$text_4 = esc_url(get_theme_mod($prefix.'social_text_4', ''));
		$icon_5 = get_theme_mod($prefix.'social_icon_5', '');
		$text_5 = esc_url(get_theme_mod($prefix.'social_text_5', ''));
		$icon_6 = get_theme_mod($prefix.'social_icon_6', '');
		$text_6 = esc_url(get_theme_mod($prefix.'social_text_6', ''));		
		?>
        <div class="social-icons">
			<?php if(!empty($icon_1) && !empty($text_1)): ?>
				<a href="<?php echo $text_1; ?>" rel="nofollow">
					<?php
						if(strpos($icon_1, 'fa') !== false){
							echo '<i class="fa '.esc_attr($icon_1).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_1).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_2) && !empty($text_2)): ?>
				<a href="<?php echo $text_2; ?>" rel="nofollow">
					<?php
						if(strpos($icon_2, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_2).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_2).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_3) && !empty($text_3)): ?>
				<a href="<?php echo $text_3; ?>" rel="nofollow">
					<?php
						if(strpos($icon_3, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_3).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_3).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_4) && !empty($text_4)): ?>
				<a href="<?php echo $text_4; ?>" rel="nofollow">
					<?php
						if(strpos($icon_4, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_4).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_4).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_5) && !empty($text_5)): ?>
				<a href="<?php echo $text_5; ?>" rel="nofollow">
					<?php
						if(strpos($icon_5, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_5).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_5).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_6) && !empty($text_6)): ?>
				<a href="<?php echo $text_6; ?>" rel="nofollow">
					<?php
						if(strpos($icon_6, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_6).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_6).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
		</div>
        <?php
	}
endif;

if ( ! function_exists( 'steed_element_text' ) ) :
	function steed_element_text($prefix) {
		$active = get_theme_mod($prefix.'active', '');
		$text = get_theme_mod($prefix.'text', '');
		
		if(esc_attr($active) == 'yes'){

			/* Security Check for Text */
			if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $text)){
				$the_text = '<a href="tel:'.esc_attr($text).'">'.esc_attr($text).'</a>';
			}
			elseif(filter_var($text, FILTER_VALIDATE_EMAIL)){
				$the_text = '<a href="mailto:'.esc_attr($text).'">'.esc_attr($text).'</a>';
			}
			else{
				$the_text = wp_kses_post($line1);
			}
			
			if(esc_attr($text) != ''){
			echo '<div class="elementText">';
				echo '<div class="elementText_in">';
					echo $the_text;
				echo '</div>';
			echo '</div>';
			}
		}
	}
endif;


if ( ! function_exists( 'steed_element_iconText' ) ) :
	function steed_element_iconText($prefix) {
		$active = get_theme_mod($prefix.'active', 'yes');
		$icon = get_theme_mod($prefix.'icon', '');
		$line1 = get_theme_mod($prefix.'line1', '');
		$line2 = get_theme_mod($prefix.'line2', '');
		
		if(esc_attr($active) == 'yes'){
			$the_icon = $icon;
			$the_line1 = $line1;
			$the_line2 = $line2;
			
			/* Security Check for icon */
			if(strpos($icon, 'fa-') !== false){
				$the_icon = '<i class="fa '.esc_attr($icon).'"></i>';;
			}
			elseif(!filter_var($icon, FILTER_VALIDATE_URL) === false){
				$the_icon = '<img src="'.esc_url($icon).'" alt="">';
			}
			else{
				$the_icon = wp_kses_post($icon);
			}
			
			/* Security Check for Line1 */
			if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $line1)){
				$the_line1 = '<a href="tel:'.esc_attr($line1).'">'.esc_attr($line1).'</a>';
			}
			elseif(filter_var($line1, FILTER_VALIDATE_EMAIL)){
				$the_line1 = '<a href="mailto:'.esc_attr($line1).'">'.esc_attr($line1).'</a>';
			}
			else{
				$the_line1 = wp_kses_post($line1);
			}
			
			/* Security Check for Line2 */
			if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $line2)){
				$the_line2 = '<a href="tel:'.esc_attr($line2).'">'.esc_attr($line2).'</a>';
			}
			elseif(filter_var($line2, FILTER_VALIDATE_EMAIL)){
				$the_line2 = '<a href="mailto:'.esc_attr($line2).'">'.esc_attr($line2).'</a>';
			}
			else{
				$the_line2 = wp_kses_post($line2);
			}
			
			$line_check_class = ((esc_attr($line1) != '') && (esc_attr($line2) != '')) ? 'both_line' : 'single_line';
			$icon_check_class = (esc_attr($icon) != '') ? 'has_icon' : 'no_icon';
			
			echo '<div class="iconText '.$icon_check_class.' '.$line_check_class.'">';
				echo '<div class="iconText_in">';
					if(esc_attr($icon) != ''){
					echo '<div class="iconText_icon">';
						echo $the_icon;
					echo '</div>';
					}
					if((esc_attr($line1) != '') || (esc_attr($line2) != '')){
					echo '<div class="iconText_content">';
						if(esc_attr($line1) != ''){
						echo '<strong>'.$the_line1.'</strong>';
						}
						if(esc_attr($line2) != ''){
						echo '<span>'.$the_line2.'</span>';
						}
					echo '</div>';
					}
				echo '</div>';
			echo '</div>';
		}
	}
endif;


if ( ! function_exists( 'steed_element_searchBar' ) ) :
	function steed_element_searchBar() {
		
	}
endif;


if ( ! function_exists( 'steed_element_searchIcon' ) ) :
	function steed_element_searchIcon() {
		
	}
endif;


if ( ! function_exists( 'steed_element_hamburgerMenu' ) ) :
	function steed_element_hamburgerMenu() {
		
	}
endif;


if ( ! function_exists( 'steed_element_loginRegister' ) ) :
	function steed_element_loginRegister() {
		
	}
endif;


if ( ! function_exists( 'steed_element_shoppingBag' ) ) :
	function steed_element_shoppingBag() {
		
	}
endif;


if ( ! function_exists( 'steed_element_button' ) ) :
	function steed_element_button() {
		
	}
endif;


if ( ! function_exists( 'steed_element_widget' ) ) :
	function steed_element_widget($prefix) {
		dynamic_sidebar( $prefix );
	}
endif;


if ( ! function_exists( 'steed_element_footerWidgets' ) ) :
	function steed_element_footerWidgets($prefix) {
		
		$layout = esc_attr(get_theme_mod($prefix.'layout', '3/3/3/3'));
		$layout_tab = esc_attr(get_theme_mod($prefix.'layout_tab', '6'));
		$layout_mobile = esc_attr(get_theme_mod($prefix.'layout_mobile', '12'));
		
		$widget_1 = false;
		$widget_2 = false;
		$widget_3 = false;
		$widget_4 = false;
		$widget_1_col = '12';
		$widget_2_col = '12';
		$widget_3_col = '12';
		$widget_4_col = '12';
		$layout_array = explode("/", $layout);
		
		if(isset($layout_array[0])){ $widget_1 = true; $widget_1_col = $layout_array[0]; }
		if(isset($layout_array[1])){ $widget_2 = true; $widget_2_col = $layout_array[1]; }
		if(isset($layout_array[2])){ $widget_3 = true; $widget_3_col = $layout_array[2]; }
		if(isset($layout_array[3])){ $widget_4 = true; $widget_4_col = $layout_array[3]; }
		
		echo '<div class="row">';
			if($widget_1){ 
				echo '<div class="col-md-'.$widget_1_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.' ">';
					dynamic_sidebar( $prefix.'_1' );
				echo '</div>';
			}
			if($widget_2){ 
				echo '<div class="col-md-'.$widget_2_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
					dynamic_sidebar( $prefix.'_2' );
				echo '</div>';
			}
			if($widget_3){ 
				echo '<div class="col-md-'.$widget_3_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
					dynamic_sidebar( $prefix.'_3' );
				echo '</div>';
			}
			if($widget_4){ 
				echo '<div class="col-md-'.$widget_4_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
					dynamic_sidebar( $prefix.'_4' );
				echo '</div>';
			}
		echo '</div>';
	}
endif;


if ( ! function_exists( 'steed_element_copyText' ) ) :
	function steed_element_copyText($prefix) {
		echo  wp_kses_post(get_theme_mod($prefix.'copytext', ''));
	}
endif;



if ( ! function_exists( 'steed_element_creditText' ) ) :
	function steed_element_creditText($prefix) {
		$mod_show = esc_attr(get_theme_mod($prefix.'show', 'yes'));
		
		if($mod_show == 'no'){
			echo '';
		}else{
			echo '<p>Theme Designed By <a href="'.esc_url('http://tallythemes.com').'" title="Sazzad Hu">Sazzad Hu</a> | Powered by <a href="'.esc_url('http://wordpress.org').'">WordPress</a></p>';	
		}
	}
endif;


if ( ! function_exists( 'steed_element_logo' ) ) :
	function steed_element_logo() {
		
		$output = '';
		$description = get_bloginfo( 'description', 'display' );
		$custom_logo_id = esc_attr(get_theme_mod( 'custom_logo' ));
		
		// Try to retrieve the Custom Logo
		if (function_exists('get_custom_logo')){
			if($custom_logo_id){
				$output = get_custom_logo();
			}
		}
	
		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
		if ($output == ''){
			if ( is_front_page() && is_home() ){
				$output .= '<h1  class="site-title"><a href="' . esc_url(home_url('/')) . '" class="hc_text">'.get_bloginfo( 'name' ).'</a></h1>';
			}else{
				$output .= '<p  class="site-title"><a href="' . esc_url(home_url('/')) . '" class="hc_text">'.get_bloginfo( 'name' ).'</a></p>';
			}
			if ( $description || is_customize_preview() ){
				$output .= '<p  class="site-description">'.$description.'</p>';
			}
		}
		
		/*Validating using wp_kses as the output contain images and h1 tags*/
		echo wp_kses($output, wp_kses_allowed_html( 'post' ));
	}
endif;


if ( ! function_exists( 'steed_element_pageHeading' ) ) :
	function steed_element_pageHeading() {
		
		if(is_search()){
			?>
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'steed' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			<?php
		}elseif(is_single()){
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo '<div class="entry-meta">';
				steed_posted_on();
			echo '</div>';
		}else{
			the_title( '<h1 class="entry-title">', '</h1>' );	
		}
	}
endif;