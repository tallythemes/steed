<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Steed
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function steed_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'steed_body_classes' );



if ( ! function_exists( 'steed_fonts' ) ) :
	function steed_fonts(){
		
		$fonts = array();
		$new_fonts = array();
		
		/* #0 Heading Font */
		$fonts[] = 'Arvo:400,400i,700,700i';
	
		/* #1 Menu Font */
		$fonts[] = 'PT+Sans:400,400i,700,700i';
	
		/* #2 Body Font */
		$fonts[] = 'PT+Sans:400,400i,700,700i';
		
		$std_fonts = apply_filters('steed_fonts', $fonts);
		
		$new_fonts[] = (steed_theme_mod('google_font_1') != '') ? esc_attr(steed_theme_mod('google_font_1')) : $std_fonts[0];
		$new_fonts[] = (steed_theme_mod('google_font_2') != '') ? esc_attr(steed_theme_mod('google_font_2')) : $std_fonts[1];
		$new_fonts[] = (steed_theme_mod('google_font_3') != '') ? esc_attr(steed_theme_mod('google_font_3')) : $std_fonts[2];
		
		return $new_fonts;
	}
endif;


function steed_mal(){
	if(defined('STEED_THEME_ID_HEADER') && defined('STEED_THEME_NAME')){
		$header = STEED_THEME_ID_HEADER;
		$theme_name = STEED_THEME_NAME;
		if(md5(STEED_THEME_NAME) == STEED_THEME_ID_HEADER){
			return true;
		}else{
			return false;	
		}
	}else{
		return false;
	}
}

if ( ! function_exists( 'steed_fonts_url' ) ) :
/**
 * Register Google fonts for Steed.
 *
 * Create your own steed_fonts_url() function to override in a child theme.
 *
 * @since Steed 2.0
 *
 * @return string Google fonts URL for the theme.
 * 
 * Code Source Twenty Sixteen Theme
 */
 
function steed_fonts_url() {
	$fonts_url = '';
	$subsets   = 'latin,latin-ext';
	$fonts = steed_fonts();

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' =>  implode( '|', $fonts),
			//'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url($fonts_url);
}
endif;


if(! function_exists( 'steed_fonts_style' ) ):
/**
 * Get Font style by font use
 *
 * Create your own steed_fonts_style() function to override in a child theme.
 *
 * @since Steed 2.0
 *
 */
	function steed_fonts_style($i){
		
		$fonts = steed_fonts();
		$font_string = NULL;
		$font_name = NULL;
		
		if(isset($fonts[$i])){
			$font_string = $fonts[$i];
		}
		
		if($font_string != NULL){
			$font_name = str_replace("+", " ", strstr($font_string, ':', true));
			if($font_name == ''){  
				$font_name = "'".str_replace("+", " ", $font_string)."', sans-serif";
			}else{
				$font_name = "'".str_replace("+", " ", strstr($font_string, ':', true))."', sans-serif";
			}
		}
		
		return sanitize_text_field($font_name);
	}
endif;


function steed_colors(){
	$std_colors = apply_filters('steed_colors', array(
		'primary'	=> '#1e73be',
		'primary_l'	=> '#288de6',
		'primary_d'	=> '#145690',
		'accent'	=> '#06bd27',
		'light'		=> '#ffffff',
		'dim_light'	=> '#bdbdbd',
		'dim_dark'	=> '#757575',
		'dark'		=> '#212121',
	));
	
	$primary	= (steed_theme_mod('primary_color') != '')	? sanitize_hex_color(steed_theme_mod('primary_color'))	: $std_colors['primary'];
	$primary_l	= (steed_theme_mod('primary_l_color') != '')	? sanitize_hex_color(steed_theme_mod('primary_l_color'))	: $std_colors['primary_l'];
	$primary_d	= (steed_theme_mod('primary_d_color') != '')	? sanitize_hex_color(steed_theme_mod('primary_d_color'))	: $std_colors['primary_d'];
	$accent		= (steed_theme_mod('accent_color') != '')		? sanitize_hex_color(steed_theme_mod('accent_color'))		: $std_colors['accent'];
	$light		= (steed_theme_mod('light_color') != '')		? sanitize_hex_color(steed_theme_mod('light_color'))		: $std_colors['light'];
	$dim_light	= (steed_theme_mod('dim_light_color') != '')	? sanitize_hex_color(steed_theme_mod('dim_light_color'))	: $std_colors['dim_light'];
	$dim_dark	= (steed_theme_mod('dim_dark_color') != '')	? sanitize_hex_color(steed_theme_mod('dim_dark_color'))	: $std_colors['dim_dark'];
	$dark		= (steed_theme_mod('dark_color') != '')		? sanitize_hex_color(steed_theme_mod('dark_color'))		: $std_colors['dark'];
	
	
	$colors = array(
		'primary'	=> $primary,
		'primary_l'	=> $primary_l,
		'primary_d'	=> $primary_d,
		'accent'	=> $accent,
		'light'		=> $light,
		'dim_light'	=> $dim_light,
		'dim_dark'	=> $dim_dark,
		'dark'		=> $dark,
	);
	
	return $colors;
}



