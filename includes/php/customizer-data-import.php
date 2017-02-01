<?php
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
		}
	}
	
	//echo '$free_was_installed: '.$free_data_imported.'<br>';
	//echo '$pro_data_imported: '.$pro_data_imported.'<br>';
	//echo '$free_data_imported: '.$free_data_imported.'<br>';
}
add_action("after_switch_theme", "steed_customizer_data_import_init");