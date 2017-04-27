<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Steed
 */
if ( ! function_exists( 'steed_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function steed_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'steed' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'steed' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'steed_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function steed_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'steed' ) );
		if ( $categories_list && steed_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'steed' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'steed' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'steed' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'steed' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'steed' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function steed_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'steed_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'steed_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so steed_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so steed_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in steed_categorized_blog.
 */
function steed_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'steed_categories' );
}
add_action( 'edit_category', 'steed_category_transient_flusher' );
add_action( 'save_post',     'steed_category_transient_flusher' );



if ( ! function_exists( 'steed_site_header' ) ) :

	function steed_site_header(){
		do_action('steed_before_site_header');
		get_template_part( 'includes/parts/part', 'header');
		do_action('steed_after_site_header');
	}

endif;

if ( ! function_exists( 'steed_site_subheader' ) ) :

	function steed_site_subheader(){
		do_action('steed_before_site_subheader');
		get_template_part( 'includes/parts/part', 'subheader');
		do_action('steed_after_site_subheader');
	}

endif;

if ( ! function_exists( 'steed_site_footer' ) ) :

	function steed_site_footer(){
		do_action('steed_before_site_footer');
		get_template_part( 'includes/parts/part', 'footer');
		do_action('steed_before_site_footer');
	}

endif;


if ( ! function_exists( 'steed_before_site_content' ) ) :

	function steed_before_site_content($arg){
		$arg = array_merge(array( 'class' => '', 'in_class' => '' ), $arg);
		echo '<div id="content" class="site-content '.steed_element_colorMood('content_area_').' '.$arg['class'].'">';
			echo '<div id="content-in" class="site-content-in '.$arg['in_class'].'">';
				do_action('steed_before_site_content');
	}

endif;


if ( ! function_exists( 'steed_after_site_content' ) ) :

	function steed_after_site_content(){
				do_action('steed_after_site_content');
			echo '</div><!-- #content-in -->';
		echo '</div><!-- #content -->';
		
	}

endif;


if ( ! function_exists( 'steed_before_primary_content' ) ) :

	function steed_before_primary_content(){
		
		echo '<div id="primary" class="content-area">';
			echo '<main id="main" class="site-main" role="main">';
				do_action('steed_before_primary_content');
	}

endif;


if ( ! function_exists( 'steed_after_primary_content' ) ) :

	function steed_after_primary_content(){
				do_action('steed_after_primary_content');
			echo '</main><!-- #main -->';
		echo '</div><!-- #primary -->';
		
	}

endif;


if ( ! function_exists( 'steed_custom_logo' ) ) :
	function steed_custom_logo() {
		
		$output = '';
		$description = get_bloginfo( 'description', 'display' );
		
		// Try to retrieve the Custom Logo
		if (function_exists('get_custom_logo')){
			$output = get_custom_logo();
		}
	
		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
		if (empty($output)){
			if ( is_front_page() && is_home() ){
				$output = '<h1  class="site-title"><a href="' . esc_url(home_url('/')) . '">'.get_bloginfo( 'name' ).'</a></h1>';
			}else{
				$output = '<p  class="site-title"><a href="' . esc_url(home_url('/')) . '">'.get_bloginfo( 'name' ).'</a></p>';
			}
			if ( $description || is_customize_preview() ){
				$output .= '<p  class="site-description">'.$description.'</p>';
			}
		}
		
		/*Validating using wp_kses as the output contain images and h1 tags*/
		echo wp_kses($output, wp_kses_allowed_html( 'post' ));
	}
endif;





if ( ! function_exists( 'steed_element_menu' ) ) :
	function steed_element_menu($prefix, $settings) {
		wp_nav_menu( array( 'theme_location' => $settings['theme_location'], 'menu_id' => $settings['menu_id'] ) );
	}
endif;


if ( ! function_exists( 'steed_element_menuHand' ) ) :
	function steed_element_menuHand($settings) {
		echo '<a href="'.$settings['menu_id'].'" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>';
	}
endif;


if ( ! function_exists( 'steed_element_ResponsiveMenu' ) ) :
	function steed_element_ResponsiveMenu() {
		echo '<div class="responsive-menu">';
			echo '<a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a>';
		echo '</div>';
	}
