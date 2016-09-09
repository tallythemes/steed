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
			$description = wp_kses_post( $this->description );
			$label = wp_kses_post( $this->label );
			?>
            <div class="tally_Customize_Control_heading" style="padding: 10px 15px; border: 1px solid #080808; background-color: #080808; margin-left: -12px;
    margin-right: -12px; border-left: 0; border-right: 0; margin-bottom: 10px; margin-top: 20px; color: #fff;">
              	<?php
					if($label){ echo '<h4 style="margin-bottom: 0; margin-top: 0; font-size: 16px; font-weight: bold;">'.$label.'</h4>'; }
					if($description){ echo '<p style="margin-bottom: 0; margin-top: 2px;">'.$description.'</p>'; }
				?>
            </div>
            <?php
		}
	}
endif;