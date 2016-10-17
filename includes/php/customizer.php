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
	//$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	//$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	steed_site_part_customize_render('site_header', $wp_customize);
	steed_site_part_customize_render('after_site_header', $wp_customize);
	steed_site_part_customize_render('site_footer', $wp_customize);
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


if( class_exists( 'WP_Customize_Control' ) ):
	class steed_Customize_Control_heading extends WP_Customize_Control {
		
		public $label;
		public $description;
		
		public function render_content(){
			?>
            <div class="steed_Customize_Control_heading" style="background-color: #00a0d2; padding: 10px 15px; margin-left: -15px; margin-right: -15px;">
              	<?php
					if($this->label){ echo '<h4 style="margin: 0; color: #fff; font-size: 15px;">'.$this->label.'</h4>'; }
					if($this->description){ echo '<p style="color:#fff;">'.$this->description.'</p>'; }
				?>
            </div>
            <?php
		}
	}
endif;


function steed_customizer_background($wp_customize, $section_prefix_id, $prefix, $std){
	
	$std_image = '';
	$std_color = '';
	$std_repeat = '';
	$std_attachment = '';
	$std_position = '';
	$std_size = '';
	
	$std_image = (isset($std['image'])) ? $std['image'] : '';
	$std_color = (isset($std['color'])) ? $std['color'] : '';
	$std_repeat = (isset($std['repeat'])) ? $std['repeat'] : '';
	$std_attachment = (isset($std['attachment'])) ? $std['attachment'] : '';
	$std_position = (isset($std['position'])) ? $std['position'] : '';
	$std_size = (isset($std['size'])) ? $std['size'] : '';
	
	$uid = $prefix.'image';
	$wp_customize->add_setting($uid, array( 'default' => $std_image, 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $uid, array(
		'label'      => __('Background Image', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	
	if(steed_mal()){
	$uid = $prefix.'color';
	$wp_customize->add_setting($uid, array( 'default' => $std_color, 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Background Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	
	$uid = $prefix.'repeat';
	$wp_customize->add_setting($uid, array( 'default' => $std_repeat, 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Background Repeat', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'select',
		'description' => '',
		'choices' => array(
			'' => 'none',
			'no-repeat' => 'no-repeat',
			'repeat-x' => 'repeat-x',
			'repeat-y' => 'repeat-y',
		),
	));
	
	$uid = $prefix.'attachment';
	$wp_customize->add_setting($uid, array( 'default' => $std_attachment, 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Background Attachment', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'select',
		'description' => '',
		'choices' => array(
			'' => 'none',
			'fixed' => 'fixed',
			'inherit' => 'inherit',
		),
	));
	$uid = $prefix.'position';
	$wp_customize->add_setting($uid, array( 'default' => $std_position, 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Background Position', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'select',
		'description' => '',
		'choices' => array(
			'' => 'none',
			'center center' => 'center center',
			'center top' => 'center top',
			'center bottom' => 'center bottom',
			'left top' => 'left top',
			'left bottom' => 'left bottom',
			'right top' => 'right top',
			'right bottom' => 'right bottom',
			'left center' => 'left center',
			'right center' => 'right center',
		),
	));
	$uid = $prefix.'size';
	$wp_customize->add_setting($uid, array( 'default' => $std_size, 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Background Size', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'select',
		'description' => '',
		'choices' => array(
			'' => 'none',
			'cover' => 'cover',
			'contain' => 'contain',
		),
	));
	}
	
	return $wp_customize;
}


function steed_customizer_padding($wp_customize, $section_prefix_id, $prefix, $std){
	
	$std_top = (isset($std['top'])) ? $std['top'] : '';
	$std_bottom = (isset($std['bottom'])) ? $std['bottom'] : '';

	
	if(steed_mal()){
		$uid = $prefix.'top';
		$wp_customize->add_setting($uid, array( 'default' => $std_top, 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Padding Top', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => '',
		));
		$uid = $prefix.'bottom';
		$wp_customize->add_setting($uid, array( 'default' => $std_bottom, 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Padding Bottom', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => '',
		));
	}
	
	return $wp_customize;
}
function steed_customizer_colorMood($wp_customize, $section_prefix_id, $prefix, $std){

	
	if(steed_mal()){
		$uid = $prefix.'colorMood';
		$wp_customize->add_setting($uid, array( 'default' => $std, 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Text Color Mood', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'select',
			'description' => 'If your background is dard you shpuld select light.',
			'choices' => array(
				'dark' => 'dark',
				'light' => 'light',
			),
		));
		
	}
	
	return $wp_customize;
}



function steed_element_customize_socialIcons($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$uid = $prefix.'social_icon_1';
	$wp_customize->add_setting($uid, array( 'default' => 'fa-facebook', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #1 Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the social media.',
	));
	$uid = $prefix.'social_text_1';
	$wp_customize->add_setting($uid, array( 'default' => '#', 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #1 Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Enter the Full URL incloding <code>http://</code>',
	));
	
	$uid = $prefix.'social_icon_2';
	$wp_customize->add_setting($uid, array( 'default' => 'fa-twitter', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #2 Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the social media.',
	));
	$uid = $prefix.'social_text_2';
	$wp_customize->add_setting($uid, array( 'default' => '#', 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #2 Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Enter the Full URL incloding <code>http://</code>',
	));
	
	$uid = $prefix.'social_icon_3';
	$wp_customize->add_setting($uid, array( 'default' => 'fa-linkedin', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #3 Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the social media.',
	));
	$uid = $prefix.'social_text_3';
	$wp_customize->add_setting($uid, array( 'default' => '#', 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #3 Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Enter the Full URL incloding <code>http://</code>',
	));
	
	$uid = $prefix.'social_icon_4';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #4 Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the social media.',
	));
	$uid = $prefix.'social_text_4';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #4 Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Enter the Full URL incloding <code>http://</code>',
	));
	
	$uid = $prefix.'social_icon_5';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #5 Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the social media.',
	));
	$uid = $prefix.'social_text_5';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #5 Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Enter the Full URL incloding <code>http://</code>',
	));
	
	$uid = $prefix.'social_icon_6';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #6 Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the social media.',
	));
	$uid = $prefix.'social_text_6';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Social #6 Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Enter the Full URL incloding <code>http://</code>',
	));
	
	return $wp_customize;
}



