<?php
if(!class_exists('steed_header__topbar_logo_left_menu_right')):
class steed_header__topbar_logo_left_menu_right{
	
	public $topbar_color_mood = 'light';
	public $header_color_mood = 'dark';
	
	public $enable_topbar = true;
	
	function __construct(){
		
	}
	
	function init(){
		add_action( 'after_setup_theme', array($this, 'after_setup_theme') );
		add_action( 'after_setup_theme', array($this, 'after_setup_theme2'), 20 );
	}
	
	function after_setup_theme(){
		remove_action('steed_header', 'steed_part_header_content', 10);
		remove_filter('steed_custom_css', 'steed_part_header_CSS');
		remove_action( 'customize_register', 'steed_part_header_customize' );
		remove_action('steed_header', 'steed_part_header_responsive_nav', 20);
		
		add_action('steed_header', array($this, 'html'), 10);
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'customize_register', array($this, 'customize') );
		
		add_action( 'wp_enqueue_scripts', array($this, 'scripts') );
		add_filter('body_class', array($this, 'body_class'));

		
		
		if($this->topbar_color_mood == 'light'){
			add_filter('steed_element_colorMood_topbar_', 'steed_return_light_color_name');
		}else{
			add_filter('steed_element_colorMood_topbar_', 'steed_return_dark_color_name');
		}
		if($this->header_color_mood == 'light'){
			add_filter('steed_element_colorMood_header_', 'steed_return_light_color_name');
		}else{
			add_filter('steed_element_colorMood_header_', 'steed_return_dark_color_name');
		}
	}
	
	function after_setup_theme2(){
		
	}
	
	
	
	
	/*
	HTML
	----------------------------------------*/
	function html(){
		?>
        <div class="header-warp">
			<?php if((get_theme_mod('topbar_active', 'yes') == 'yes') && ($this->enable_topbar == true)): ?>
            <div class="topbar <?php echo steed_element_colorMood('topbar_'); ?>">
                <div class="topbar-in">
                    <div class="container-width">
                        <div class="row">
                            <div class="col-lg-5 text_lg_left text_xs_center">
                                <?php steed_element_socialIcons('header_', array('class' => 'float_lg_left')); ?>
                                <?php 
                                    $hsettings = array('class' => 'header_address float_lg_left', 'std_content' => 'Walmart, 7th Street, Joplin, MO 64801');
                                    steed_element_text('header_address_', $hsettings); 
                                ?>
                            </div>
                            <div class="col-lg-7 text_lg_left text_xs_center">
                                <?php 
                                    $hsettings = array('class' => 'header_phone float_lg_right', 'std_content' => '+1 2223 4567', 'std_icon' => 'fa-phone');
                                    steed_element_text('header_phone_', $hsettings); 
                                ?>
                                <?php 
                                    $hsettings = array('class'=>'header_email float_lg_right', 'std_content'=>'contact@domain.com', 'std_icon' => 'fa-envelope');
                                    steed_element_text('header_email_', $hsettings); 
                                ?>
                                <?php
                                    $hsettings = array(
                                        'class' => 'header_time float_lg_right', 
                                        'std_content' => 'Monday - Sunday 10:00 - 22:00', 
                                        'std_icon' => 'fa-clock-o'
                                    );
                                    steed_element_text('header_time_', $hsettings); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php endif; ?>
            <div class="fixed_header_holder"></div>
            <header id="masthead" class="site-header <?php echo steed_element_colorMood('header_'); ?>" role="banner">
                <div class="site-header-in">
                    <div class="container-width">
                        <div class="row">
                            <div class="site-branding col-md-3 ">
                                <?php steed_element_logo(); ?>
                                <a href="#primary-menu" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>
                                <a href="#" class="topbar_open_hand">
                                    <span class="screen-reader-text"><?php _e('Open Topbar', 'steed'); ?></span>
                                </a>
                            </div><!-- .site-branding -->
                            <div class="header-widgets col-md-9 text_md_right">
                                <?php steed_element_button('header_', array('std_text' => 'Free First Advice', 'std_icon' => 'fa-paper-plane-o')); ?>
                                <?php steed_element_shoppingBag('header_'); ?>
                                <?php steed_element_searchIcon('header_'); ?>
                             
                                <nav id="site-navigation" class="main-navigation" role="navigation">
                                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                                </nav>                        
                                
                            </div>
                        </div>
                    </div>
                </div>
            </header><!-- #masthead -->
            
            <script type="text/javascript">
				<?php if((get_theme_mod('topbar_active', 'yes') == 'yes') && ($this->enable_topbar == true)): ?>
                jQuery(document).ready(function($) {
                    "use strict";
                    
                    var topbar = $('.topbar');
                    var topbar_hand = $('.topbar_open_hand');
                    
                    topbar_hand.click(function() {
                        
                        if(topbar.hasClass('active')){
                            topbar.slideUp();
                            topbar.removeClass('active');
                            topbar_hand.removeClass('active');
                        }else{
                            topbar.slideDown();
                            topbar.addClass('active');
                            topbar_hand.addClass('active');
                        }
                        
                        if(!topbar_hand.hasClass('used')){
                            topbar_hand.addClass('used');
                        }
                        return false;
                    });
                });
				<?php endif; ?>
				
				<?php if((get_theme_mod('header_scroll_fixed') == 'yes')): ?>
					jQuery(document).ready(function($) {
						$( '#masthead' ).clone().appendTo( '.fixed_header_holder' );
					});
						
					jQuery(window).scroll(function() {
						var scroll = jQuery(window).scrollTop();
						
						if (scroll >= <?php echo get_theme_mod('header_scroll_fixed_start_point', '200'); ?>) {
							jQuery(".header-warp").addClass("pre-fixed");
							
							setTimeout(function() { 
								jQuery('.header-warp').addClass('fixed');
								
							}, 100);
							
						} else {
							jQuery('.header-warp').removeClass('pre-fixed');
							jQuery(".header-warp").removeClass("fixed");
						}
					});
				<?php endif; ?>
            </script>
           
        </div>
        <div class="responsive-menu" >
        	<div class="responsive-menu-head">
                <a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a>
                
                <?php steed_element_button('header_', array('std_text' => 'Free First Advice', 'std_icon' => 'fa-paper-plane-o')); ?>
                <?php steed_element_shoppingBag('header_'); ?>
                <?php steed_element_searchIcon('header_'); ?>
            </div>
        </div>
        <?php
	}
	
	
	/*
	Custom CSS
	----------------------------------------*/
	function css( $css ) {
		$colors = steed_colors();
	
		$primary_color = $colors['primary'];
		$accent_color = $colors['accent'];
		$dark_color = $colors['dark'];
		$light_color = $colors['light'];
		
		$the_css = '';
		if((get_theme_mod('topbar_active', 'yes') == 'yes') && ($this->enable_topbar == true)){
			$the_css .= steed_CSS_padding('topbar_', 'html .topbar');
			$the_css .= steed_CSS_background('topbar_', 'html .topbar');
			
			$topbar_bg_rgba = steed_hex2rgb(get_theme_mod('topbar_bg_color'));
			if(is_array($topbar_bg_rgba)){
				$the_css .= 'html .topbar_open_hand{ background-color:rgba('.$topbar_bg_rgba[0].','.$topbar_bg_rgba[1].','.$topbar_bg_rgba[2].',0.1);}';
			}
			
			$the_css .= '.topbar.color-light .elementText i.fa { color:'.$light_color.'; }';
			$the_css .= '.topbar.color-dark .elementText i.fa { color:'.$dark_color.'; }';
		}
		
		$the_css .= steed_CSS_padding('header_', 'html .site-header');
		$the_css .= steed_CSS_background('header_', 'html .site-header');
		$the_css .= steed_element_CSS_socialIcons('header_', 'html .topbar ');
		
		$the_css .= '.tpb_blogGrid_button:hover{ background-color: '.$primary_color.';}';
		
		$the_css .= steed_element_CSS_button('header_', '.site-header .element_button');
		$the_css .= steed_element_CSS_button('header_', '.responsive-menu-head .element_button');
		
		if((get_theme_mod('header_bg_opacity') != '1') || get_theme_mod('header_bg_opacity') != ''){
			$header_rgba = steed_hex2rgb(get_theme_mod('header_bg_color'));
			if(is_array($header_rgba)){
				$the_css .= 'html .site-header{ background-color:rgba('.$header_rgba[0].','.$header_rgba[1].','.$header_rgba[2].','.get_theme_mod('header_bg_opacity', '1').');}';
				$the_css .= 'html .site-header.fixed{ background-color:rgba('.$header_rgba[0].','.$header_rgba[1].','.$header_rgba[2].',0.9);}';
			}
		}
		
		$the_css .= 'html .header-fixed-on-scroll .fixed .fixed_header_holder{ background-color:'.get_theme_mod('header_scroll_fixed_bg', '#000').'; }';
		
		
		return  $css.$the_css;		
	}
	
	
	/*
	Customizer
	----------------------------------------*/
	function customize( $wp_customize ) {
		$wp_customize->add_panel( 'site_header', array(
			'title'			=> __('Site Header', 'steed'),
			'description'	=> '',
			'priority'		=> 160,
		));
		
		
		/*---Header Elements---*/
		$wp_customize->add_section( 'steed_header_elements' , array(
			'title'		=> __( 'Header Elements', 'steed' ),
			'priority'	=> 30,
			'panel'		=> 'site_header',
		));
		
		steed_element_customize_searchIcon('header_', 'steed_header_elements', NULL, $wp_customize);
		
		$uid = 'steed_header_elements_button_header';
		steed_Customize_Control_heading($uid, 'steed_header_elements', 'Button', NULL, $wp_customize);
		$settings = array('std_active' => 'yes', 'std_text' => 'Free First Advice', 'std_icon' => 'fa-paper-plane-o');
		steed_element_customize_button('header_', 'steed_header_elements', $settings, $wp_customize);
		
		steed_element_customize_shoppingBag('header_', 'steed_header_elements', NULL, $wp_customize);
		
		if($this->enable_topbar == true){
			$uid = 'steed_header__elements_header_address';
			steed_Customize_Control_heading($uid, 'steed_header_elements', 'Address', NULL, $wp_customize);
			$settings = array('std_content' => 'Walmart, 7th Street, Joplin, MO 64801');
			steed_element_customize_text('header_address_', 'steed_header_elements', $settings, $wp_customize);
			
			$uid = 'steed_header__elements_header_phone';
			steed_Customize_Control_heading($uid, 'steed_header_elements', 'Phone', NULL, $wp_customize);
			$settings = array('std_content' => '+1 2223 4567', 'std_icon' => 'fa-phone');
			steed_element_customize_text('header_phone_', 'steed_header_elements', $settings, $wp_customize);
			
			$uid = 'steed_header__elements_header_email';
			steed_Customize_Control_heading($uid, 'steed_header_elements', 'Email', NULL, $wp_customize);
			$settings = array('std_content' => 'contact@domain.com', 'std_icon' => 'fa-envelope');
			steed_element_customize_text('header_email_', 'steed_header_elements', $settings, $wp_customize);
			
			$uid = 'steed_header__elements_header_time';
			steed_Customize_Control_heading($uid, 'steed_header_elements', 'Open Time', NULL, $wp_customize);
			$settings = array('std_content' => ' Monday - Sunday 10:00 - 22:00', 'std_icon' => 'fa-clock-o' );
			steed_element_customize_text('header_time_', 'steed_header_elements', $settings, $wp_customize);
		}
		
		
		if($this->enable_topbar == true){
			/*---Social Icons---*/
			$wp_customize->add_section( 'steed_header_social_icons' , array(
				'title'		=> __( 'Social Icons', 'steed' ),
				'priority'	=> 30,
				'panel'		=> 'site_header',
			));
			steed_element_customize_socialIcons('header_', 'steed_header_social_icons', NULL, $wp_customize);
		}
		
		
		if(steed_mal()){
	
			/*---Header Style---*/
			$wp_customize->add_section( 'steed_header_style' , array(
				'title'		=> __( 'Header Area Style', 'steed' ),
				'priority'	=> 30,
				'panel'		=> 'site_header',
			));
			
			steed_customizer_padding('header_', 'steed_header_style', NULL, $wp_customize);
			steed_customizer_colorMood('header_', 'steed_header_style', NULL, $wp_customize);
			/**/steed_Customize_Control_heading('steed_header_style_bg_head', 'steed_header_style', 'Background', NULL, $wp_customize);
			steed_customizer_background('header_', 'steed_header_style', NULL, $wp_customize);
			
			$uid = 'header_bg_opacity';
			$wp_customize->add_setting($uid, array( 'default' => '1', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Background Opacity', 'steed'),
				'section'    => 'steed_header_style',
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'choices' => array(
					'' => 'none',
					'1' => '1',
					'0.9' => '0.9',
					'0.8' => '0.8',
					'0.7' => '0.7',
					'0.6' => '0.6',
					'0.5' => '0.5',
					'0.4' => '0.4',
					'0.3' => '0.3',
					'0.2' => '0.2',
					'0.1' => '0.1',
					'0' => '0',
				),
			));
			
			$uid = 'header_scroll_fixed';
			$wp_customize->add_setting($uid, array( 'default' => 'no', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Make the header fixed on scroll', 'steed'),
				'section'    => 'steed_header_style',
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'choices' => array(
					'no' => 'no',
					'yes' => 'yes',
				),
			));
			
			$uid = 'header_scroll_fixed_bg';
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color', ));
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $uid, array(
				'label'      =>  __('Fixed header Background Color', 'steed'),
				'section'    => 'steed_header_style',
				'settings'   => $uid,
				'description' => '',
			)));
			
			
			$uid = 'header_scroll_fixed_start_point';
			$wp_customize->add_setting($uid, array( 'default' => '200', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Fixed header start point', 'steed'),
				'section'    => 'steed_header_style',
				'settings'   => $uid,
				'type'       => 'text',
				'description' => '',
			));
			
			/*---Topbar Style---*/
			if($this->enable_topbar == true){
				
				$wp_customize->add_section( 'steed_topbar_style' , array(
					'title'		=> __( 'Topbar Style & BG', 'steed' ),
					'priority'	=> 30,
					'panel'		=> 'site_header',
				));
				
				$uid = 'topbar_active';
				$wp_customize->add_setting($uid, array( 'default' => 'yes', 'sanitize_callback' => 'sanitize_text_field', ));
				$wp_customize->add_control( $uid, array(
					'label'      => __('Display Topbar', 'steed'),
					'section'    => 'steed_topbar_style',
					'settings'   => $uid,
					'type'       => 'select',
					'description' => '',
					'choices' => array(
						'yes' => 'yes',
						'no' => 'no',
					),
				));
				
				steed_customizer_padding('topbar_', 'steed_topbar_style', NULL, $wp_customize);
				steed_customizer_colorMood('topbar_', 'steed_topbar_style', NULL, $wp_customize);
				/**/steed_Customize_Control_heading('steed_topbar_style_bg_head', 'steed_topbar_style', 'Background', NULL, $wp_customize);
				steed_customizer_background('topbar_', 'steed_topbar_style', NULL, $wp_customize);
			}
		}
	}
	
	
	function scripts(){
		wp_enqueue_style( 'steed-header', get_template_directory_uri() . '/includes/content/headers/topbar_logo_left_menu_right/header.css', array('steed-style'), '1.0');
	}
	
	function body_class($classes) {
		if((get_theme_mod('header_bg_opacity') == '1') || get_theme_mod('header_bg_opacity') == ''){
			
		}else{
			$classes[] = 'header-has-opacity';	
		}
		if((get_theme_mod('header_scroll_fixed') == 'yes')){
			$classes[] = 'header-fixed-on-scroll';
		}
        return $classes;
	}
}
endif;