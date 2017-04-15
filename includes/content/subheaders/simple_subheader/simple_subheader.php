<?php
if(!class_exists('steed_subheader__simple_subheader')):
class steed_subheader__simple_subheader{
	
	public $color_mood = 'light';
	
	function __construct(){
		
	}
	
	function init(){
		add_action( 'after_setup_theme', array($this, 'after_setup_theme') );
		add_action( 'after_setup_theme', array($this, 'after_setup_theme2'), 20 );
	}
	
	function after_setup_theme(){
		remove_action('steed_after_header', 'steed_part_subheader_content', 10);
		remove_action('steed_custom_css', 'steed_part_subheader_CSS');
		remove_action( 'customize_register', 'steed_part_subheader_customize' );
		
		add_action('steed_after_header', array($this, 'html'), 10);
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'customize_register', array($this, 'customize') );
		
		add_action( 'wp_enqueue_scripts', array($this, 'scripts') );
		
		
		
		if($this->color_mood == 'light'){
			add_filter('steed_element_colorMood_subheader_', 'steed_return_light_color_name');
		}else{
			add_filter('steed_element_colorMood_subheader_', 'steed_return_dark_color_name');
		}
	}
	
	function after_setup_theme2(){
		
	}
	
	
	
	
	/*
	HTML
	----------------------------------------*/
	static function html(){
		if(
		(is_page() && is_page_template( 'template-full-width.php' )) || 
		(is_page() && is_page_template( 'template-page-bulder.php' )) ||
		is_home()
		):
			/**/
		else:
		?>
		<div class="site-subheader <?php echo steed_element_colorMood('subheader_'); ?>">
			<div class="site-subheader-in container-width">
				<?php steed_element_pageHeading(); ?>
			</div>
		</div>
		<?php
		endif;
	}
	
	
	/*
	Custom CSS
	----------------------------------------*/
	function css( $css ) {
		$the_css = '';
		$the_css .= steed_CSS_padding('subheader_', 'html .site-subheader');
		$the_css .= steed_CSS_background('subheader_', 'html .site-subheader');
		
		return $css.$the_css;		
	}
	
	
	/*
	Customizer
	----------------------------------------*/
	function customize( $wp_customize ) {
		if(steed_mal()){
			$wp_customize->add_section( 'site_subheader' , array(
				'title'		=> __( 'Page / Post Title area', 'steed' ),
				'priority'	=> 160,
				//'panel'		=> '',
			));
	
			steed_customizer_padding('subheader_', 'site_subheader', NULL, $wp_customize);
			steed_customizer_colorMood('subheader_', 'site_subheader', NULL, $wp_customize);
			/**/steed_Customize_Control_heading('subheader_1_', 'site_subheader', 'Background', NULL, $wp_customize);
			steed_customizer_background('subheader_', 'site_subheader', NULL, $wp_customize);
		}
	}
	
	
	function scripts(){
		wp_enqueue_style( 'steed-subheader', get_template_directory_uri() . '/includes/content/subheaders/simple_subheader/subheader.css', array(), '1.0');
	}
	
	function wp_footer(){
		?>
        <script type="text/javascript">
			jQuery(document).ready(function($) {
				"use strict";
				
			});
		</script>
        <?php	
	}
}
endif;