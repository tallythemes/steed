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
	
	if(steed_mal()){
		$wp_customize->add_section( 'site_content_style' , array(
			'title'		=> __( 'Content area Style & BG', 'steed' ),
			'priority'	=> 160,
			//'panel'		=> '',
		));

		steed_customizer_padding('content_area_', 'site_content_style', NULL, $wp_customize);
		steed_customizer_colorMood('content_area_', 'site_content_style', NULL, $wp_customize);
		/**/steed_Customize_Control_heading('content_area_1_', 'site_content_style', 'Background', NULL, $wp_customize);
		steed_customizer_background('content_area_', 'site_content_style', NULL, $wp_customize);
		
		
		$wp_customize->add_section( 'site_colors' , array(
			'title'		=> __( 'All Colors', 'steed' ),
			'priority'	=> 160,
			//'panel'		=> '',
		));
		//https://www.materialpalette.com/red/green
		steed_Customize_Control_color('primary_l_', 'site_colors', 'Primary Light Color', NULL, $wp_customize);
		steed_Customize_Control_color('primary_', 'site_colors', 'Primary Color', NULL, $wp_customize);
		steed_Customize_Control_color('primary_d_', 'site_colors', 'Primary Dark Color', NULL, $wp_customize);
		steed_Customize_Control_color('accent_', 'site_colors', 'Accent Color', NULL, $wp_customize);
		steed_Customize_Control_color('light_', 'site_colors', 'Light Color', NULL, $wp_customize);
		steed_Customize_Control_color('dim_light_', 'site_colors', 'Dim Light Color', NULL, $wp_customize);
		steed_Customize_Control_color('dim_dark_', 'site_colors', 'Dim Dark Color', NULL, $wp_customize);
		steed_Customize_Control_color('dark_', 'site_colors', 'Dark Color', NULL, $wp_customize);
		
		
		$wp_customize->add_section( 'site_fonts' , array(
			'title'		=> __( 'Font &amp; Typography', 'steed' ),
			'priority'	=> 160,
			//'panel'		=> '',
		));
		
		$uid = 'google_font_1';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Heading Font', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'How to Video <a href="'.esc_url('https://youtu.be/UR44pooS5NA').'" target="_blank">'.esc_url('https://youtu.be/UR44pooS5NA').'</a>. Get google font from <a href="'.esc_url('https://fonts.google.com/').'" target="_blank">'.esc_url('https://fonts.google.com/').'</a>. Example: <code>PT+Sans:400,400i,700,700i</code>',
		));
		
		$uid = 'google_font_2';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Menu Font', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'How to Video <a href="'.esc_url('https://youtu.be/UR44pooS5NA').'" target="_blank">'.esc_url('https://youtu.be/UR44pooS5NA').'</a>. Get google font from <a href="'.esc_url('https://fonts.google.com/').'" target="_blank">'.esc_url('https://fonts.google.com/').'</a>. Example: <code>PT+Sans:400,400i,700,700i</code>',
		));
		
		$uid = 'google_font_3';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Body Font', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'How to Video <a href="'.esc_url('https://youtu.be/UR44pooS5NA').'" target="_blank">'.esc_url('https://youtu.be/UR44pooS5NA').'</a>. Get google font from <a href="'.esc_url('https://fonts.google.com/').'" target="_blank">'.esc_url('https://fonts.google.com/').'</a>. Example: <code>PT+Sans:400,400i,700,700i</code>',
		));
		
		
		$uid = 'h1_size';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('H1 Font Size', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Example: <code>40px</code>',
		));
		
		$uid = 'h2_size';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('H2 Font Size', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Example: <code>40px</code>',
		));
		
		$uid = 'h3_size';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('H3 Font Size', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Example: <code>32px</code>',
		));
		
		$uid = 'h4_size';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('H4 Font Size', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Example: <code>24px</code>',
		));
		
		$uid = 'h5_size';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('H5 Font Size', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Example: <code>18px</code>',
		));
		
		$uid = 'h6_size';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('H6 Font Size', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Example: <code>16px</code>',
		));
		
		$uid = 'body_font_size';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Body Font Size', 'steed'),
			'section'    => 'site_fonts',
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Example: <code>14px</code>',
		));
		
		
		$wp_customize->add_section( 'site_menu_colors' , array(
			'title'		=> __( 'Site Menu Colors', 'steed' ),
			'priority'	=> 160,
			//'panel'		=> '',
		));
		steed_element_customize_menuColors('site_menu_colors', NULL, $wp_customize);
		
	}
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
		'text' => __('<strong>Love this theme? Just click on the button Above and start downloading</strong>','steed'),
		'button_1_text' => __('Download More FREE Themes', 'steed'),
		//'button_2_text' => __('Theme Documentation', 'steed'),
		'button_1_url' => esc_url('http://tallythemes.com/product-category/free-wordpress-themes/'),
		//'button_2_url' => esc_url('http://tallythemes.com/steed-documentation'),
	));
	
	wp_enqueue_script( 'steed-customizer-buttons', get_template_directory_uri() . '/assets/js/customizer-button.js', array("jquery"), '1.0', true  );
	wp_localize_script( 'steed-customizer-buttons', 'steed_objectL10n', array(
		'text' => $info['text'],
		'btn_1_text' => $info['button_1_text'],
		//'btn_2_text' => $info['button_2_text'],
		'btn_1_url' => $info['button_1_url'],
		//'btn_2_url' => $info['button_2_url'],
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

function steed_Customize_Control_heading($prefix, $section_prefix_id, $title="", $des ="", $wp_customize){
	$uid = $prefix.'heading_aa';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
		'label'      => $title,
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => $des,
	)));
	return $wp_customize;	
}

