<?php
function medicals_setup(){
	add_filter('steed_site_part_render__site_header', 'medicals_site_part_render_site_header_array');
	add_filter('steed_site_part_render__after_site_header', 'medicals_ResponsiveMenu_render_site_header_array');
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
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Address',
				'fn' => 'iconText',
				'prefix' => 'address_',
				'settings' => '',
				'before' => '<div class="col-md-4 text_lg_right text_xs_center">',
				'after' => '</div>',
				'show_hide_std' => 'yes',
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
		'before' => '<div class="branding"><div class="branding-in container-width"><div class="row">',
		'after' => '</div></div></div>',
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
		'before' => '<div class="sitenav"><div class="sitenav-in container-width">',
		'after' => '</div></div>',
		'items' => $items,
	);
	
	return array(
		'prefix' => 'siteheader_',
		'title' => 'Site Header',
		'before' => '<div class="site-header" id="masthead"><div class="site-header-in">',
		'after' => '</div></div>',
		'section' => $sections,
		'is_panel' => false,
	);
}


function medicals_ResponsiveMenu_render_site_header_array(){
	
	$sections = array();
	$items = array();
	
	$items[] = array(
		'before' => '',
		'after' => '',
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
		'panel' => false,
	);
}



function medicals_site_part_render_site_footer_array(){
	
	$sections = array();
	$items = array();
	
	
	$items[] = array(
		'before' => '<div class="footer_widgets"><div class="footer_widgets_in container-width"><div class="row">',
		'after' => '</div></div></div>',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Footer Widgets 1',
				'fn' => 'widget',
				'prefix' => 'widget1',
				'settings' => '',
				'before' => '<div class="col-md-3 col-sm-6">',
				'after' => '</div>',
			),
			array(
				'title' => 'Footer Widgets 2',
				'fn' => 'widget',
				'prefix' => 'widget2',
				'settings' => '',
				'before' => '<div class="col-md-3 col-sm-6">',
				'after' => '</div>',
			),
			array(
				'title' => 'Footer Widgets 3',
				'fn' => 'widget',
				'prefix' => 'widget3',
				'settings' => '',
				'before' => '<div class="col-md-3 col-sm-6">',
				'after' => '</div>',
			),
			array(
				'title' => 'Footer Widgets 4',
				'fn' => 'widget',
				'prefix' => 'widget4',
				'settings' => '',
				'before' => '<div class="col-md-3 col-sm-6">',
				'after' => '</div>',
			),
		),
	);
	$items[] = array(
		'before' => '<div class="copybar"><div class="copybar_in container-width">',
		'after' => '</div></div>',
		'show_hide' => NULL,
		'elements' => array(
			array(
				'title' => 'Footer Copyright',
				'fn' => 'copyText',
				'prefix' => 'copyright_',
				'settings' => '',
				'before' => '',
				'after' => '',
			),
			array(
				'title' => 'Footer Credit',
				'fn' => 'creditText',
				'prefix' => 'credit_',
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
		'prefix' => 'sitefooter_',
		'title' => 'Site Footer',
		'before' => '<div class="site-footer" ><div class="site-footer-in">',
		'after' => '</div></div>',
		'section' => $sections,
		'panel' => false,
	);
}