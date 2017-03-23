<?php
if(!class_exists('steed_footer__widgets_copybar')):
class steed_footer__widgets_copybar{
	
	public $widgets_color_mood;
	public $copybar_color_mood;
	
	function __construct(){
	}
	
	function init(){

		add_action( 'after_setup_theme', array($this, 'after_setup_theme') );
		add_action( 'after_setup_theme', array($this, 'after_setup_theme2'), 20 );
	}
	
	function after_setup_theme(){
		remove_action('steed_footer', 'steed_part_footer_content', 10);
		remove_action('steed_custom_css', 'steed_part_footer_CSS');
		remove_action( 'customize_register', 'steed_part_footer_customize' );
		remove_action( 'widgets_init', 'steed_part_footer_widgets_init' );
		
		add_action('steed_footer', array($this, 'html'), 10);
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'customize_register', array($this, 'customize') );
		add_action( 'widgets_init', array($this, 'widgets') );
		
		add_action( 'wp_enqueue_scripts', array($this, 'scripts') );
		
		if($this->widgets_color_mood == 'light'){
			add_filter('steed_element_colorMood_footer_widgets_', 'steed_return_light_color_name');
		}else{
			add_filter('steed_element_colorMood_footer_widgets_', 'steed_return_dark_color_name');
		}
		if($this->copybar_color_mood == 'light'){
			add_filter('steed_element_colorMood_footer_bar_', 'steed_return_light_color_name');
		}else{
			add_filter('steed_element_colorMood_footer_bar_', 'steed_return_dark_color_name');
		}
		
	}
	
	function after_setup_theme2(){
		
	}
	
	
	
	
	/*
	HTML
	----------------------------------------*/
	function html(){
		?>
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-footer-in">
                <?php steed_element_footerWidgets('footer_widgets_', array('class' => 'footer-widgets '.steed_element_colorMood('footer_widgets_'), 'in_class' => 'footer-widgets-in container-width')); ?>
                <div class="footer-bar <?php echo steed_element_colorMood('footer_bar_'); ?>">
                    <div class="site-info container-width">
                        <?php steed_element_copyText('footer_bar_'); ?>
                        <?php steed_element_creditText('footer_bar_'); ?>
                    </div><!-- .site-info -->
                </div>
            </div>
        </footer><!-- #colophon -->
        <?php	
	}
	
	
	/*
	Custom CSS
	----------------------------------------*/
	function css( $css ) {
		$the_css = '';
		$the_css .= steed_CSS_padding('footer_widgets_', '.footer-widgets');
		$the_css .= steed_CSS_background('footer_widgets_', '.footer-widgets');
		$the_css .= steed_CSS_padding('footer_bar_', '.footer-bar');
		$the_css .= steed_CSS_background('footer_bar_', '.footer-bar');
		return $css.$the_css;	
	}
	
	
	/*
	Customizer
	----------------------------------------*/
	function customize( $wp_customize ) {
		$wp_customize->add_panel( 'site_Footer', array(
			'title'			=> __('Site Footer', 'steed'),
			'description'	=> '',
			'priority'		=> 160,
		));
		
		/*~~Footer Widgets area~~~*/
		$wp_customize->add_section( 'steed_footer_widgets' , array(
			'title'      => __( 'Footer Widgets', 'steed' ),
			'priority'   => 30,
			'panel'		=> 'site_Footer',
		));
		if(steed_mal()){
		/**/steed_Customize_Control_heading('footer_widgets_1_', 'steed_footer_widgets', 'Widgets Layout', NULL, $wp_customize);
		steed_element_customize_footerWidgets('footer_widgets_', 'steed_footer_widgets', NULL, $wp_customize);
		/**/steed_Customize_Control_heading('footer_widgets_2_', 'steed_footer_widgets', 'Paddings & Color Mood', NULL, $wp_customize);
		steed_customizer_padding('footer_widgets_', 'steed_footer_widgets', NULL, $wp_customize);
		steed_customizer_colorMood('footer_widgets_', 'steed_footer_widgets', NULL, $wp_customize);
		}
		/**/steed_Customize_Control_heading('footer_widgets_3_', 'steed_footer_widgets', 'Background', NULL, $wp_customize);
		steed_customizer_background('footer_widgets_', 'steed_footer_widgets', NULL, $wp_customize);
		
		/*~~Footer Bar area~~~*/
		$wp_customize->add_section( 'steed_footer_bar' , array(
			'title'      => __( 'Footer Bar', 'steed' ),
			'priority'   => 30,
			'panel'		=> 'site_Footer',
		));
		/**/steed_Customize_Control_heading('footer_bar_1_', 'steed_footer_bar', 'Content', NULL, $wp_customize);
		steed_element_customize_creditText('footer_bar_', 'steed_footer_bar', NULL, $wp_customize);
		steed_element_customize_copyText('footer_bar_', 'steed_footer_bar', NULL, $wp_customize);
		if(steed_mal()){
		/**/steed_Customize_Control_heading('footer_bar_2_', 'steed_footer_bar', 'Paddings & Color Mood', NULL, $wp_customize);
		steed_customizer_padding('footer_bar_', 'steed_footer_bar', NULL, $wp_customize);
		steed_customizer_colorMood('footer_bar_', 'steed_footer_bar', NULL, $wp_customize);
		}
		/**/steed_Customize_Control_heading('footer_bar_3_', 'steed_footer_bar', 'Background', NULL, $wp_customize);
		steed_customizer_background('footer_bar_', 'steed_footer_bar', NULL, $wp_customize);
	}
	
	
	function scripts(){
		wp_enqueue_style( 'steed-footer', get_template_directory_uri() . '/includes/content/footers/widgets_copybar/footer.css', array(), '1.0');
	}
	
	function widgets() {
		steed_element_footerWidgets_register('footer_widgets_', array());
	}
}
endif;