function steed_Customize_Control_color($prefix, $section_prefix_id, $title="", $des ="", $wp_customize, $std = ''){
	$uid = $prefix.'color';
	$wp_customize->add_setting($uid, array( 'default' => $std, 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => $title,
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => $des,
	)));
	
	
	return $wp_customize;	
}




function steed_customizer_background($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$std_image = '';
	$std_color = '';
	$std_repeat = '';
	$std_attachment = '';
	$std_position = '';
	$std_size = '';
	
	$std_image = (isset($element_settings['std-image'])) ? $element_settings['std-image'] : '';
	$std_color = (isset($element_settings['std-color'])) ? $element_settings['std-color'] : '';
	$std_repeat = (isset($element_settings['std-repeat'])) ? $element_settings['std-repeat'] : '';
	$std_attachment = (isset($element_settings['std-attachment'])) ? $element_settings['std-attachment'] : '';
	$std_position = (isset($element_settings['std-position'])) ? $element_settings['std-position'] : '';
	$std_size = (isset($element_settings['std-size'])) ? $element_settings['std-size'] : '';
	
	$uid = $prefix.'bg_image';
	$wp_customize->add_setting($uid, array( 'default' => $std_image, 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $uid, array(
		'label'      => __('Background Image', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	
	if(steed_mal()){
	$uid = $prefix.'bg_color';
	$wp_customize->add_setting($uid, array( 'default' => $std_color, 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Background Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	
	$uid = $prefix.'bg_repeat';
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
	
	$uid = $prefix.'bg_attachment';
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
	$uid = $prefix.'bg_position';
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
	$uid = $prefix.'bg_size';
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
function steed_customizer_padding($prefix, $section_prefix_id, $element_settings, $wp_customize){
		
	$std_top = (!empty($element_settings['std_top'])) ? $element_settings['std_top'] : '';
	$std_bottom = (!empty($element_settings['std_bottom'])) ? $element_settings['std_bottom'] : '';

	
	if(steed_mal()){
		$uid = $prefix.'padding_top';
		$wp_customize->add_setting($uid, array( 'default' => $std_top, 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Padding Top', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => '',
		));
		$uid = $prefix.'padding_bottom';
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
function steed_customizer_colorMood($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$filter_std = apply_filters('steed_element_colorMood_'.$prefix, 'dark');
	
	$std = (!empty($element_settings['std'])) ? $element_settings['std'] : $filter_std;

	
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
	
	$defualt = array(
		"std_active" => "yes",
	);
	if(is_array($element_settings)){
		$atr = array_merge($defualt, $element_settings);
	}else{
		$atr = $defualt;
	}
	
	if(steed_mal()){
		$uid = $prefix.'social_active';
		$wp_customize->add_setting($uid, array( 'default' => $atr['std_active'], 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Enable Social Icons', 'steed'),
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
	
	if(steed_mal()){
	$uid = $prefix.'social_icon_color';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Icon Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'social_bg_color';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Icon Background Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'social_border_color';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Icon Border Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'social_icon_color_h';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Icon Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'social_bg_color_h';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Icon Background Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'social_border_color_h';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Icon Border Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	}
	
	return $wp_customize;
}

function steed_element_customize_menuColors($section_prefix_id, $element_settings, $wp_customize){
	if(steed_mal()){
	$prefix = '';
	$uid = $prefix.'menucolor_t_head';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
		'label'      => __('Top Level Memu Colors', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_t_text';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Top Level Text Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_t_bg';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Top Level Background Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_t_border';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Top Level Border Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	
	$uid = $prefix.'menucolor_th_head';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
		'label'      => __('Top Level Memu Hover Colors', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_th_text';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Top Level Text Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_th_bg';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Top Level Background Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_th_border';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Top Level Border Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	
	$uid = $prefix.'menucolor_s_head';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
		'label'      => __('Sub Level Memu Colors', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_s_text';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Sub Level Text Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_s_bg';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Sub Level Background Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_s_border';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Sub Level Border Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	
	
	$uid = $prefix.'menucolor_sh_head';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
		'label'      => __('Sub Level Memu Hover Colors', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_sh_text';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Sub Level Text Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_sh_bg';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Sub Level Background Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	$uid = $prefix.'menucolor_sh_border';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => __('Sub Level Border Hover Color', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => '',
	)));
	}
	
	return $wp_customize;
}
function steed_element_customize_iconText($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$defualt = array(
		"std_active" => "yes",
		"std_icon" => "",
		"std_line1" => "",
		"std_line2" => "",
	);
	if(is_array($element_settings)){
		$atr = array_merge($defualt, $element_settings);
	}else{
		$atr = $defualt;
	}
	
	if(steed_mal()){
		$uid = $prefix.'iconText_active';
		$wp_customize->add_setting($uid, array( 'default' => $atr['std_active'], 'sanitize_callback' => 'sanitize_text_field', ));
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
	
	$uid = $prefix.'iconText_icon';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_icon'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the image icon.',
	));
	$uid = $prefix.'iconText_line1';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_line1'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Line 1', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'iconText_line2';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_line2'], 'sanitize_callback' => 'sanitize_text_field', ));
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
		$uid = 'show_site_credit';
		$wp_customize->add_setting($uid, array( 'default' => 'yes', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Show Footer Credit Text', 'steed'),
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
		$uid = $prefix.'widgets_active';
		$wp_customize->add_setting($uid, array( 'default' => 'yes', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active Widgets', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'select',
			'description' => '',
			'choices' => array(
				'yes' => 'yes',
				'no' => 'no',
				
			),
		));
		
		$uid = $prefix.'widgets_layout';
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
		
		$uid = $prefix.'widgets_layout_tab';
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
		
		$uid = $prefix.'widgets_layout_mobile';
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



function steed_element_customize_html($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	if(steed_mal()){
	$uid = $prefix.'html_active';
	$wp_customize->add_setting($uid, array( 'default' => 'yes', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Active HTML Content', 'steed'),
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
		
	$uid = $prefix.'html_content';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'wp_kses_post', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('HTML Code', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'textarea',
		'description' => '',
	));
	
	return $wp_customize;
}


function steed_element_customize_text($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	if(is_array($element_settings)){
		$atr = array_merge(array(
			"std_active" => "yes",
			"std_content" => "Sample Content is here",
			"std_icon" => "",
		), $element_settings);
	}else{
		$atr = array(
			"std_active" => "yes",
			"std_content" => "Sample Content is here",
			"std_icon" => "",
		);
	}
	
	if(steed_mal()){
	$uid = $prefix.'text_active';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_active'], 'sanitize_callback' => 'sanitize_text_field', ));
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
		
	$uid = $prefix.'text_content';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_content'], 'sanitize_callback' => 'wp_kses_post', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Content', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'textarea',
		'description' => '',
	));
	
	$uid = $prefix.'text_icon';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_icon'], 'sanitize_callback' => 'wp_kses_post', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class or the image URL of the image icon.',
	));
	
	return $wp_customize;
}


function steed_element_customize_button($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$defualt = array(
		"std_active" => "yes",
		"std_link" => "#",
		"std_text" => "Sample Button",
		"std_icon" => "fa-home",
		"std_target" => "_self",
	);
	if(is_array($element_settings)){
		$atr = array_merge($defualt, $element_settings);
	}else{
		$atr = $defualt;
	}
	

	
	if(steed_mal()){
	$uid = $prefix.'button_active';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_active'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Active This Button', 'steed'),
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
		
	$uid = $prefix.'button_text';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_text'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Button Text', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'button_link';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_link'], 'sanitize_callback' => 'esc_attr', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Button Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	
	if(steed_mal()){
	$uid = $prefix.'button_icon';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_icon'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Button Icon', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => 'Font Awesome Icon class',
	));
	
	$uid = $prefix.'button_target';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_target'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Link Target', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'select',
		'description' => '',
		'choices' => array(
			'_self' => '_self',
			'_blank' => '_blank',
		),
	));
	}
	
	return $wp_customize;
}




function steed_element_customize_searchIcon($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$defualt = array(
		"std_active" => "yes",
	);
	if(is_array($element_settings)){
		$atr = array_merge($defualt, $element_settings);
	}else{
		$atr = $defualt;
	}
	
	if(steed_mal()){
		
		$uid = $prefix.'searchIcon_header';
		steed_Customize_Control_heading($uid, $section_prefix_id, 'Enable or Disable Search', NULL, $wp_customize);
		
		$uid = $prefix.'searchIcon_active';
		$wp_customize->add_setting($uid, array( 'default' => $atr['std_active'], 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Show the Search Icon', 'steed'),
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


function steed_element_customize_loginRegister($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$defualt = array(
		"std_active" => "yes",
		"std_login_text" => "Login",
		"std_login_link" => "#",
		"std_register_text" => "Register",
		"std_register_link" => "#",
		"std_logout_text" => "Logout",
		"std_logout_link" => "#",
		"std_account_text" => "Account",
		"std_account_link" => "#",
	);
	if(is_array($element_settings)){
		$atr = array_merge($defualt, $element_settings);
	}else{
		$atr = $defualt;
	}
	
	if(steed_mal()){
		
		$uid = $prefix.'loginRegister_active';
		$wp_customize->add_setting($uid, array( 'default' => $atr['std_active'], 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active Login & Register Links', 'steed'),
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
	
	$uid = $prefix.'loginRegister_login_text';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_login_text'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Login Text', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'loginRegister_login_link';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_login_link'], 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Login Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'loginRegister_register_text';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_register_text'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Register Text', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'loginRegister_register_link';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_register_link'], 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Register Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	
	
	$uid = $prefix.'loginRegister_logout_text';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_logout_text'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Logout Text', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'loginRegister_logout_link';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_logout_link'], 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Logout Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'loginRegister_account_text';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_account_text'], 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Account Text', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	$uid = $prefix.'loginRegister_account_link';
	$wp_customize->add_setting($uid, array( 'default' => $atr['std_account_link'], 'sanitize_callback' => 'esc_url', ));
	$wp_customize->add_control( $uid, array(
		'label'      => __('Account Link', 'steed'),
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'type'       => 'text',
		'description' => '',
	));
	
	return $wp_customize;
}


function steed_element_customize_shoppingBag($prefix, $section_prefix_id, $element_settings, $wp_customize){
	
	$defualt = array(
		"std_active" => "yes",
		"std_tooltip" => "View your shopping cart",
		"std_title" => "Shopping Cart",
	);
	if(is_array($element_settings)){
		$atr = array_merge($defualt, $element_settings);
	}else{
		$atr = $defualt;
	}
	
	if(steed_mal()){
		
		$uid = $prefix.'shoppingBag_header';
		steed_Customize_Control_heading($uid, $section_prefix_id, 'Enable or Disable Woo Shopping Bag', NULL, $wp_customize);
		
		$uid = $prefix.'shoppingBag_active';
		$wp_customize->add_setting($uid, array( 'default' => $atr['std_active'], 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Active Woo Shopping Bag', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'select',
			'description' => '',
			'choices' => array(
				'yes' => 'yes',
				'no' => 'no',
			),
		));
		
		$uid = $prefix.'shoppingBag_title';
		$wp_customize->add_setting($uid, array( 'default' => $atr['std_title'], 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Title', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => '',
		));
		
		$uid = $prefix.'shoppingBag_tooltip';
		$wp_customize->add_setting($uid, array( 'default' => $atr['std_tooltip'], 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Tooltip', 'steed'),
			'section'    => $section_prefix_id,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => '',
		));
	}
	
	return $wp_customize;
}