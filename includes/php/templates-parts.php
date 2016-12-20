<?php
/*=======================================================
	All header hooks are here.
========================================================*/

/*
	HTML
----------------------------------------*/
add_action('steed_header', 'steed_part_header_content', 10);
function steed_part_header_content(){
	?>
    <header id="masthead" class="site-header" role="banner">
        <div class="site-header-in">
            <div class="braning-and-widgets <?php echo steed_element_colorMood('header_'); ?>">
            	<div class="container-width">
                    <div class="row">
                        <div class="site-branding col-sm-4 text_xs_center">
                            <?php steed_element_logo(); ?>
                        </div><!-- .site-branding -->
                        <div class="header-widgets col-sm-8 text_sm_right">
                            <?php steed_element_html('header_'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mavigation-holder">
                <div class="mavigation-holder-in container-width">
                	<div class="row">
                        <nav id="site-navigation" class="main-navigation col-sm-8" role="navigation">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                        </nav><!-- #site-navigation -->
                        <div class="social-widgets col-sm-4 text_sm_right float_xs_right">
                            <?php steed_element_socialIcons('header_'); ?>
                        </div>
                    </div>
                   	<a href="#primary-menu" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>
                </div>
            </div>
        </div>
	</header><!-- #masthead -->
    <?php
}

add_action('steed_header', 'steed_part_header_responsive_nav', 20);
function steed_part_header_responsive_nav(){
	steed_element_ResponsiveMenu(array('menu_id' => '#primary-menu'));
}


/*
	Custom CSS
----------------------------------------*/
add_filter('steed_custom_css', 'steed_part_header_CSS');
function steed_part_header_CSS( $css ) {
	$the_css = '';
	$the_css .= steed_CSS_padding('header_', '.braning-and-widgets');
	$the_css .= steed_CSS_background('header_', '.braning-and-widgets');
	$the_css .= steed_CSS_background('menuarea_', '.mavigation-holder');
	$the_css .= steed_element_CSS_socialIcons('header_', '.social-widgets');
	
	return  $css.$the_css;
}


/*
	Customizer
----------------------------------------*/
function steed_part_header_customize( $wp_customize ) {
	$wp_customize->add_panel( 'site_header', array(
		'title'			=> __('Site Header', 'steed'),
		'description'	=> '',
		'priority'		=> 160,
	));
	
	
	/*---Social Icons---*/
	$wp_customize->add_section( 'steed_header_social_icons' , array(
		'title'		=> __( 'Social Icons', 'steed' ),
		'priority'	=> 30,
		'panel'		=> 'site_header',
	));
	steed_element_customize_socialIcons('header_', 'steed_header_social_icons', NULL, $wp_customize);
	
	
	/*---Header Right Content---*/
	$wp_customize->add_section( 'steed_header_content' , array(
		'title'		=> __( 'Header Right Content', 'steed' ),
		'priority'	=> 30,
		'panel'		=> 'site_header',
	));
	steed_element_customize_html('header_', 'steed_header_content', NULL, $wp_customize);
	
	
	if(steed_mal()){
		
		/*---Menu Style---*/
		$wp_customize->add_section( 'steed_header_menu_colors' , array(
			'title'		=> __( 'Menu Colors', 'steed' ),
			'priority'	=> 30,
			'panel'		=> 'site_header',
		));
		/**/steed_Customize_Control_heading('steed_header_menu_bg_head', 'steed_header_menu_colors', 'Menu Area Background', NULL, $wp_customize);
		steed_customizer_background('menuarea_', 'steed_header_menu_colors', NULL, $wp_customize);
		
		
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
	}
}
add_action( 'customize_register', 'steed_part_header_customize' );


/*
	Functions
----------------------------------------*/


/*=======================================================
	All Sub-Header hooks are here.
========================================================*/
/*
	HTML
----------------------------------------*/
add_action('steed_after_header', 'steed_part_subheader_content', 10);
function steed_part_subheader_content(){
	if(is_single() || is_archive() || (is_page() && !is_page_template( 'template-full-width.php' )) || is_search()):
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
add_filter('steed_custom_css', 'steed_part_subheader_CSS');
function steed_part_subheader_CSS( $css ) {
	$the_css = '';
	$the_css .= steed_CSS_padding('subheader_', '.site-subheader .site-subheader-in');
	$the_css .= steed_CSS_background('subheader_', '.site-subheader');
	
	return $css.$the_css;
}


/*
	Customizer
----------------------------------------*/
function steed_part_subheader_customize( $wp_customize ) {
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
add_action( 'customize_register', 'steed_part_subheader_customize' );


/*
	Functions
----------------------------------------*/



/*=======================================================
	All Footer hooks are here.
========================================================*/

/*
	HTML
----------------------------------------*/
add_action('steed_footer', 'steed_part_footer_content', 10);
function steed_part_footer_content(){
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
add_filter('steed_custom_css', 'steed_part_footer_CSS');
function steed_part_footer_CSS( $css ) {
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
function steed_part_footer_customize( $wp_customize ) {
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
add_action( 'customize_register', 'steed_part_footer_customize' );


/*
	Functions
----------------------------------------*/
function steed_part_footer_widgets_init() {
	steed_element_footerWidgets_register('footer_widgets_', array());
}
add_action( 'widgets_init', 'steed_part_footer_widgets_init' );