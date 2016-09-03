<?php
if(!function_exists('steed_ec_template_customize_build')):
	function steed_ec_template_customize_build($wp_customize, $tpl){
		$data = apply_filters('steed_ec_template_content', array());
		if(isset($data[$tpl])){
			if(is_array($data[$tpl])){
				
				$tpl_data = $data[$tpl];
				$tpl_name = $tpl_data['title'];
					
				foreach($tpl_data['sections'] as $section){
					steed_ec_template_customize_section($wp_customize, $tpl, $section, $tpl_name);
					foreach($section['columns'] as $column){
						steed_ec_template_customize_column($wp_customize, $tpl, $section, $column);
						foreach($column['blocks'] as $block){
							$block_function = $block['fn'].'_customize';
							if(function_exists($block_function)){
								$block_function($wp_customize, $tpl, $section, $column, $block);
							}
						}
					}
				}//END Item foreach
			}//Sub IF
		}//Main IF
			
		return $wp_customize;
	}
endif;

if(!function_exists('steed_ec_template_customize_section')):
	function steed_ec_template_customize_section($wp_customize, $tpl, $section, $tpl_name){
		$prefix = $tpl.'_'.$section['id'].'_';
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_settings');
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		
		$wp_customize->add_panel( esc_attr($customize_panel_id), array(
			'title' => esc_attr($tpl_name . ' ' .$section['title']),
			'description' => '',
			'priority' => 10,
		));
		
		$wp_customize->add_section( $customize_section_id, array(
			'title' => __('Section Settings', 'steed'),
			'priority' => 10,
			'panel' => esc_attr($customize_panel_id),
		));
		
		$uid = esc_attr($prefix.'active');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active This Section', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'radio',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
		));
		
		$uid = esc_attr($prefix.'title');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Section Title', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'des');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Section Description', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'textarea',
		));
		
		$uid = esc_attr($prefix.'title_align');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Title Align ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center',
				'none' => 'None',
			),
		));
		
		$uid = esc_attr($prefix.'padding_top');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Top Padding', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'padding_bottom');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Bottom Padding', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'bg_color');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $uid, array(
			'label'      => __('Background Color', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
		)));
		
		$uid = esc_attr($prefix.'bg_img');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $uid, array(
			'label'      => __('Background Image', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
		)));
		
		$uid = esc_attr($prefix.'bg_repeat');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Repeat', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'no-repeat'  => __('No Repeat', 'steed'),
                'repeat'     => __('Tile', 'steed'),
                'repeat-x'   => __('Tile Horizontally', 'steed'),
                'repeat-y'   => __('Tile Vertically', 'steed'),
			),
		));
		
		$uid = esc_attr($prefix.'bg_attachment');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Attachment', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'scroll'     => __('Scroll', 'steed'),
				'fixed'      => __('Fixed', 'steed'),
                
			),
		));
		
		$uid = esc_attr($prefix.'bg_position');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Position', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'left'       => __('Left', 'steed'),
                'center'     => __('Center', 'steed'),
                'right'      => __('Right', 'steed'),
			),
		));
		$uid = esc_attr($prefix.'bg_size');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Size', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'equal_height');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Equal Height', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'no' => 'No',
				'yes' => 'Yes',
			),
		));
		
		$uid = esc_attr($prefix.'stretch');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Section Stretch', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'' => 'Default',
				'stretch_row' => 'Stretch row',
				'stretch_row_content' => 'Stretch row and content',
				'stretch_row_content_no_spaces' => 'Stretch row and content (no paddings)',
			),
		));
		
		$uid = esc_attr($prefix.'css_class');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS Class', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'css_id');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS ID', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'content_max_width');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Max Content Width', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'content_width');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Content Width', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		return $wp_customize;
	}
endif;


