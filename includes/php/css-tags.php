<?php
if(!function_exists('steed_CSS_padding')):
function steed_CSS_padding($the_prefix, $selector, $settings = array()){
	$atr = array_merge(array(
		"std_top" => "",
		"std_bottom" => "",
	), $settings);
		
	$prefix = esc_attr($the_prefix);
	$padding_top = esc_attr(get_theme_mod($prefix.'padding_top', $atr['std_top']));
	$padding_bottom = esc_attr(get_theme_mod($prefix.'padding_bottom', $atr['std_bottom']));

	$css = ($padding_top != '') ? 'padding-top:'.$padding_top.';' : '';
	$css .= ($padding_bottom != '') ? 'padding-bottom:'.$padding_bottom.';' : '';
	
	if(!empty($css)){ return $selector.'{'.$css.'}'; }else{ return ''; }
}
endif;


if(!function_exists('steed_CSS_background')):
function steed_CSS_background($the_prefix, $selector, $settings = array()){
	$atr = array_merge(array(
		"std-image" => "",
		"std-color" => "",
		"std-repeat" => "",
		"std-attachment" => "",
		"std-position" => "",
		"std-size" => "",
	), $settings);
		
	$prefix = esc_attr($the_prefix);
	$image = esc_url(get_theme_mod($prefix.'bg_image', $atr['std-image']));
	$color = sanitize_hex_color(get_theme_mod($prefix.'bg_color', $atr['std-color']));
	$repeat = esc_attr(get_theme_mod($prefix.'bg_repeat', $atr['std-repeat']));
	$attachment = esc_attr(get_theme_mod($prefix.'bg_attachment', $atr['std-attachment']));
	$position = esc_attr(get_theme_mod($prefix.'bg_position', $atr['std-position']));
	$size = esc_attr(get_theme_mod($prefix.'bg_size', $atr['std-size']));

	$css = ($image != '') ? 'background-image:url('.$image.');' : '';
	$css .= ($color != '') ? 'background-color:'.$color.';' : '';
	$css .= ($repeat != '') ? 'background-repeat:'.$repeat.';' : '';
	$css .= ($attachment != '') ? 'background-attachment:'.$attachment.';' : '';
	$css .= ($position != '') ? 'background-position:'.$position.';' : '';
	$css .= ($size != '') ? 'background-size:'.$size.';' : '';
	
	if(!empty($css)){ return $selector.'{'.$css.'}'; }else{ return ''; }
}
endif;