endif;


if ( ! function_exists( 'steed_element_socialIcons' ) ) :
	function steed_element_socialIcons($the_prefix, $settings = array()) {
		$atr = array_merge(array(
			"class" => "",
		), $settings);
		
		$prefix = esc_attr($the_prefix);
		$active = steed_theme_mod($prefix.'social_active', 'yes');
		$icon_1 = steed_theme_mod($prefix.'social_icon_1', 'fa-facebook');
		$text_1 = esc_url(steed_theme_mod($prefix.'social_text_1', '#'));
		$icon_2 = steed_theme_mod($prefix.'social_icon_2', 'fa-twitter');
		$text_2 = esc_url(steed_theme_mod($prefix.'social_text_2', '#'));
		$icon_3 = steed_theme_mod($prefix.'social_icon_3', 'fa-linkedin');
		$text_3 = esc_url(steed_theme_mod($prefix.'social_text_3', '#'));
		$icon_4 = steed_theme_mod($prefix.'social_icon_4', '');
		$text_4 = esc_url(steed_theme_mod($prefix.'social_text_4', ''));
		$icon_5 = steed_theme_mod($prefix.'social_icon_5', '');
		$text_5 = esc_url(steed_theme_mod($prefix.'social_text_5', ''));
		$icon_6 = steed_theme_mod($prefix.'social_icon_6', '');
		$text_6 = esc_url(steed_theme_mod($prefix.'social_text_6', ''));	
		
		if($active == 'yes'):	
		?>
        <div class="social-icons <?php echo $atr['class']; ?>">
			<?php if(!empty($icon_1) && !empty($text_1)): ?>
				<a href="<?php echo $text_1; ?>" rel="nofollow">
					<?php
						if(strpos($icon_1, 'fa') !== false){
							echo '<i class="fa '.esc_attr($icon_1).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_1).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_2) && !empty($text_2)): ?>
				<a href="<?php echo $text_2; ?>" rel="nofollow">
					<?php
						if(strpos($icon_2, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_2).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_2).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_3) && !empty($text_3)): ?>
				<a href="<?php echo $text_3; ?>" rel="nofollow">
					<?php
						if(strpos($icon_3, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_3).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_3).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_4) && !empty($text_4)): ?>
				<a href="<?php echo $text_4; ?>" rel="nofollow">
					<?php
						if(strpos($icon_4, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_4).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_4).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_5) && !empty($text_5)): ?>
				<a href="<?php echo $text_5; ?>" rel="nofollow">
					<?php
						if(strpos($icon_5, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_5).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_5).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
			<?php if(!empty($icon_6) && !empty($text_6)): ?>
				<a href="<?php echo $text_6; ?>" rel="nofollow">
					<?php
						if(strpos($icon_6, 'fa-') !== false){
							echo '<i class="fa '.esc_attr($icon_6).'"></i>';	
						}else{
							echo '<img src="'.esc_url($icon_6).'" alt="">';	
						}
					?>
				</a>
			<?php endif; ?>
		</div>
        <?php
		endif;
	}
endif;

