<?php
function medicals_setup(){
	add_filter('steed_site_part_render__site_header', 'medicals_site_part_render_site_header_array');
	add_filter('steed_site_part_render__after_site_header', 'medicals_ResponsiveMenu_render_site_header_array');
	add_filter('steed_site_part_render__site_subheader', 'medicals_site_part_render_site_subheader_array');
	add_filter('steed_site_part_render__site_footer', 'medicals_site_part_render_site_footer_array');
	
	add_filter('steed_mal_ready', '__return_true');
}
add_action( 'after_setup_theme', 'medicals_setup' );


function medicals_fonts(){
	$fonts = array();
	
	/* #0 Heading Font */
	$fonts[] = 'Montserrat:400,700';
	
	/* #1 Menu Font */
	$fonts[] = 'Montserrat:400,700';
	
	/* #2 Body Font */
	$fonts[] = 'Source+Serif+Pro:400,600,700';
	
	return $fonts;
}
add_filter('steed_fonts', 'medicals_fonts');


function medicals_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Home Page', 'medicals' ),
		'id'            => 'home_page',
		'description'   => esc_html__( 'Home Page Contents', 'medicals' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'medicals_widgets_init' );




function medicals_site_part_render_site_header_array(){
	
	$sections = array();
	
	/* Branding */
	$items = array();
	
	$items[] = array(
		'before' => '<div class="site-logo col-md-3 text_md_left">',
		'after' => '</div>',
		'style_title' => 'n\a',
		'style_padding' => 'n/a',
		'style_bg' => 'n\a',
		'style_colorMood' => 'n\a',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Logo',
				'fn' => 'logo',
				'prefix' => 'logo_',
				'settings' => '',
				'before' => '',
				'after' => '',
				'show_hide_std' => 'yes',
			),
			array(
				'title' => 'Menu Hand',
				'fn' => 'menuHand',
				'prefix' => 'menuHand_',
				'settings' => array('menu_id' => 'primary_menu'),
				'before' => '',
				'after' => '',
				'show_hide_std' => 'yes',
			),
		),
	);
	
	$items[] = array(
		'before' => '<div class="header-icon-text col-md-9"><div class="row">',
		'after' => '</div></div>',
		'title' => 'n/a',
		'style_padding' => 'n/a',
		'style_bg' => 'n/a',
		'style_colorMood' => 'n/a',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Address',
				'fn' => 'iconText',
				'prefix' => 'address_',
				'settings' => '',
				'before' => '<div class="col-md-4 text_lg_right text_xs_center">',
				'after' => '</div>',
				'show_hide_std' => 'yes', //n/a, yes, no
			),
			array(
				'title' => 'Contact',
				'fn' => 'iconText',
				'prefix' => 'email_',
				'settings' => '',
				'before' => '<div class="col-md-4 text_lg_right text_xs_center">',
				'after' => '</div>',
				'show_hide_std' => 'yes',
			),
			
			array(
				'title' => 'Open Time',
				'fn' => 'iconText',
				'prefix' => 'phone_',
				'settings' => '',
				'before' => '<div class="col-md-4 text_lg_right text_xs_center">',
				'after' => '</div>',
				'show_hide_std' => 'yes',
			),
			
			
		),
	);
	
	$sections[] = array(
		'before' => '<div class="branding %colorMood%" style="%bg%"><div class="branding-in container-width"><div class="row">',
		'after' => '</div></div></div>',
		'style_title' => 'Header Style & Background',
		'style_padding' => 'n/a',
		'style_bg' => array('color' => '#fff'),
		'style_colorMood' => 'dark',
		'items' => $items,
	);
	
	
	
	/* sitenav */
	$items = array();
	
	$items[] = array(
		'before' => '<div class="main-menu main-navigation">',
		'after' => '</div>',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Menu',
				'fn' => 'menu',
				'prefix' => 'menu_',
				'settings' => array('theme_location' => 'primary', 'menu_id' => 'primary_menu'),
				'before' => '',
				'after' => '',
				'show_hide_std' => 'yes',
			),
		),
	);
	$items[] = array(
		'before' => '<div class="header-social-icons text_md_right text_xs_center float_md_right">',
		'after' => '</div>',
		'title' => 'n/a',
		'style_padding' => 'n/a',
		'style_bg' => 'n/a',
		'style_colorMood' => 'n/a',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Social Icons',
				'fn' => 'socialIcons',
				'prefix' => 'social_icons_',
				'settings' => '',
				'before' => '',
				'after' => '',
				'show_hide_std' => 'yes',
			),
		),
	);
	$sections[] = array(
		'before' => '<div class="sitenav %colorMood%" style="%bg%"><div class="sitenav-in container-width">',
		'after' => '</div></div>',
		'style_title' => 'Navigation Style & Background',
		'style_padding' => 'n/a',
		'style_bg' => array('color' => '#fff'),
		'style_colorMood' => 'dark',
		'items' => $items,
	);
	
	return array(
		'prefix' => 'siteheader_',
		'title' => 'Site Header',
		'before' => '<div class="site-header" id="masthead"><div class="site-header-in">',
		'after' => '</div></div>',
		'section' => $sections,
	);
}