if(!function_exists('steed_element_CSS_menuColors')):
function steed_element_CSS_menuColors($selector, $settings = array()){
	$atr = array_merge(array(
		"menucolor_t_text" => "",
		"menucolor_t_bg" => "",
		"menucolor_t_border" => "",
		"menucolor_th_text" => "",
		"menucolor_th_bg" => "",
		"menucolor_th_border" => "",
		"menucolor_s_text" => "",
		"menucolor_s_bg" => "",
		"menucolor_s_border" => "",
		"menucolor_sh_text" => "",
		"menucolor_sh_bg" => "",
		"menucolor_sh_border" => "",
	), $settings);
		
	$prefix = '';

	$menucolor_t_text		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_t_text', $atr['menucolor_t_text']));
	$menucolor_t_bg			= sanitize_hex_color(get_theme_mod($prefix.'menucolor_t_bg', $atr['menucolor_t_bg']));
	$menucolor_t_border		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_t_border', $atr['menucolor_t_border']));
	$menucolor_th_text		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_th_text', $atr['menucolor_th_text']));
	$menucolor_th_bg		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_th_bg', $atr['menucolor_th_bg']));
	$menucolor_th_border	= sanitize_hex_color(get_theme_mod($prefix.'menucolor_th_border', $atr['menucolor_th_border']));
	$menucolor_s_text		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_s_text', $atr['menucolor_s_text']));
	$menucolor_s_bg			= sanitize_hex_color(get_theme_mod($prefix.'menucolor_s_bg', $atr['menucolor_s_bg']));
	$menucolor_s_border		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_s_border', $atr['menucolor_s_border']));
	$menucolor_sh_text		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_sh_text', $atr['menucolor_sh_text']));
	$menucolor_sh_bg		= sanitize_hex_color(get_theme_mod($prefix.'menucolor_sh_bg', $atr['menucolor_sh_bg']));
	$menucolor_sh_border	= sanitize_hex_color(get_theme_mod($prefix.'menucolor_sh_border', $atr['menucolor_sh_border']));
	
	$output = NULL;

	$css_1  =  ($menucolor_t_text != '') ? 'color:'.$menucolor_t_text.';' : '';
	$css_1 .=  ($menucolor_t_bg != '') ? 'background-color:'.$menucolor_t_bg.';' : '';
	$css_1 .=  ($menucolor_t_border != '') ? 'border-color:'.$menucolor_t_border.';' : '';
	if( !empty($css_1) ){ $output .= $selector.' > li{ '.$css_1.' }';  }
	if( !empty($menucolor_t_text) ){ $output .= 'a.responsive-menu-hand{ color:'.$menucolor_t_text.'; }';  }
	
	$css_2  =  ($menucolor_th_text != '') ? 'color:'.$menucolor_th_text.';' : '';
	$css_2 .=  ($menucolor_th_bg != '') ? 'background-color:'.$menucolor_th_bg.';' : '';
	$css_2 .=  ($menucolor_th_border != '') ? 'border-color:'.$menucolor_th_border.';' : '';
	if( !empty($css_2) ){ 
		$output .= $selector.' > li:hover, 
				 '.$selector.' > .current_page_item,
				 '.$selector.' > .current-menu-item,
				 '.$selector.' > .current_page_ancestor{ '.$css_2.' }'; 
	}
	if( !empty($menucolor_th_text) ){ $output .= 'a.responsive-menu-hand:hover{ color:'.$menucolor_th_text.'; }';  }
	
	$css_3  =  ($menucolor_s_text != '') ? 'color:'.$menucolor_s_text.';' : '';
	$css_3 .=  ($menucolor_s_bg != '') ? 'background-color:'.$menucolor_s_bg.';' : '';
	$css_3 .=  ($menucolor_s_border != '') ? 'border-color:'.$menucolor_s_border.';' : '';
	if( !empty($css_3) ){ $output .= $selector.' li ul li{ '.$css_3.' }'; }
	
	$css_4  =  ($menucolor_sh_text != '') ? 'color:'.$menucolor_sh_text.';' : '';
	$css_4 .=  ($menucolor_sh_bg != '') ? 'background-color:'.$menucolor_sh_bg.';' : '';
	$css_4 .=  ($menucolor_sh_border != '') ? 'border-color:'.$menucolor_sh_border.';' : '';
	if( !empty($css_4) ){ 
		$output .= $selector.' li ul li:hover, 
				 '.$selector.' li ul .current_page_item,
				 '.$selector.' li ul .current-menu-item,
				 '.$selector.' li ul .current_page_ancestor{ '.$css_4.' }'; 
	}

	return $output;
}
endif;


if(!function_exists('steed_element_CSS_socialIcons')):
function steed_element_CSS_socialIcons($the_prefix, $selector, $settings = array()){
	$atr = array_merge(array(
		"social_icon_color" => "",
		"social_bg_color" => "",
		"social_border_color" => "",
		"social_icon_color_h" => "",
		"social_bg_color_h" => "",
		"social_border_color_h" => "",
	), $settings);
		
	$prefix = esc_attr($the_prefix);

	$social_icon_color		= sanitize_hex_color(get_theme_mod($prefix.'social_icon_color', $atr['social_icon_color']));
	$social_bg_color		= sanitize_hex_color(get_theme_mod($prefix.'social_bg_color', $atr['social_bg_color']));
	$social_border_color	= sanitize_hex_color(get_theme_mod($prefix.'social_border_color', $atr['social_border_color']));
	$social_icon_color_h	= sanitize_hex_color(get_theme_mod($prefix.'social_icon_color_h', $atr['social_icon_color_h']));
	$social_bg_color_h		= sanitize_hex_color(get_theme_mod($prefix.'social_bg_color_h', $atr['social_bg_color_h']));
	$social_border_color_h	= sanitize_hex_color(get_theme_mod($prefix.'social_border_color_h', $atr['social_border_color_h']));

	$output = NULL;

	$css_1  =  ($social_icon_color != '')	? 'color:'.$social_icon_color.';' : '';
	$css_1 .=  ($social_bg_color != '')		? 'background-color:'.$social_bg_color.';' : '';
	$css_1 .=  ($social_border_color != '')	? 'border-color:'.$social_border_color.';' : '';
	if( !empty($css_1) ){ $output .= $selector.' .social-icons a{ '.$css_1.' }'; }
	
	$css_2  =  ($social_icon_color_h != '')		? 'color:'.$social_icon_color_h.';' : '';
	$css_2 .=  ($social_bg_color_h != '')		? 'background-color:'.$social_bg_color_h.';' : '';
	$css_2 .=  ($social_border_color_h != '')	? 'border-color:'.$social_border_color_h.';' : '';
	if( !empty($css_2) ){ $output .= $selector.' .social-icons a:hover{ '.$css_2.' }'; }

	return $output;
}
endif;