if(!function_exists('steed_ec_template_customize_column')):
	function steed_ec_template_customize_column($wp_customize, $tpl, $section, $column){
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_';
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_settings');
		
		$column_name = esc_attr($column['title']).__(' Column', 'steed');
		$column_name2 = ' ('.$column_name.')';
		
		$uid = esc_attr($prefix.'heading');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( new steed_Customize_Control_heading( $wp_customize, $uid, array(
			'label'      => $column_name,
			'description'	=>__('All Settings of this column are here.', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
		)));
		
		$uid = esc_attr($prefix.'active');
		$wp_customize->add_setting($uid, array( 'default' => 'yes', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active ', 'steed').$column_name,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'radio',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
		));
		
		$uid = esc_attr($prefix.'padding');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Padding', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'bg_color');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $uid, array(
			'label'      => __('Background Color', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
		)));
		
		$uid = esc_attr($prefix.'bg_img');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $uid, array(
			'label'      => __('Background Image', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
		)));
		
		$uid = esc_attr($prefix.'bg_repeat');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Repeat', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'no-repeat'  => __('No Repeat', 'steed'),
                'repeat'     => __('Tile', 'steed'),
                'repeat-x'   => __('Tile Horizontally', 'steed'),
                'repeat-y'   => __('Tile Vertically', 'steed'),
			),
		));
		
		$uid = esc_attr($prefix.'bg_attachment');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Attachment', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'scroll'     => __('Scroll', 'steed'),
				'fixed'      => __('Fixed', 'steed'),
                
			),
		));
		
		$uid = esc_attr($prefix.'bg_position');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Position', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'left'       => __('Left', 'steed'),
                'center'     => __('Center', 'steed'),
                'right'      => __('Right', 'steed'),
			),
		));
		$uid = esc_attr($prefix.'bg_size');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Background Size', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'css_class');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS Class', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'css_id');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS ID', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		
		
		$uid = esc_attr($prefix.'col');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Column Layout ', 'steed').$column_name2,
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
				6 => '6',
				7 => '7',
				8 => '8',
				9 => '9',
				10 => '10',
				11 => '11',
				12 => '12',
			),
		));
		
		return $wp_customize;
	}
endif;


/*
	Slideshow
-----------------------------------*/
if(!function_exists('steed_ec_slideshow_customize')):
	function steed_ec_slideshow_customize($wp_customize, $tpl, $section, $column, $block){
		
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_slideshow_';
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_slideshow_');
		
		$items = array('post_1', 'post_2', 'post_3', 'post_4', 'post_5', 'post_6', 'post_7', 'post_8', 'post_9', 'post_10');
		
		$wp_customize->add_section( $customize_section_id, array(
			'title' => esc_attr($block['title']),
			'priority' => 10,
			'panel' => esc_attr($customize_panel_id),
		));
		
		
		$uid = esc_attr($prefix.'active');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'radio',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
		));
		
		foreach($items as $key => $item){
			$uid = esc_attr($prefix.$item);
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Select a Page for Slide # ', 'steed') . ($key + 1),
				'section'    => $customize_section_id,
				'settings'   => $uid,
				'type'       => 'dropdown-pages',
			));
		}
		
		$uid = esc_attr($prefix.'image_size');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Image Size', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'height');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Max Height', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'css_class');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS Class', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'css_id');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS ID', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		return $wp_customize;
	}
endif;


/*
	Text
-----------------------------------*/
if(!function_exists('steed_ec_text_customize')):
	function steed_ec_text_customize($wp_customize, $tpl, $section, $column, $block){
		
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_text_';
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_text_');
		
		$wp_customize->add_section( $customize_section_id, array(
			'title' => esc_attr($block['title']),
			'priority' => 10,
			'panel' => esc_attr($customize_panel_id),
		));
		
		
		$uid = esc_attr($prefix.'active');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'radio',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
		));
		
		$uid = esc_attr($prefix.'post');
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Select a Page', 'steed'),
				'section'    => $customize_section_id,
				'settings'   => $uid,
				'type'       => 'dropdown-pages',
		));
		
		$uid = esc_attr($prefix.'align');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Align ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center',
				'none' => 'None',
			),
		));
		
		$uid = esc_attr($prefix.'css_class');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS Class', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'css_id');
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('CSS ID', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'text',
		));
		
		$uid = esc_attr($prefix.'color_type');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Color Type ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'select',
			'choices'    => array(
				'none' => 'None',
				'dark' => 'Dark',
				'light' => 'Light',
			),
		));
		
		return $wp_customize;
	}
endif;