if ( ! function_exists( 'steed_element_text' ) ) :
	function steed_element_text($prefix, $settings = array()) {
		
		$atr = array_merge(array(
			"class" => "",
			"before" => "",
			"after" => "",
			"std_active" => "yes",
			"std_content" => "Sample Content is here",
			"std_icon" => "",
		), $settings);
		
		$active = steed_theme_mod($prefix.'text_active', $atr['std_active']);
		$text = steed_theme_mod($prefix.'text_content', $atr['std_content']);
		$icon = steed_theme_mod($prefix.'text_icon', $atr['std_icon']);
		

		$before = $atr['before'];
		$after = $atr['after'];
		
		if(esc_attr($active) == 'yes'){
			
			/* Security Check for icon */
			if(strpos($icon, 'fa-') !== false){
				$the_icon = '<span class="s1">'.'<i class="fa '.esc_attr($icon).'"></i>'.'</span> ';
			}
			elseif(!filter_var($icon, FILTER_VALIDATE_URL) === false){
				$the_icon = '<span class="s1">'.'<img src="'.esc_url($icon).'" alt="">'.'</span> ';
			}
			else{
				$the_icon = '<span class="s1">'.wp_kses_post($icon).'</span> ';
			}

			/* Security Check for Text */
			if(steed_validate_Phone_number($text)){
				$the_text = $the_icon.'<span class="s2"><a href="tel:'.esc_attr($text).'">'.esc_attr($text).'</a></span>';
			}
		    elseif(filter_var(trim($text), FILTER_VALIDATE_EMAIL)){
				$the_text = $the_icon.'<span class="s2"><a href="mailto:'.esc_attr($text).'">'.esc_attr($text).'</a></span>';
			}
			else{
				$the_text = $the_icon.'<span class="s2">'.wp_kses_post($text).'</span>';
			}
			
			if(esc_attr($text) != ''){
				echo $before;
					echo '<div class="elementText '.$atr['class'].'">';
						echo '<div class="elementText_in">';
							echo $the_text;
						echo '</div>';
					echo '</div>';
				echo $after;
			}
		}
		
	}
endif;

if ( ! function_exists( 'steed_element_html' ) ) :
	function steed_element_html($prefix, $settings= array()) {
		$atr = array_merge(array(
			"class" => "",
			"in_class" => "",
		), $settings);
		
		$active = steed_theme_mod($prefix.'html_active', 'yes');
		$html = steed_theme_mod($prefix.'html_content', '');
		
		$before =(!empty($settings['before'])) ? $settings['before'] : NULL;
		$after =(!empty($settings['after'])) ? $settings['after'] : NULL;
		
		if(esc_attr($active) == 'yes'){			
			if(wp_kses_post($html) != ''){
				echo $before;
					echo '<div class="element_html '.$atr['class'].'">';
						echo '<div class="element_html_in '.$atr['in_class'].'">';
							echo wp_kses_post($html);
						echo '</div>';
					echo '</div>';
				echo $after;
			}
		}
	}
endif;


if ( ! function_exists( 'steed_element_iconText' ) ) :
	function steed_element_iconText($prefix, $settings =array()) {
		
		$defualt = array(
			"std_active" => "yes",
			"std_icon" => "",
			"std_line1" => "",
			"std_line2" => "",
			"std_line2" => "",
			"before" => "",
			"after" => "",
		);
		if(is_array($settings)){
			$atr = array_merge($defualt, $settings);
		}else{
			$atr = $defualt;
		}
		
		$active = steed_theme_mod($prefix.'iconText_active', $atr['std_active']);
		$icon = steed_theme_mod($prefix.'iconText_icon', $atr['std_icon']);
		$line1 = steed_theme_mod($prefix.'iconText_line1', $atr['std_line1']);
		$line2 = steed_theme_mod($prefix.'iconText_line2', $atr['std_line2']);
		
		$before =(!empty($atr['before'])) ? $atr['before'] : NULL;
		$after =(!empty($atr['after'])) ? $atr['after'] : NULL;
		
		if(esc_attr($active) == 'yes'){
			$the_icon = $icon;
			$the_line1 = $line1;
			$the_line2 = $line2;
			
			/* Security Check for icon */
			if(strpos($icon, 'fa-') !== false){
				$the_icon = '<i class="fa '.esc_attr($icon).'"></i>';;
			}
			elseif(!filter_var($icon, FILTER_VALIDATE_URL) === false){
				$the_icon = '<img src="'.esc_url($icon).'" alt="">';
			}
			else{
				$the_icon = wp_kses_post($icon);
			}
			
			/* Security Check for Line1 */
			if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $line1)){
				$the_line1 = '<a href="tel:'.esc_attr($line1).'">'.esc_attr($line1).'</a>';
			}
			elseif(filter_var($line1, FILTER_VALIDATE_EMAIL)){
				$the_line1 = '<a href="mailto:'.esc_attr($line1).'">'.esc_attr($line1).'</a>';
			}
			else{
				$the_line1 = wp_kses_post($line1);
			}
			
			/* Security Check for Line2 */
			if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $line2)){
				$the_line2 = '<a href="tel:'.esc_attr($line2).'">'.esc_attr($line2).'</a>';
			}
			elseif(filter_var($line2, FILTER_VALIDATE_EMAIL)){
				$the_line2 = '<a href="mailto:'.esc_attr($line2).'">'.esc_attr($line2).'</a>';
			}
			else{
				$the_line2 = wp_kses_post($line2);
			}
			
			$line_check_class = ((esc_attr($line1) != '') && (esc_attr($line2) != '')) ? 'both_line' : 'single_line';
			$icon_check_class = (esc_attr($icon) != '') ? 'has_icon' : 'no_icon';
			
			echo $before;
				echo '<div class="iconText '.$icon_check_class.' '.$line_check_class.'">';
					echo '<div class="iconText_in">';
						if(esc_attr($icon) != ''){
						echo '<div class="iconText_icon">';
							echo $the_icon;
						echo '</div>';
						}
						if((esc_attr($line1) != '') || (esc_attr($line2) != '')){
						echo '<div class="iconText_content">';
							if(esc_attr($line1) != ''){
							echo '<strong>'.$the_line1.'</strong>';
							}
							if(esc_attr($line2) != ''){
							echo '<span>'.$the_line2.'</span>';
							}
						echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo $after;
		}
	}
