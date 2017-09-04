<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Steed
 */
get_header();
	steed_site_header();
	
	if(!is_page_template()){
		
		steed_before_site_content(array('class' => 'full-width no-sidebar'));
			steed_before_primary_content();
				do_action('steed_pc_html_home_page');
			steed_after_primary_content();
		steed_after_site_content();
		
	}else{
		
		steed_before_site_content(array('in_class' => 'container-width'));
			steed_before_primary_content();
				do_action('steed_content_index');
			steed_after_primary_content();
			get_sidebar();
		steed_after_site_content();
		
	}
	
	steed_site_footer();
get_footer();