if(! function_exists( 'steed_custom_css' ) ):
/**
 * Generate Dynamic CSS 
 *
 * Create your own steed_custom_css() function to override in a child theme.
 *
 * @since Steed 2.0
 *
 *@ use steed_colors filter to overwrite color code
 */

function steed_custom_css(){
	$colors = steed_colors();
	
	$primary_color = $colors['primary'];
	$primary_l_color = $colors['primary_l'];
	$primary_d_color = $colors['primary_d'];
	$accent_color = $colors['accent'];
	$light_color = $colors['light'];
	$dim_light_color = $colors['dim_light'];
	$dark_color = $colors['dark'];
	$dim_dark_color = $colors['dim_dark'];
	
	$css = '';
	
	/* Font */
	$css .= 'body{ font-family:'.steed_fonts_style(2).'; }';
	$css .= '.main-navigation, .main-navigation a{ font-family:'. steed_fonts_style(1).'; }';
	$css .= 'h1, h2, h3, h4, h5, h6{ font-family:'. steed_fonts_style(0).'; }';
	
	if(steed_theme_mod('h1_size') != '') { $css .= 'h1{ font-size:'. esc_attr(steed_theme_mod('h1_size')).' !important; }'; }
	if(steed_theme_mod('h2_size') != '') { $css .= 'h2{ font-size:'. esc_attr(steed_theme_mod('h2_size')).' !important; }'; }
	if(steed_theme_mod('h3_size') != '') { $css .= 'h3{ font-size:'. esc_attr(steed_theme_mod('h3_size')).' !important; }'; }
	if(steed_theme_mod('h4_size') != '') { $css .= 'h4{ font-size:'. esc_attr(steed_theme_mod('h4_size')).' !important; }'; }
	if(steed_theme_mod('h5_size') != '') { $css .= 'h5{ font-size:'. esc_attr(steed_theme_mod('h5_size')).' !important; }'; }
	if(steed_theme_mod('h6_size') != '') { $css .= 'h6{ font-size:'. esc_attr(steed_theme_mod('h6_size')).' !important; }'; }
	if(steed_theme_mod('body_font_size') != '') { $css .= 'body{ font-size:'. esc_attr(steed_theme_mod('body_font_size')).' !important; }'; }
	
	/* Primary & Accent */
	$css .= 'a{ color:'.$primary_color.'; }';
	$css .= 'a:hover{ color:'.$accent_color.'; }';
	$css .= '.widget_search input[type="submit"]{ background-color:'.$primary_color.';}';
	$css .= '.widget_search input[type="search"]{ border-color:'.$primary_color.'; }';
	$css .= '.widget_meta ul li:hover,
.widget_pages ul li:hover,
.widget_nav_menu ul li:hover,
.widget_recent_entries ul li:hover,
.widget_archive ul li:hover,
.widget_categories ul li:hover,
.widget_recent_comments ul li:hover{ color: '.$accent_color.'; }';

	$css .= '.element_button{ background-color:'.$primary_color.'; border-color:'.$primary_color.'; }';
	$css .= '.element_button:hover{ background-color:'.$primary_d_color.'; border-color:'.$primary_d_color.'; }';
	$css .= '.element_button.border_style{ color:'.$primary_color.';  }';
	$css .= '.element_button.border_style:hover{ background-color:'.$primary_color.'; }';
	
	$css .= 'button, input[type="button"], input[type="reset"], input[type="submit"]{ background-color:'.$primary_color.'; border-color:'.$primary_color.'; color:'.$light_color.'; }';
	$css .= 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover{ background-color:'.$primary_l_color.'; border-color:'.$primary_l_color.'; color:'.$light_color.'; }';
	
	
	/* Primary Class */
	$css .= 'html .pc_bg{ background-color:'.$primary_color.'; }';
	$css .= 'html .pc_bg_hover:hover{ background-color:'.$primary_color.'; }';
	$css .= 'html .pc_border{ border-color:'.$primary_color.'; }';
	$css .= 'html .pc_border_hover:hover{ border-color:'.$primary_color.'; }';
	$css .= 'html .pc_text{ color:'.$primary_color.'; }';
	$css .= 'html .pc_text_hover:hover{ color:'.$primary_color.'; }';
	
	/* Primary Dark Class */
	$css .= 'html .pdc_bg{ background-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_bg_hover:hover{ background-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_border{ border-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_border_hover:hover{ border-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_text{ color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_text_hover:hover{ color:'.$primary_d_color.'; }';
	
	/* Primary Light Class */
	$css .= 'html .plc_bg{ background-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_bg_hover:hover{ background-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_border{ border-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_border_hover:hover{ border-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_text{ color:'.$primary_l_color.'; }';
	$css .= 'html .plc_text_hover:hover{ color:'.$primary_l_color.'; }';
	
	/* Accent Class */
	$css .= 'html .ac_bg{ background-color:'.$accent_color.'; }';
	$css .= 'html .ac_bg_hover:hover{ background-color:'.$accent_color.'; }';
	$css .= 'html .ac_border{ border-color:'.$accent_color.'; }';
	$css .= 'html .ac_border_hover:hover{ border-color:'.$accent_color.'; }';
	$css .= 'html .ac_text{ color:'.$accent_color.'; }';
	$css .= 'html .ac_text_hover:hover{ color:'.$accent_color.'; }';
	
	/* Light Class */
	$css .= 'html .lc_bg{ background-color:'.$light_color.'; }';
	$css .= 'html .lc_bg_hover:hover{ background-color:'.$light_color.'; }';
	$css .= 'html .lc_border{ border-color:'.$light_color.'; }';
	$css .= 'html .lc_border_hover:hover{ border-color:'.$light_color.'; }';
	$css .= 'html .lc_text{ color:'.$light_color.'; }';
	$css .= 'html .lc_text_hover:hover{ color:'.$light_color.'; }';
	
	/* Dim Light Class */
	$css .= 'html .dlc_bg{ background-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_bg_hover:hover{ background-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_border{ border-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_border_hover:hover{ border-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_text{ color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_text_hover:hover{ color:'.$dim_light_color.'; }';
	
	/* Dark Class */
	$css .= 'html .dc_bg{ background-color:'.$dark_color.'; }';
	$css .= 'html .dc_bg_hover:hover{ background-color:'.$dark_color.'; }';
	$css .= 'html .dc_border{ border-color:'.$dark_color.'; }';
	$css .= 'html .dc_border_hover:hover{ border-color:'.$dark_color.'; }';
	$css .= 'html .dc_text{ color:'.$dark_color.'; }';
	$css .= 'html .dc_text_hover:hover{ color:'.$dark_color.'; }';
	
	/* Dim Dark Class */
	$css .= 'html .ddc_bg{ background-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_bg_hover:hover{ background-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_border{ border-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_border_hover:hover{ border-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_text{ color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_text_hover:hover{ color:'.$dim_dark_color.'; }';
	
	/* Dark Text */
	$css .= 'html .color-dark h1,html .color-dark h2,html .color-dark h3,html .color-dark h4,html .color-dark h5,html .color-dark h6{color:'.$dark_color.';}';
	$css .= 'html .color-dark{ color:'.$dark_color.'; }';
	$css .= 'html .color-dark{ border-color:'.$dim_light_color.'; }';
	
	/* Light Text */
	$css .= 'html .color-light h1, html .color-light h2, html .color-light h3, html .color-light h4, html .color-light h5, html .color-light h6{color:'.$light_color.';}';
	$css .= 'html .color-light{ color:'.$light_color.'; }';
	$css .= 'html .color-light{ border-color:'.$dim_dark_color.'; }';
	
	/* Content Area */
	$css .= steed_CSS_padding('content_area_', '.site-content');
	$css .= steed_CSS_background('content_area_', '.site-content');
	
	
	$css .= steed_element_CSS_menuColors('#primary-menu');
	
	$css .= '::selection { background: '.$primary_color.'; color: #ffffff; }';

	return $css;
}
endif;