endif;


if ( ! function_exists( 'steed_element_searchBar' ) ) :
	function steed_element_searchBar($prefix, $settings =array()) {
		$active = esc_attr(steed_theme_mod($prefix.'searchBar_active', 'yes'));
		$before =(!empty($settings['before'])) ? $settings['before'] : NULL;
		$after =(!empty($settings['after'])) ? $settings['after'] : NULL;
		
		if($active == 'yes'){
			echo $before;
				
			echo $after;
		}
	}
endif;


if ( ! function_exists( 'steed_element_searchIcon' ) ) :
	function steed_element_searchIcon($prefix, $settings =array()) {
		$defualt = array(
			"std_active" => "yes",
			"before" => "",
			"after" => "",
		);
		if(is_array($settings)){
			$atr = array_merge($defualt, $settings);
		}else{
			$atr = $defualt;
		}
		
		$active = esc_attr(steed_theme_mod($prefix.'searchIcon_active', $atr['std_active']));
		$before =(!empty($settings['before'])) ? $settings['before'] : NULL;
		$after =(!empty($settings['after'])) ? $settings['after'] : NULL;
		
		if($active == 'yes'){
			echo $before;
				echo '<a href="#element_searchIcon_holder_in" class="element_searchIcon inline-lightbox"><i class="fa fa-search"></i></a>';
			echo $after;
		}
		
	}
endif;
add_action('wp_footer', 'steed_element_searchIcon_footer_code');
function steed_element_searchIcon_footer_code(){
	?>
    <div class="element_searchIcon_holder">
    	<div class="element_searchIcon_holder_in" id="element_searchIcon_holder_in">
        	<?php get_search_form(); ?>
        </div>
    </div>
    <?php
}


