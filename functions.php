<?php
/**
 * Steed functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Steed
 */

if(!defined('STEED_THEME_NAME')) { define('STEED_THEME_NAME', 'steed'); }
if(!defined('STEED_BASE_SLUG')) { define('STEED_BASE_SLUG', 'steed'); }
if(!defined('STEED_THEME_SLUG')) { define('STEED_THEME_SLUG', 'steed'); }
if(!defined('TALLYTHEME_DEMO_URL')) { define('TALLYTHEME_DEMO_URL', ''); }
if(!defined('STEED_DEMO_URL')) { define('STEED_DEMO_URL', ''); }
if(!defined('STEED_DOC_URL')) { define('STEED_DOC_URL', ''); }

global $steed_STD_theme_mod_data;

if(file_exists(get_stylesheet_directory().'/inc/demo/customization.php')){
	$steed_STD_theme_mod_file = include(get_stylesheet_directory().'/inc/demo/customization.php');
	$steed_STD_theme_mod_data = unserialize($steed_STD_theme_mod_file);
	
}
function steed_theme_mod($id, $std = NULL){
	global $steed_STD_theme_mod_data;
	$std_data_pre = (isset($steed_STD_theme_mod_data['mods'][$id])) ? $steed_STD_theme_mod_data['mods'][$id] : NULL;
	$std_data = ($std_data_pre != '') ? $std_data_pre : $std;
	
	if(get_theme_mod($id)){
		return get_theme_mod($id);
	}else{
		return $std_data;
	}
}

function steed_customiz_std($id, $std = NULL){
	global $steed_STD_theme_mod_data;
	$std_data_pre = (isset($steed_STD_theme_mod_data['mods'][$id])) ? $steed_STD_theme_mod_data['mods'][$id] : NULL;
	$std_data = ($std_data_pre != '') ? $std_data_pre : $std;
	
	return $std_data;
}

//print_r($steed_STD_theme_mod_data);


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
	
	/*
	* Declare WooCommerce support
	*/
	add_theme_support( 'woocommerce' );
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
}
add_action( 'widgets_init', 'steed_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function steed_scripts() {
	wp_register_style( 'magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/magnific-popup.css', array(), '1.0.1' );
	wp_enqueue_style( 'magnific-popup');
	wp_register_script( 'magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/jquery.magnific-popup.min.js', array('jquery'),'1.0.1',true );
	wp_enqueue_script( 'magnific-popup');
	
	wp_register_script( 'fitvids', get_template_directory_uri() . '/assets/fitvids/jquery.fitvids.js', array('jquery'), '1.1', true );
	wp_enqueue_script( 'fitvids');
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	
	if(!class_exists('Vc_Manager')){
		wp_enqueue_style( 'js_composer', get_template_directory_uri() . '/assets/vendors/js_composer.min.css', array(), '1.0');
		wp_enqueue_script( 'js_composer', get_template_directory_uri() . '/assets/vendors/js_composer_front.min.js', array(), '1.0', true );
	}
	if(!class_exists('Ultimate_VC_Addons')){
		wp_enqueue_style( 'ultimate', get_template_directory_uri() . '/assets/vendors/ultimate.min.css', array(), '1.0');
		wp_enqueue_script( 'ultimate', get_template_directory_uri() . '/assets/vendors/ultimate.min.js', array(), '1.0', true );
	}
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'steed-fonts', steed_fonts_url(), array(), null );
	
	wp_enqueue_style( 'steed-common', get_template_directory_uri() . '/assets/css/common.css', array(), '1.0');
	
	wp_enqueue_style( 'steed-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'steed-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0', true );
	wp_enqueue_script( 'steed-javascript', get_template_directory_uri() . '/assets/js/custom-scripts.js', array('jquery', 'imagesloaded', 'jquery-masonry', 'magnific-popup'), '2.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
}
add_action( 'wp_enqueue_scripts', 'steed_scripts' );

function steed_admin_scripts() {
	wp_register_style( 'steed-admin', get_template_directory_uri() . '/assets/css/steed-admin.css', array(), '1.0' );
	wp_enqueue_style( 'steed-admin');
	
}
add_action( 'admin_enqueue_scripts', 'steed_admin_scripts' );


/**
 * Enqueue Custom/Dynamic CSS
 */
function steed_custom_scripts(){
	$custom_css = apply_filters('steed_custom_css', steed_custom_css());
	
	echo '<style type="text/css">'.$custom_css.'</style>';
}
add_action( 'wp_head', 'steed_custom_scripts', 11 );

function steed_sanitize_rgba_field( $value ) {
		// If empty or an array return transparent
		if ( empty( $value ) || is_array( $value ) ) {
			return 'rgba(0,0,0,0)';
		}
		// If string does not start with 'rgba', then treat as hex
		// sanitize the hex color and finally convert hex to rgba
		if ( false === strpos( $value, 'rgba' ) ) {
			return sanitize_hex_color( $value  );
		}
		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$value = str_replace( ' ', '', $value );
		sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}


/**
 * alpha-color-picker
 */
require get_template_directory() . '/includes/vendors/alpha-color-picker/alpha-color-picker.php';


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


/**
 * Load Templates Parts
 */
require get_template_directory() . '/includes/php/templates-parts.php';


/**
 * Load Custom CSS functions
 */
require get_template_directory() . '/includes/php/css-tags.php';


/**
 * Load WooCommerce Funcions
 */
require get_template_directory() . '/includes/php/woocommerce.php';