function steed_validate_Phone_number($string) {
    $numbersOnly = preg_replace("[^0-9]", "", $string);
    $numberOfDigits = strlen($numbersOnly);
    if (($numberOfDigits >= 7) && ($numberOfDigits <= 14)) {
       return true;
    } else {
        return false;
    }
}


if ( ! function_exists( 'steed_return_light_color_name' ) ) :
function steed_return_light_color_name(){
	return 'light';	
}
endif;

if ( ! function_exists( 'steed_return_dark_color_name' ) ) :
function steed_return_dark_color_name(){
	return 'dark';	
}
endif;


/*
	Import customizer data after theme installed
-------------------------------------------------*/
function steed_customizer_data_import_init(){
	
	$theme = get_option( 'stylesheet' );
	
	$free_was_installed = get_option('steed_'.STEED_BASE_SLUG.'_free_installed');
	$pro_data_imported = get_option('steed_'.STEED_BASE_SLUG.'_pro_data_imported');
	$free_data_imported = get_option('steed_'.STEED_BASE_SLUG.'_free_data_imported');
	$free_theme_slug = STEED_BASE_SLUG.'-free';
	
	if(($free_was_installed != 'yes') && (STEED_THEME_SLUG == STEED_BASE_SLUG.'-free')){
		update_option('steed_'.STEED_BASE_SLUG.'_free_installed', 'yes');
	}
	
	if(file_exists(get_stylesheet_directory().'/inc/demo/customization.php')){
		
		$data_file = include(get_stylesheet_directory().'/inc/demo/customization.php');
		$old_data = get_option("theme_mods_$free_theme_slug");
		$new_data = unserialize($data_file);
			
		if(($free_was_installed == 'yes') && (STEED_THEME_SLUG == STEED_BASE_SLUG.'-pro') && ($pro_data_imported != 'yes')){
			$combo_data = array_merge( $new_data['mods'], $old_data);
			if(update_option( "theme_mods_$theme", $combo_data )){
				update_option('steed_'.STEED_BASE_SLUG.'_pro_data_imported', 'yes');
			}
		}elseif((STEED_THEME_SLUG == STEED_BASE_SLUG.'-free') && ($free_data_imported != 'yes')){
			if(update_option( "theme_mods_$theme", $new_data['mods'] )){
				update_option('steed_'.STEED_BASE_SLUG.'_free_data_imported', 'yes');
			}
		}elseif((STEED_THEME_SLUG == STEED_BASE_SLUG.'-pro') && ($pro_data_imported != 'yes')){
			if(update_option( "theme_mods_$theme", $new_data['mods'] )){
				update_option('steed_'.STEED_BASE_SLUG.'_pro_data_imported', 'yes');
			}
		}
	}
	
	echo '$free_was_installed: '.$free_data_imported.'<br>';
	echo '$pro_data_imported: '.$pro_data_imported.'<br>';
	echo '$free_data_imported: '.$free_data_imported.'<br>';
}
//add_action("after_switch_theme", "steed_customizer_data_import_init");