if ( ! function_exists( 'steed_element_loginRegister' ) ) :
	function steed_element_loginRegister($prefix, $settings =array()) {
		
		$defualt = array(
			"std_active" => "yes",
			"std_login_text" => "Login",
			"std_login_link" => "#",
			"std_register_text" => "Register",
			"std_register_link" => "#",
			"std_logout_text" => "Logout",
			"std_logout_link" => "#",
			"std_account_text" => "Account",
			"std_account_link" => "#",
			"before" => "",
			"after" => "",
		);
		if(is_array($settings)){
			$atr = array_merge($defualt, $settings);
		}else{
			$atr = $defualt;
		}
		
		$active = esc_attr(steed_theme_mod($prefix.'loginRegister_active', $atr['std_active']));
		
		$login_text = esc_attr(steed_theme_mod($prefix.'loginRegister_login_text', $atr['std_login_text']));
		$login_link = esc_url(steed_theme_mod($prefix.'loginRegister_login_link', $atr['std_login_link']));
		$register_text = esc_attr(steed_theme_mod($prefix.'loginRegister_register_text', $atr['std_register_text']));
		$register_link = esc_url(steed_theme_mod($prefix.'loginRegister_register_link', $atr['std_register_link']));
		
		$logout_text = esc_attr(steed_theme_mod($prefix.'loginRegister_logout_text', $atr['std_logout_text']));
		$logout_link = esc_url(steed_theme_mod($prefix.'loginRegister_logout_link', $atr['std_logout_link']));
		$account_text = esc_attr(steed_theme_mod($prefix.'loginRegister_account_text', $atr['std_account_text']));
		$account_link = esc_url(steed_theme_mod($prefix.'loginRegister_account_link', $atr['std_account_link']));
		
		$before =$atr['before'];
		$after =$atr['after'];
		
		if($active == 'yes'){
			echo $before;
				echo '<div class="element_loginRegister">';
					if(is_user_logged_in()){
						echo '<a href="'.$account_link.'" class="element_loginRegister_account">'.$account_text.'</a>';
						echo '<span></span>';
						echo '<a href="'.$logout_link.'" class="element_loginRegister_logout">'.$logout_text.'</a>';
					}else{
						echo '<a href="'.$login_link.'" class="element_loginRegister_login">'.$login_text.'</a>';
						echo '<span></span>';
						echo '<a href="'.$register_link.'" class="element_loginRegister_register">'.$register_text.'</a>';
					}
				echo '</div>';
			echo $after;
		}
		
	}
endif;


if ( ! function_exists( 'steed_element_shoppingBag' ) ) :
	function steed_element_shoppingBag($prefix, $settings =array()) {
		$defualt = array(
			"std_active" => "yes",
			"std_tooltip" => "View your shopping cart",
			"std_title" => "Shopping Cart",
		);
		if(is_array($settings)){
			$atr = array_merge($defualt, $settings);
		}else{
			$atr = $defualt;
		}
	
		$active = esc_attr(steed_theme_mod($prefix.'shoppingBag_active', $atr['std_active']));
		$title = steed_theme_mod($prefix.'shoppingBag_title', $atr['std_title']);
		$tooltip = steed_theme_mod($prefix.'shoppingBag_tooltip', $atr['std_tooltip']);
		
		if ( class_exists( 'woocommerce' ) && ($active == 'yes') ) {
			 global $woocommerce;
			?>
            <div class="element_shoppingBag">
                <span class="screen-reader-text"><?php echo esc_attr($title); ?></span>
				<a class="cart-contents-steed" href="<?php echo wc_get_cart_url(); ?>">
                	<span class="element_shoppingBag_count">
					<?php echo sprintf ( _n( '%d <span class="screen-reader-text">item</span>', '%d <span class="screen-reader-text">items</span>', WC()->cart->get_cart_contents_count(), 'steed' ), WC()->cart->get_cart_contents_count() ); ?>
                    </span>
					<?php echo WC()->cart->get_cart_total(); ?>
               </a>
            </div>
            <?php
		}
	}
endif;
/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
add_filter('add_to_cart_fragments', 'steed_element_shoppingBag_fragment');
function steed_element_shoppingBag_fragment( $fragments ) {
    global $woocommerce;
    ob_start(); ?>
    
    <a class="cart-contents-steed" href="<?php echo wc_get_cart_url(); ?>">
                	<span class="element_shoppingBag_count">
					<?php echo sprintf ( _n( '%d <span class="screen-reader-text">item</span>', '%d <span class="screen-reader-text">items</span>', WC()->cart->get_cart_contents_count(), 'steed' ), WC()->cart->get_cart_contents_count() ); ?>
                    </span>
					<?php echo WC()->cart->get_cart_total(); ?>
               </a>

    <?php
    $fragments['a.cart-contents-steed'] = ob_get_clean();
    return $fragments;
}


