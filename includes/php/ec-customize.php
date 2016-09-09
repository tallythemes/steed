<?php
$steed_ec_get_tpl = (isset($_GET['steed'])) ? $_GET['steed'] : NULL;

function steed_ec_customizer_menu() {
	add_theme_page( 'Home Page', 'Home Page', 'edit_theme_options', 'customize.php?steed=home' );
}
add_action( 'admin_menu', 'steed_ec_customizer_menu' );

steed_Kirki::add_config( 'steed', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
));
steed_Kirki::add_config( 'steed', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
));


if(!function_exists('steed_ec_template_customize_build')):
	function steed_ec_template_customize_build($tpl){
	
		$data = apply_filters('steed_ec_template_content', array());
		if(isset($data[$tpl])){
			if(is_array($data[$tpl])){
				
				$tpl_data = $data[$tpl];
				$tpl_name = $tpl_data['title'];
					
				foreach($tpl_data['sections'] as $section){
					steed_ec_template_customize_section($tpl, $section, $tpl_name);
					foreach($section['columns'] as $column){
						foreach($column['blocks'] as $block){
							$block_function = $block['fn'].'_customize';
							if(function_exists($block_function)){
								$block_function($tpl, $section, $column, $block);
							}
						}
						steed_ec_template_customize_column($tpl, $section, $column);
					}
				}//END Item foreach
			}//Sub IF
		}//Main IF
			
		return $wp_customize;
	}
endif;

if(!function_exists('steed_ec_template_customize_section')):
	function steed_ec_template_customize_section($tpl, $section, $tpl_name){
		$prefix = $tpl.'_'.$section['id'].'_';
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_settings');
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		
		steed_Kirki::add_panel( esc_attr($customize_panel_id), array(
			'title' => esc_attr($tpl_name . ' ' .$section['title']),
			'description' => '',
			'priority' => 10,
		));		
		steed_Kirki::add_section( $customize_section_id, array(
			'title' => __('Section Settings', 'steed'),
			'priority' => 10,
			'panel' => esc_attr($customize_panel_id),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Active This Section', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'active'),
			'type'       => 'select',
			'default'     => 'yes',
			'choices'    => array(
				'yes' => 'Enable',
				'no' => 'Disable',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Section Title', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'title'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Section Description', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'des'),
			'type'       => 'textarea',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Title Align ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'title_align'),
			'type'       => 'select',
			'choices'    => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center',
				'none' => 'None',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Padding', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'padding'),
			'type'       => 'spacing',
			'default'     => array(
				'top'    => '10px',
				'bottom' => '10px',
				'left'   => '10px',
				'right'  => '10px',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Color', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_color'),
			'type'       => 'color',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Image', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_img'),
			'type'       => 'image',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Repeat', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_repeat'),
			'type'       => 'select',
			'choices'    => array(
				'no-repeat'  => __('No Repeat', 'steed'),
                'repeat'     => __('Tile', 'steed'),
                'repeat-x'   => __('Tile Horizontally', 'steed'),
                'repeat-y'   => __('Tile Vertically', 'steed'),
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Attachment', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_attachment'),
			'type'       => 'select',
			'choices'    => array(
				'scroll'     => __('Scroll', 'steed'),
				'fixed'      => __('Fixed', 'steed'),
                
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Position', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_position'),
			'type'       => 'select',
			'choices'    => array(
				'left'       => __('Left', 'steed'),
                'center'     => __('Center', 'steed'),
                'right'      => __('Right', 'steed'),
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Size', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_size'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Equal Height', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'equal_height'),
			'type'       => 'select',
			'choices'    => array(
				'no' => 'No',
				'yes' => 'Yes',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Section Stretch', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'stretch'),
			'type'       => 'select',
			'choices'    => array(
				'' => 'Default',
				'stretch_row' => 'Stretch row',
				'stretch_row_content' => 'Stretch row and content',
				'stretch_row_content_no_spaces' => 'Stretch row and content (no paddings)',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS Class', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_class'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS ID', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_id'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Max Content Width', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'content_max_width'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Content Width', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'content_width'),
			'type'       => 'text',
		));
		
	}
endif;


