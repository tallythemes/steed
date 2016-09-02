<?php
/**
 * Steed functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Steed
 */

if ( ! function_exists( 'steed_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function steed_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Steed, use a find and replace
	 * to change 'steed' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'steed', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'steed' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );
	
	
	/*
	* Enable support for custom logo.
	*
	*/
	add_theme_support( 'custom-logo', array(
		'height'      => 90, /* 70 */
		'width'       => 200, /* 240 */
		'flex-height' => true, //true, false
	));
	
	
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'steed_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function steed_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'steed_content_width', 640 );
}
add_action( 'after_setup_theme', 'steed_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function steed_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'steed' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'steed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'steed' ),
		'id'            => 'header',
		'description'   => esc_html__( 'Add widgets here.', 'steed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'steed' ),
		'id'            => 'footer_1',
		'description'   => esc_html__( 'Add widgets here.', 'steed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'steed' ),
		'id'            => 'footer_2',
		'description'   => esc_html__( 'Add widgets here.', 'steed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'steed' ),
		'id'            => 'footer_3',
		'description'   => esc_html__( 'Add widgets here.', 'steed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Header Social Icon', 'steed' ),
		'id'            => 'social_icons',
		'description'   => esc_html__( 'Add a widget that show social icon', 'steed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'steed_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function steed_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'font-awesome');
	
	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.css', array(), '2.4' );
	wp_enqueue_style( 'owl-carousel');
	wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.js', array('jquery'), '2.4', true );
	wp_enqueue_script( 'owl-carousel');
	
	wp_register_style( 'steed-ec', get_template_directory_uri() . '/assets/css/ec.css', array(), '1.0' );
	wp_enqueue_style( 'steed-ec');
	wp_register_script( 'steed-ec', get_template_directory_uri() . '/assets/js/ec.js', array('jquery', 'owl-carousel'), '1.0', true );
	wp_enqueue_script( 'steed-ec');
	
	
	wp_register_script( 'steed-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0', true );
	wp_enqueue_script( 'steed-skip-link-focus-fix' );
	
	wp_enqueue_style( 'steed-style', get_stylesheet_uri() );

	wp_register_script( 'steed-javascript', get_template_directory_uri() . '/assets/js/custom-scripts.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'steed-javascript' );
		
}
add_action( 'wp_enqueue_scripts', 'steed_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/php/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/php/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/php/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/php/jetpack.php';


/**
 * Load TGM plugin installaer 
 */
require get_template_directory() . '/includes/vendors/class-tgm-plugin-activation.php';
require get_template_directory() . '/includes/php/plugins-list.php';