if ( ! function_exists( 'steed_element_button' ) ) :
	function steed_element_button($prefix, $settings = array()) {
		$atr = array_merge(array(
			"class" => "",
			"before" => "",
			"after" => "",
			"std_active" => "yes",
			"std_link" => "#",
			"std_text" => "Sample Button",
			"std_icon" => "",
			"std_target" => "_self", //_blank, _self
		), $settings);
		
		$active = esc_attr(steed_theme_mod($prefix.'button_active', $atr['std_active']));
		$link = esc_attr(steed_theme_mod($prefix.'button_link', $atr['std_link']));
		$text = esc_attr(steed_theme_mod($prefix.'button_text', $atr['std_text']));
		$icon = esc_attr(steed_theme_mod($prefix.'button_icon', $atr['std_icon']));
		$target = esc_url(steed_theme_mod($prefix.'button_target', $atr['std_target']));
		
		$the_icon = ($icon != '') ? '<i class="fa '.$icon.'"></i>' : NULL;
		
		if($active == 'yes'){
			echo $atr['before'];
				echo '<a href="'.$link.'" class="element_button '.$atr['class'].'" target="'.$target.'">'.$the_icon.'<span>'.$text.'</span></a>';
			echo $atr['after'];
		}
		
	}
endif;


if ( ! function_exists( 'steed_element_footerWidgets' ) ) :
	function steed_element_footerWidgets($prefix, $settings) {
		$filter_settings = apply_filters('steed_element_footerWidgets_'.$prefix, array());
		
		$atr = array_merge(array(
			"class"				=> "",
			"in_class"			=> "",
			"std_active"		=> "yes",
			"std_layout"		=> "3/3/3/3",
			"std_layout_tab"	=> "6/6",
			"std_layout_mobile"	=> "12",
		), $settings);
		
		$atr = array_merge($atr, $filter_settings);
		
		$active = esc_attr(steed_theme_mod($prefix.'widgets_active', $atr['std_active']));
		$layout = esc_attr(steed_theme_mod($prefix.'widgets_layout', $atr['std_layout']));
		$layout_tab = esc_attr(steed_theme_mod($prefix.'widgets_layout_tab', $atr['std_layout_tab']));
		$layout_mobile = esc_attr(steed_theme_mod($prefix.'widgets_layout_mobile', $atr['std_layout_mobile']));
		
		$widget_1 = false;
		$widget_2 = false;
		$widget_3 = false;
		$widget_4 = false;
		$widget_1_col = '12';
		$widget_2_col = '12';
		$widget_3_col = '12';
		$widget_4_col = '12';
		$layout_array = explode("/", $layout);
		
		if(isset($layout_array[0])){ $widget_1 = true; $widget_1_col = $layout_array[0]; }
		if(isset($layout_array[1])){ $widget_2 = true; $widget_2_col = $layout_array[1]; }
		if(isset($layout_array[2])){ $widget_3 = true; $widget_3_col = $layout_array[2]; }
		if(isset($layout_array[3])){ $widget_4 = true; $widget_4_col = $layout_array[3]; }
		
		if($active == 'yes'):
			echo '<div class="element_widgets '.$atr['class'].'">';
				echo '<div class="element_widgets_in '.$atr['in_class'].' container-fluid">';
					echo '<div class="row">';
						if($widget_1){ 
							echo '<div class="col-md-'.$widget_1_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.' ">';
								dynamic_sidebar( $prefix.'widget_1' );
							echo '</div>';
						}
						if($widget_2){ 
							echo '<div class="col-md-'.$widget_2_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
								dynamic_sidebar( $prefix.'widget_2' );
							echo '</div>';
						}
						if($widget_3){ 
							echo '<div class="col-md-'.$widget_3_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
								dynamic_sidebar( $prefix.'widget_3' );
							echo '</div>';
						}
						if($widget_4){ 
							echo '<div class="col-md-'.$widget_4_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
								dynamic_sidebar( $prefix.'widget_4' );
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		endif;
	}
endif;


if ( ! function_exists( 'steed_element_footerWidgets_register' ) ) :
	function steed_element_footerWidgets_register($prefix, $settings) {
		$atr = array_merge(array(
			"class" => "",
			"in_class" => "",
		), $settings);
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'steed' ),
			'id'            => $prefix.'widget_1',
			'description'   => esc_html__( 'Add widgets here.', 'steed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'steed' ),
			'id'            => $prefix.'widget_2',
			'description'   => esc_html__( 'Add widgets here.', 'steed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'steed' ),
			'id'            => $prefix.'widget_3',
			'description'   => esc_html__( 'Add widgets here.', 'steed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'steed' ),
			'id'            => $prefix.'widget_4',
			'description'   => esc_html__( 'Add widgets here.', 'steed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
	}
endif;


if ( ! function_exists( 'steed_element_copyText' ) ) :
	function steed_element_copyText($prefix) {
		echo '<div class="copy_text">';
		echo  wp_kses_post(steed_theme_mod($prefix.'copytext', ''));
		echo '</div>';
	}
endif;



if ( ! function_exists( 'steed_element_creditText' ) ) :
	function steed_element_creditText() {
		$mod_show = esc_attr(steed_theme_mod('show_site_credit', 'yes'));
		
		if($mod_show == 'no'){
			echo '';
		}else{
			echo '<div class="credit_text">Theme Designed By <a href="'.esc_url('http://tallythemes.com').'" title="TallyThemes">TallyThemes</a> | Powered by <a href="'.esc_url('http://wordpress.org').'">WordPress</a></div>';	
		}
	}
endif;


if ( ! function_exists( 'steed_element_logo' ) ) :
	function steed_element_logo() {
		
		$output = '';
		$description = get_bloginfo( 'description', 'display' );
		$custom_logo_id = esc_attr(steed_theme_mod( 'custom_logo' ));
		$std_logo = apply_filters('steed_element_logo_url', NULL);
		
		// Try to retrieve the Custom Logo
		if (function_exists('get_custom_logo')){
			if($custom_logo_id){
				$output = get_custom_logo();
			}
		}
	
		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
		if ($output == ''){
			if ( is_front_page() && is_home() ){
				$output .= '<h1  class="site-title"><a href="' . esc_url(home_url('/')) . '" class="hc_text">'.get_bloginfo( 'name' ).'</a></h1>';
			}else{
				$output .= '<p  class="site-title"><a href="' . esc_url(home_url('/')) . '" class="hc_text">'.get_bloginfo( 'name' ).'</a></p>';
			}
			if ( $description || is_customize_preview() ){
				$output .= '<p  class="site-description">'.$description.'</p>';
			}
			
			if($std_logo != NULL){
				$output = '<a href="' . esc_url(home_url('/')) . '"><img src="'.esc_url($std_logo).'" alt="'.get_bloginfo( 'name' ).'"></a>';
			}
		}
		
		/*Validating using wp_kses as the output contain images and h1 tags*/
		echo wp_kses($output, wp_kses_allowed_html( 'post' ));
	}
endif;


if ( ! function_exists( 'steed_element_pageHeading' ) ) :
	function steed_element_pageHeading() {
		if(class_exists( 'woocommerce' )){
			if(is_woocommerce()){
				echo '<h1 class="entry-title">';
					woocommerce_page_title();	
				echo '</h1>';
			}else{
				the_title( '<h1 class="entry-title">', '</h1>' );
			}
		}elseif(is_search()){
			?>
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'steed' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			<?php
		}elseif(is_single()){
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo '<div class="entry-meta">';
				steed_posted_on();
			echo '</div>';
		}elseif(is_archive()){
			the_archive_title('<h1 class="entry-title">', '</h1>');
		}elseif(is_home()){
			if(steed_theme_mod( 'subheader_blog_title' ) != '' ){ echo '<h1 class="entry-title">'.esc_attr(steed_theme_mod( 'subheader_blog_title', 'Our Blog')).'</h1>'; }
			if(steed_theme_mod( 'subheader_blog_subtitle' ) != '' ){ echo '<div class="entry-meta">'.esc_attr(steed_theme_mod( 'subheader_blog_subtitle' , 'See what we are writting.')).'</div>'; }
		}else{
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
	}
endif;


if ( ! function_exists( 'steed_element_colorMood' ) ) :
	function steed_element_colorMood($prefix, $settings = array()) {
		$atr = array_merge(array(
			"std_mood" => "",
		), $settings);
		
		$std_color_mood = apply_filters('steed_element_colorMood_'.$prefix, $atr['std_mood']);
		$color_mood = esc_attr(steed_theme_mod( $prefix.'colorMood' ));
		
		if($color_mood == ''){ $color_mood = $std_color_mood; }
		
		return 'color-'.$color_mood;
	}
endif;