if(!function_exists('steed_ec_template_customize_column')):
	function steed_ec_template_customize_column($tpl, $section, $column){
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_';
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_'.$column['id'].'_settings');
		$column_name = esc_attr($column['title']).__(' Column (Settings)', 'steed');
		
		steed_Kirki::add_section( $customize_section_id, array(
			'title' => $column_name,
			'priority' => 10,
			'panel' => esc_attr($customize_panel_id),
		));
		
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Active ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'active'),
			'type'       => 'select',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Padding', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'padding'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Color', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_color'),
			'type'       => 'color',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Image', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_img'),
			'type'       => 'image',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Repeat', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_repeat'),
			'type'       => 'select',
			'choices'    => array(
				'no-repeat'  => __('No Repeat', 'steed'),
                'repeat'     => __('Tile', 'steed'),
                'repeat-x'   => __('Tile Horizontally', 'steed'),
                'repeat-y'   => __('Tile Vertically', 'steed'),
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Attachment', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_attachment'),
			'type'       => 'select',
			'choices'    => array(
				'scroll'     => __('Scroll', 'steed'),
				'fixed'      => __('Fixed', 'steed'),
                
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Position', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_position'),
			'type'       => 'select',
			'choices'    => array(
				'left'       => __('Left', 'steed'),
                'center'     => __('Center', 'steed'),
                'right'      => __('Right', 'steed'),
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Background Size', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'bg_size'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS Class', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_class'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS ID', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_id'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Column Layout ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'col'),
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
	}
endif;


/*
	Slideshow
-----------------------------------*/
if(!function_exists('steed_ec_slideshow_customize')):
	function steed_ec_slideshow_customize($tpl, $section, $column, $block){
		
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_slideshow_';
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_slideshow_');
		
		steed_Kirki::add_section( $customize_section_id, array(
			'title' => esc_attr($block['title'].' (Content)'),
			'priority' => 10,
			'panel' => esc_attr($customize_panel_id),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Active ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'active'),
			'type'       => 'select',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Slide Items', 'steed') . ($key + 1),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'items'),
			'type'       => 'repeater',
			'fields' => array(
				'image' => array(
					'type'        => 'image',
					'label'       => esc_attr__( 'Image', 'steed' ),
					'description' => '',
					'default'     => '',
				),
				'title' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Title', 'steed' ),
					'description' => '',
					'default'     => '',
				),
				'des' => array(
					'type'        => 'textarea',
					'label'       => esc_attr__( 'Description', 'steed' ),
					'description' => '',
					'default'     => '',
				),
				'button_1' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Button #1 Text', 'steed' ),
					'description' => '',
					'default'     => '',
				),
				'link_1' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Button #1 Link', 'steed' ),
					'description' => '',
					'default'     => '',
				),
				'button_2' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Button #2 Text', 'steed' ),
					'description' => '',
					'default'     => '',
				),
				'link_2' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Button #2 Link', 'steed' ),
					'description' => '',
					'default'     => '',
				),
			)
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Image Size', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'image_size'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Max Height', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'height'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS Class', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_class'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS ID', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_id'),
			'type'       => 'text',
		));
	}
endif;


/*
	Text
-----------------------------------*/
if(!function_exists('steed_ec_text_customize')):
	function steed_ec_text_customize($tpl, $section, $column, $block){
		
		$prefix = $tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_text_';
		$customize_panel_id = esc_attr($tpl.'_'.$section['id']);
		$customize_section_id = esc_attr($tpl.'_'.$section['id'].'_'.$column['id'].'_'.$block['id'].'_text_');
		
		steed_Kirki::add_section( $customize_section_id, array(
			'title' => esc_attr($block['title'].' (Content)'),
			'priority' => 10,
			'panel' => esc_attr($customize_panel_id),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Active ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'active'),
			'type'       => 'select',
			'choices'    => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Text Content', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'post'),
			'type'       => 'textarea',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Align ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'align'),
			'type'       => 'select',
			'choices'    => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center',
				'none' => 'None',
			),
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS Class', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_class'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('CSS ID', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'css_id'),
			'type'       => 'text',
		));
		steed_Kirki::add_field( 'steed', array(
			'label'      => __('Color Type ', 'steed'),
			'section'    => $customize_section_id,
			'settings'   => esc_attr($prefix.'color_type'),
			'type'       => 'select',
			'choices'    => array(
				'none' => 'None',
				'dark' => 'Dark',
				'light' => 'Light',
			),
		));
	}
endif;


//if($steed_ec_get_tpl == 'home'){
	steed_ec_template_customize_build('home');
//}