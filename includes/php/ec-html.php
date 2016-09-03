<?php

if(!function_exists('steed_ec_template_content_build')):
	function steed_ec_template_content_build($tpl){
		$data = apply_filters('steed_ec_template_content', array());
		
		if(isset($data[$tpl])){
			if(is_array($data[$tpl])){
				$tpl_data = $data[$tpl];
				
				foreach($tpl_data['sections'] as $section){
					steed_ec_template_content_section($tpl, $section);
				}//END Item foreach
				
			}//Sub IF
		}//Main IF
	}
endif;


if(!function_exists('steed_ec_template_content_section')):
	function steed_ec_template_content_section($tpl, $section){
		$section_id = $section['id'];
		
		$prefix = $tpl.'_'.$section_id.'_';
		
		$active = esc_attr(get_theme_mod($prefix.'active'));
		
		$padding_top = esc_attr(get_theme_mod($prefix.'padding_top'));
		$padding_bottom = esc_attr(get_theme_mod($prefix.'padding_bottom'));
		$bg_color = esc_attr(get_theme_mod($prefix.'bg_color'));
		$css_class = esc_attr(get_theme_mod($prefix.'css_class'));
		$css_id = esc_attr(get_theme_mod($prefix.'css_id'));
		$bg_image = esc_attr(get_theme_mod($prefix.'bg_img'));
		$equal_height = esc_attr(get_theme_mod($prefix.'equal_height'));
		$stretch = esc_attr(get_theme_mod($prefix.'stretch'));
		
		$style = '';
		$style .= ($padding_top != '') ? 'padding-top:'.$padding_top.';' : NULL;
		$style .= ($padding_bottom != '') ? 'padding-bottom:'.$padding_bottom.';' : NULL;
		$style .= ($bg_color != '') ? 'background-color:'.$bg_color.';' : NULL;
		$style .= ($bg_image != '') ? 'background-image:url('.$bg_image.');' : NULL;
		
		$css_id = ($css_id != '') ? 'id="'.$css_id.'"' : NULL;
		
		$class = 'ec_section '.$css_class.' equal_height_'.$equal_height.' '.$stretch;
		
		if($active != 'no'){
			echo '<section class="'.$class.'" '.$css_id.' style="'.esc_attr($style).'">';
				echo '<div class="ec_section_in">';
					echo '<div class="row">';
					foreach($section['columns'] as $column){
						steed_ec_template_content_column($tpl, $section, $column);
					}
					echo '</div>';
				echo '</div>';
			echo '</section>';
		}
	}
endif;


if(!function_exists('steed_ec_template_content_column')):
	function steed_ec_template_content_column($tpl, $section, $column){
		
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_';
		
		$active = esc_attr(get_theme_mod($prefix.'active'));
		
		$padding = esc_attr(get_theme_mod($prefix.'padding'));
		$margin = esc_attr(get_theme_mod($prefix.'margin'));
		$bg_color = esc_attr(get_theme_mod($prefix.'bg_color'));
		$css_class = esc_attr(get_theme_mod($prefix.'css_class'));
		$css_id = esc_attr(get_theme_mod($prefix.'css_id'));
		$bg_image = esc_attr(get_theme_mod($prefix.'bg_img'));
		$col = esc_attr(get_theme_mod($prefix.'col', $column['col']));
		
		$style = '';
		$style .= ($padding != '') ? 'padding:'.$padding.';' : NULL;
		$style .= ($margin != '') ? 'padding:'.$margin.';' : NULL;
		$style .= ($bg_color != '') ? 'background-color:'.$bg_color.';' : NULL;
		$style .= ($bg_image != '') ? 'background-image:url('.$bg_image.');' : NULL;
		
		$css_id = ($css_id != '') ? 'id="'.$css_id.'"' : NULL;
		
		$class = 'ec_column ';
		$class .= $css_class.' ';
		$class .= 'col col-md-'.$col;
		
		if($active != 'no'){
			echo '<div class="'.$class.'" '.$css_id.' style="'.esc_attr($style).'">';
				echo '<div class="ec_column_in">';
					foreach($column['blocks'] as $block){
						$block_function = $block['fn'];
						if(function_exists($block_function)){
							$block_function($tpl, $section, $column, $block);
						}
					}
				echo '</div>';
			echo '</div>';
		}
	}
endif;



/*
	Slideshow
-----------------------------------*/
if(!function_exists('steed_ec_slideshow')):
	function steed_ec_slideshow( $tpl, $section, $column, $block ){
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_slideshow_';
		
		$items = array('post_1', 'post_2', 'post_3', 'post_4', 'post_5', 'post_6', 'post_7', 'post_8', 'post_9', 'post_10');
		
		$css_class = esc_attr(get_theme_mod($prefix.'css_class'));
		$css_id = esc_attr(get_theme_mod($prefix.'css_id'));
		$allow = esc_attr(get_theme_mod($prefix.'active'));
		$image_size = esc_attr(get_theme_mod($prefix.'image_size', 'full'));
	
		
		$css_id = ($css_id != '') ? 'id="'.$css_id.'"' : NULL;
		
		if($allow == 'yes'){
			echo '<div class="ec_slideshow '.$css_class.'" '.$css_id.'>';
				echo '<div class="owl-carousel">';
				foreach($items as $item){
					$post = esc_attr(get_theme_mod($prefix.$item));
					
					if($post != 0){
							echo '<div class="ec_s_item">';
								echo '<div class="ec_s_item_in">';
									echo '<div class="ec_s_content">';
										echo '<div class="ec_s_content_in">';
											echo '<div class="ec_s_con">';
												steed_get_post_data($post, 'content');
											echo '</div>';
										echo '</div>';
									echo '</div>';
									steed_get_post_data($post, 'thumbnail', $image_size);
								echo '</div>';
							echo '</div>';
					}
				}
				echo '</div>';
			echo '</div>';
		}
	}
endif;


/*
	Text
-----------------------------------*/
if(!function_exists('steed_ec_text')):
	function steed_ec_text( $tpl, $section, $column, $block ){
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_text_';
		
		$post = esc_attr(get_theme_mod($prefix.'post'));
		
		$css_class = esc_attr(get_theme_mod($prefix.'css_class'));
		$css_id = esc_attr(get_theme_mod($prefix.'css_id'));
		$allow = esc_attr(get_theme_mod($prefix.'active'));
		$align = esc_attr(get_theme_mod($prefix.'align'));
		$color_type = esc_attr(get_theme_mod($prefix.'color_type'));
		
		$css_id = ($css_id != '') ? 'id="'.$css_id.'"' : NULL;
		
		$style = '';
		$style .= ($align != '') ? 'text-align:'.$align.';' : NULL;
		
		if($allow == 'yes'){
			echo '<div class="ec_text '.$css_class.' color_'.$color_type.'" '.$css_id.' style="'.$style.'">';
				echo '<div class="ec_text_in">';
					steed_get_post_data($post, 'content');
				echo '</div>';
			echo '</div>';
		}
	}
endif;