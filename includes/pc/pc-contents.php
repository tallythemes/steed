<?php
function steed_pc_mod_button($prefix, $link, $text){
	$button1_class = 'pc-btn';
	if(steed_theme_mod($prefix.'_button_style_size')){ $button1_class .= ' pc-btn-'.steed_theme_mod($prefix.'_button_style_size'); }
	if(steed_theme_mod($prefix.'_button_style_radius')){ $button1_class .= ' pc-btn-'.steed_theme_mod($prefix.'_button_style_radius'); }
	if(steed_theme_mod($prefix.'_button_style_color') && steed_theme_mod($prefix.'_button_style_style')){ 
		$button1_class .= ' pc-btn-'.steed_theme_mod($prefix.'_button_style_style').'-'.steed_theme_mod($prefix.'_button_style_color').''; 
	}
	
	echo '<a href="'.esc_url( $link ).'" class="'.$button1_class.'">'.$text.'</a>';
}
class steed_pc_mod_map{
	
	
	static function customizer($wp_customize, $section_id, $prefix){
		$uid = $prefix.'_map_code';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'steed_wp_kses', 'transport' => 'refresh',));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Google Map Code', 'steed'),
			'section'    => $section_id,
			'settings'   => $uid,
			'type'       => 'textarea',
			'description' => '',
		));
		$uid = $prefix.'_map_height';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh',));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Map Height', 'steed'),
			'section'    => $section_id,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => '',
		));
	}
	
	
	static function html($prefix){
		$map_code =  steed_theme_mod($prefix.'_map_code');
		$map_height =  steed_theme_mod($prefix.'_map_height');
		?>
        <div class="steed_pc_mod_map">
        	<?php echo $map_code; ?>
        </div>
        <?php
	}
	
	
	static function css(){
		
	}
	
}



class steed_pc_mod_page{
	
	
	static function customizer($wp_customize, $section_id, $prefix){
		$uid = $prefix.'_page_id';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh',));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Select a Page', 'steed'),
			'section'    => $section_id,
			'settings'   => $uid,
			'type'       => 'dropdown-pages',
			'description' => '',
		));
		
		if(function_exists('steedPRO_pc_mod_customize_page')){
			steedPRO_pc_mod_customize_page($wp_customize, $section_id, $prefix);
		}
		
		return $wp_customize;
	}
	
	
	static function html($prefix){
		$page_id =  steed_theme_mod($prefix.'_page_id');
		$title =  steed_theme_mod($prefix.'_title');
		$button =  steed_theme_mod($prefix.'_button');
		$button_text =  steed_theme_mod($prefix.'_button_text');
		
		$the_query = new WP_Query( array('post_type' => 'page', 'post__in' => array($page_id)) );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) { $the_query->the_post();
				$the_post = get_post();
				?>
				<div class="steed_pc_mod_page">
                	<?php if($title == true): ?>
						<h2><?php the_title(); ?></h2>
                    <?php endif; ?>
                    <article>
						<?php
                            if(strpos($the_post->post_content, '<!--more-->')){
                                the_content(true, false);
								if($button == true){
									steed_pc_mod_button($prefix, get_permalink(get_the_ID()), $button_text); 
								}
                            }else{
                                the_content();
								
                            }
							
                        ?>
                    </article>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
	}

	
	static function css(){
		
	}

}