function steed_element_customize_iconText($prefix, $section_prefix_id, $element_settings, $wp_customize){
	$uid = $prefix.'icon';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the social media.',
	));
	$uid = $prefix.'line1';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Line 1', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'line2';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Line 2', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	
	return $wp_customize;
}




function steed_element_customize_copyText($prefix, $section_prefix_id, $element_settings, $wp_customize){
	$uid = $prefix.'copytext';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'wp_kses_post', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Copyright Text', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'textarea',
		'description' => '',
	));
	
	return $wp_customize;
}


function steed_element_customize_creditText($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	if(steed_mal()){
		$uid = $prefix.'show';
		$wp_customize->add_setting($uid, array( 'default' => 'yes', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Copyright Text', 'steed'),
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
	
	return $wp_customize;
}

function steed_element_customize_footerWidgets($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	if(steed_mal()){
		$uid = $prefix.'layout';
		$wp_customize->add_setting($uid, array( 'default' => '3/3/3/3', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Layout', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'select',
			'description' => '',
			'choices' => array(
				'12' => '100%',
				'6/6' => '50% + 50%',
				'4/4/4' => '33% + 33%  + 33%',
				'3/3/3/3' => '25% + 25%  + 25%  + 25%',
				'6/3/3' => '50%  + 25%  + 25%',
				'3/3/6' => '25% + 25%  + 50%',
				'8/4' => '65% + 35%',
				'4/8' => '35% + 65%',
				'3/9' => '25% + 75%',
				'9/3' => '75% + 25%',
			),
		));
		
		$uid = $prefix.'layout_tab';
		$wp_customize->add_setting($uid, array( 'default' => '6', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Layout (Responsive Tab)', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'select',
			'description' => '',
			'choices' => array(
				'12' => '1 Column',
				'6' => '2 Column',
				'4' => '3 Column',
				'3' => '4 Column',
			),
		));
		
		$uid = $prefix.'layout_mobile';
		$wp_customize->add_setting($uid, array( 'default' => '12', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Layout (Responsive Mobile)', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'select',
			'description' => '',
			'choices' => array(
				'12' => '1 Column',
				'6' => '2 Column',
			),
		));
	}
	
	return $wp_customize;
}