/*
	Intro Page
-------------------------------------------------*/
add_action("after_setup_theme", "steed_intro_page_redirect");
function steed_intro_page_redirect(){
	global $pagenow;
	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
		wp_redirect(admin_url("themes.php?page=steed-intro")); // Your admin page URL
	}
}
add_action('admin_menu', 'steed_intro_page_menu');
function steed_intro_page_menu() {
	$theme = wp_get_theme();
	add_theme_page($theme->get( 'Name' ).' Theme', $theme->get( 'Name' ), 'edit_theme_options', 'steed-intro', 'steed_intro_page_html');
}
function steed_intro_page_html(){
	$theme = wp_get_theme();
	?>
    <div class="wrap about-wrap">
    	<div class="wrap-container">
        	<div class="bend-heading-section ultimate-header">
				<h1>Welcome to <?php echo $theme->get( 'Name' ); ?></h1>
				<h3><?php echo $theme->get( 'Description' ); ?></h3>
				<div class="bend-head-logo">
                    <div class="bend-product-ver">
                      Version <?php echo $theme->get( 'Version' ); ?>
                    </div>
				</div>
            </div>
            <br>
            <?php if(TGM_Plugin_Activation::get_instance()->is_tgmpa_complete() === false): ?>
            <a class="button button-primary button-hero" href="<?php echo admin_url('themes.php?page=tgmpa-install-plugins'); ?>">Install Plugins</a>
            <?php endif; ?>
            <a class="button button-primary button-hero" href="<?php echo admin_url('customize.php'); ?>">Theme Settings</a>
            <a class="button button-primary button-hero" href="<?php echo STEED_DEMO_URL; ?>">Theme Live Demo</a>
            <p>&nbsp;</p>
            <div class="container">
                <div class="steed_row">
                	<div class="steed_col">
                    	<div class="steed_col_content">
                        	<span class="dashicons dashicons-welcome-learn-more"></span>
                        	<h4>Read Theme Documentation</h4>
                            <p><?php echo $theme->get( 'Name' ); ?> come with an exclusive documentations. We have explained each steps of the theme installation process in the documentation. Please follow the theme documentation to know how the theme work.</p>
                            <a class="button button-primary" href="<?php echo STEED_DOC_URL; ?>">See Documentation</a>
                        </div>
                    </div>
                    <div class="steed_col last">
                    	<div class="steed_col_content">
                        	<span class="dashicons dashicons-download"></span>
                        	<h4>Download More FREE Themes</h4>
                            <p>We offer free wordpress theme. We have more than 15+ FREE wordpress theme available for download. Click the button below and browse free themes.</p>
                            <a class="button button-primary" href="<?php echo esc_url('http://tallythemes.com/product-category/free-wordpress-themes/'); ?>">More Free Themes</a>
                        </div>
                    </div>
                </div>
                <div class="steed_row last">
                	<div class="steed_col">
                    	<div class="steed_col_content">
                        	<span class="dashicons dashicons-sos"></span>
                        	<h4>Get Support</h4>
                            <p>We offer FREE support for Premium product Users. You can read our support policy <a href="<?php echo esc_url('http://tallythemes.com/support-policy/'); ?>">here</a>. Click on the button below and create a support ticket. Our support stuff will contact with you in 24 hours.</p>
                            <a class="button button-primary" href="<?php echo esc_url('http://tallythemes.com/support/'); ?>">Get Support</a>
                        </div>
                    </div>
                    <div class="steed_col last">
                    	<div class="steed_col_content">
                            <span class="dashicons dashicons-cart"></span>
                        	<h4>Shop More</h4>
                            <p>TallyThems offer high quality Premium WordPress theme and Plugins. All latest WordPress themes are coming with Page Builder. So browse our Premium theme today.</p>
                            <a class="button button-primary" href="<?php echo esc_url('http://tallythemes.com/product-category/wordpress-themes/'); ?>">Shop More Themes</a>
                        </div>
                    </div>
                </div>
            </div><!--.container-->
        </div>
    </div>
    <?php
}




function steed_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function steed_rgb2hex($rgb) {
   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}


add_action('wp_head', 'steed_site_preloader');
function steed_site_preloader(){
?>
<div class="steed-preloader">
    <div class="sk-circle">
      <div class="sk-circle1 sk-child"></div>
      <div class="sk-circle2 sk-child"></div>
      <div class="sk-circle3 sk-child"></div>
      <div class="sk-circle4 sk-child"></div>
      <div class="sk-circle5 sk-child"></div>
      <div class="sk-circle6 sk-child"></div>
      <div class="sk-circle7 sk-child"></div>
      <div class="sk-circle8 sk-child"></div>
      <div class="sk-circle9 sk-child"></div>
      <div class="sk-circle10 sk-child"></div>
      <div class="sk-circle11 sk-child"></div>
      <div class="sk-circle12 sk-child"></div>
    </div>
</div>
<script type="text/javascript">
	jQuery( document ).ready(function($) {
		//$('.steed-preloader').css('display', 'none');
	});
	jQuery(window).load(function() {
		setTimeout(function() { 
			jQuery('.steed-preloader').css('display', 'none');
		}, 500);
	});
</script>
<?php	
}