function medicals_ResponsiveMenu_render_site_header_array(){
	
	$sections = array();
	$items = array();
	
	$items[] = array(
		'before' => '',
		'after' => '',
		'title' => 'n/a',
		'style_padding' => 'n/a',
		'style_bg' => 'n/a',
		'style_colorMood' => 'n/a',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Responsive Menu',
				'fn' => 'ResponsiveMenu',
				'prefix' => 'ResponsiveMenu_',
				'settings' => '',
				'before' => '',
				'after' => '',
			),
		),
	);
	$sections[] = array(
		'before' => '',
		'after' => '',
		'items' => $items,
	);
	
	return array(
		'prefix' => 'responsivemenuhand_',
		'title' => 'Responsive Menu Hand',
		'before' => '',
		'after' => '',
		'section' => $sections,
	);
}


function medicals_site_part_render_site_subheader_array(){
	
	$sections = array();
	
	/* Branding */
	$items = array();
	
	$items[] = array(
		'before' => '',
		'after' => '',
		'style_title' => 'n/a',
		'style_padding' => 'n/a',
		'style_bg' => 'n/a',
		'style_colorMood' => 'n/a',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Page Heading',
				'fn' => 'pageHeading',
				'prefix' => 'pageHeading_',
				'settings' => '',
				'before' => '',
				'after' => '',
				'show_hide_std' => 'n/a',
			),
		),
	);
	
	
	$sections[] = array(
		'before' => '<div class="site-subheader %colorMood%" style="%bg% %padding%"><div class="site-subheader-in container-width">',
		'after' => '</div></div>',
		'style_title' => 'Subheader Style & Background',
		'style_padding' => array('top' => '50px', 'bottom' => '50px'),
		'style_bg' => array('color' => '#888'),
		'style_colorMood' => 'light',
		'items' => $items,
	);
	
	return array(
		'prefix' => 'sitesubheader_',
		'title' => 'Site Sub-Header',
		'before' => '',
		'after' => '',
		'section' => $sections,
	);
}


function medicals_site_part_render_site_footer_array(){
	
	$sections = array();
	$items = array();
	
	
	$items[] = array(
		'prefix' => 'footer_widgets_area',
		'before' => '<div class="footer_widgets %colorMood%" style="%bg% %padding%"><div class="footer_widgets_in container-width">',
		'after' => '</div></div>',
		'show_hide' => NULL,
		'style_title' => 'Widgets area Style',
		'style_padding' => array('top' => '40px', 'bottom' => '40px'),
		'style_bg' => array('color' => '#000'),
		'style_colorMood' => 'light',
		'elements' => array(
			array(
				'title' => 'Footer Widgets',
				'fn' => 'footerWidgets',
				'prefix' => 'footer_widgets',
				'settings' => '',
				'before' => '',
				'after' => '',
				'style_padding' => 'n/a',
				'style_bg' => 'n/a',
				'style_colorMood' => 'n/a',
			),
		),
	);
	$items[] = array(
		'before' => '<div class="copybar %colorMood%" style="%bg% %padding%"><div class="copybar_in container-width">',
		'after' => '</div></div>',
		'style_title' => 'Bottom area Style',
		'style_padding' => array('top' => '20px', 'bottom' => '20px'),
		'style_bg' => array('color' => '#444'),
		'style_colorMood' => 'light',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Footer Copyright',
				'fn' => 'copyText',
				'prefix' => 'copyright_',
				'settings' => '',
				'before' => '',
				'after' => '',
				'show_hide_std' => 'n/a',
			),
			array(
				'title' => 'Footer Credit',
				'fn' => 'creditText',
				'prefix' => 'credit_',
				'settings' => '',
				'before' => '',
				'after' => '',
				'show_hide_std' => 'n/a',
			),
		),
	);
	$sections[] = array(
		'before' => '',
		'after' => '',
		'items' => $items,
	);
	
	return array(
		'prefix' => 'sitefooter_',
		'title' => 'Site Footer',
		'before' => '<div class="site-footer" ><div class="site-footer-in">',
		'after' => '</div></div>',
		'section' => $sections,
	);
}