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
		
		$title = esc_attr(get_theme_mod($prefix.'title'));
		$des = esc_attr(get_theme_mod($prefix.'des'));
		$title_align = esc_attr(get_theme_mod($prefix.'title_align'));
		$padding_top = esc_attr(get_theme_mod($prefix.'padding_top'));
		$padding_bottom = esc_attr(get_theme_mod($prefix.'padding_bottom'));
		$bg_color = esc_attr(get_theme_mod($prefix.'bg_color'));
		$css_class = esc_attr(get_theme_mod($prefix.'css_class'));
		$css_id = esc_attr(get_theme_mod($prefix.'css_id'));
		$bg_image = esc_attr(get_theme_mod($prefix.'bg_img'));
		$bg_repeat = esc_attr(get_theme_mod($prefix.'bg_repeat'));
		$bg_attachment = esc_attr(get_theme_mod($prefix.'bg_attachment'));
		$bg_position = esc_attr(get_theme_mod($prefix.'bg_position'));
		$bg_size = esc_attr(get_theme_mod($prefix.'bg_size'));
		$equal_height = esc_attr(get_theme_mod($prefix.'equal_height'));
		$stretch = esc_attr(get_theme_mod($prefix.'stretch'));
		$content_max_width = esc_attr(get_theme_mod($prefix.'content_max_width'));
		$content_width = esc_attr(get_theme_mod($prefix.'content_width'));
		
		$style = '';
		$style .= ($padding_top != '') ? 'padding-top:'.$padding_top.';' : NULL;
		$style .= ($padding_bottom != '') ? 'padding-bottom:'.$padding_bottom.';' : NULL;
		$style .= ($bg_color != '') ? 'background-color:'.$bg_color.';' : NULL;
		$style .= ($bg_image != '') ? 'background-image:url('.$bg_image.');' : NULL;
		$style .= ($bg_repeat != '') ? 'background-repeat:'.$bg_repeat.';' : NULL;
		$style .= ($bg_attachment != '') ? 'background-attachment:'.$bg_attachment.';' : NULL;
		$style .= ($bg_position != '') ? 'background-position:'.$bg_position.';' : NULL;
		$style .= ($bg_size != '') ? 'background-size:'.$bg_size.';' : NULL;
		
		$style2 = '';
		$style2 .= ($content_max_width != '') ? 'max-width:'.$content_max_width.';' : NULL;
		$style2 .= ($content_width != '') ? 'width:'.$content_width.';' : NULL;
		
		$css_id = ($css_id != '') ? 'id="'.$css_id.'"' : NULL;
		
		$class = 'ec_section '.$css_class.' equal_height_'.$equal_height.' '.$stretch;
		
		if($active != 'no'){
			echo '<section class="'.$class.'" '.$css_id.' style="'.esc_attr($style).'">';
				echo '<div class="ec_section_in" style="'.esc_attr($style2).'">';
					if(!empty($title) || !empty($des)){
						echo '<div class="ec_section_header" style="text-align:'.$title_align.';">';
							if(!empty($title)){ echo '<h2>'.$title.'</h2>'; }
							if(!empty($des)){ echo '<p>'.$des.'</p>'; }
						echo '</div>';
					}
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
		$bg_repeat = esc_attr(get_theme_mod($prefix.'bg_repeat'));
		$bg_attachment = esc_attr(get_theme_mod($prefix.'bg_attachment'));
		$bg_position = esc_attr(get_theme_mod($prefix.'bg_position'));
		$bg_size = esc_attr(get_theme_mod($prefix.'bg_size'));
		$col = esc_attr(get_theme_mod($prefix.'col', $column['col']));
		
		$style = '';
		$style .= ($margin != '') ? 'padding:'.$margin.';' : NULL;
		$style .= ($bg_color != '') ? 'background-color:'.$bg_color.';' : NULL;
		$style .= ($bg_image != '') ? 'background-image:url('.$bg_image.');' : NULL;
		$style .= ($bg_repeat != '') ? 'background-repeat:'.$bg_repeat.';' : NULL;
		$style .= ($bg_attachment != '') ? 'background-attachment:'.$bg_attachment.';' : NULL;
		$style .= ($bg_position != '') ? 'background-position:'.$bg_position.';' : NULL;
		$style .= ($bg_size != '') ? 'background-size:'.$bg_size.';' : NULL;
		
		$style2 = '';
		$style2 .= ($padding != '') ? 'padding:'.$padding.';' : NULL;
		
		$css_id = ($css_id != '') ? 'id="'.$css_id.'"' : NULL;
		
		$class = 'ec_column ';
		$class .= $css_class.' ';
		$class .= 'col col-md-'.$col;
		
		if($active != 'no'){
			echo '<div class="'.$class.'" '.$css_id.' style="'.esc_attr($style).'">';
				echo '<div class="ec_column_in" style="'.esc_attr($style2).'">';
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
		$height = esc_attr(get_theme_mod($prefix.'height'));
	
		
		$css_id = ($css_id != '') ? 'id="'.$css_id.'"' : NULL;
		$max_height = ($height != '') ? 'max-height:'.$height.';' : NULL;
		
		if($allow == 'yes'){
			echo '<div class="ec_slideshow '.$css_class.'" '.$css_id.'>';
				
				echo '<div class="owl-carousel" style="'.esc_attr($max_height).'">';
				echo '<div class="ec_s_loader"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>';
				foreach($items as $item){
					$post = esc_attr(get_theme_mod($prefix.$item));
					
					if($post != 0){
							echo '<div class="ec_s_item">';
								echo '<div class="ec_s_item_in">';
									echo '<div class="ec_s_content" style="'.esc_attr($max_height).'">';
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