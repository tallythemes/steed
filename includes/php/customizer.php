<?php
/**
 * Steed Theme Customizer.
 *
 * @package Steed
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function steed_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	steed_ec_template_customize_build($wp_customize, 'home');
}
add_action( 'customize_register', 'steed_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function steed_customize_preview_js() {
	wp_enqueue_script( 'steed_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'steed_customize_preview_js' );


function steed_customizer_button_set(){
	
	$info = apply_filters('steed_customizer_info', array(
		'text' => __('<strong>Love this theme? Just click on the button just Above and start downloading</strong>','steed'),
		'button_1_text' => __('Download More FREE Themes', 'steed'),
		'button_2_text' => __('Theme Documentation', 'steed'),
		'button_1_url' => esc_url('http://tallythemes.com/product-category/free-wordpress-themes/'),
		'button_2_url' => esc_url('http://tallythemes.com/steed-documentation'),
	));
	
	wp_enqueue_script( 'steed-customizer-buttons', get_template_directory_uri() . '/assets/js/customizer-button.js', array("jquery"), '1.0', true  );
	wp_localize_script( 'steed-customizer-buttons', 'steed_objectL10n', array(
		'text' => $info['text'],
		'btn_1_text' => $info['button_1_text'],
		'btn_2_text' => $info['button_2_text'],
		'btn_1_url' => $info['button_1_url'],
		'btn_2_url' => $info['button_2_url'],
	) );
}
add_action( 'customize_controls_enqueue_scripts', 'steed_customizer_button_set' );


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
		
		$wp_customize->add_panel( esc_attr($tpl), array(
			'title' => esc_attr($tpl_name . ' ' .$section['title']),
			'description' => '',
			'priority' => 10,
		));
		
		$wp_customize->add_section( $customize_section_id, array(
			'title' => __('Section Settings', 'steed'),
			'priority' => 10,
			'panel' => esc_attr($tpl),
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
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $uid, array(
			'label'      => __('Background Image', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
		)));
		
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


if(!function_exists('steed_ec_template_customize_column')):
	function steed_ec_template_customize_column($wp_customize, $tpl, $section, $column){
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_';
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_settings');
		
		$uid = esc_attr($prefix.'active');
		$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active ', 'steed').esc_attr($column['title']).__(' Column', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
			'type'       => 'radio',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
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
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $uid, array(
			'label'      => __('Background Image', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => $uid,
		)));
		
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

if(!function_exists('steed_ec_slideshow_customize')):
	function steed_ec_slideshow_customize($wp_customize, $tpl, $section, $column, $block){
		
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_slideshow_';
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_slideshow_');
		
		$items = array('post_1', 'post_2', 'post_3', 'post_4', 'post_5', 'post_6', 'post_7', 'post_8', 'post_9', 'post_10');
		
		$wp_customize->add_section( $customize_section_id, array(
			'title' => esc_attr($block['title']),
			'priority' => 10,
			'panel' => esc_attr($tpl),
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