<?php
if(!class_exists('steed_pc_section_page_content')):
	class steed_pc_section_page_content{
		public $uid;
		public $section_id;
		public $panel_id;
		public $section_title;
		public $section_priority;
		
		function __construct($settings, $config){
			$default = array(
				'content' => 'full', //full,none,excerpt
				'image' => 'background', //none, top, bottom, left, right, full_left, full_right, background
				'image_size' => 'full',
				'title' => true, //true, false
				'title_tag' => 'h2',
				'button' => false, //true, false
				'button_text' => 'Read More',
				'css_class' => '',
			);
			$this->settings =array_merge($default, $settings);
			
			$this->uid = $config['uid'];
			$this->section_id = $config['section_id'];
			$this->panel_id = $config['panel_id'];
			$this->section_title = $config['section_title'];
			$this->section_priority = $config['section_priority'];
		}
		
		
		
		function html(){
			$settings = $this->settings;
			$page_id =  steed_theme_mod($this->uid.'_page_id');
			$the_query = new WP_Query( array('post_type' => 'page', 'post__in' => array($page_id)) );
			
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) { $the_query->the_post();
					if(steed_theme_mod($this->uid.'_disable') == false):
					
						if(steed_theme_mod($this->uid.'_color_mood') != ''){
							$color_mood = 'color-'.esc_attr(steed_theme_mod($this->uid.'_color_mood'));
						}else{
							$color_mood = 'color-dark';
						}
						
						$text_align = 'pc-text-align-'.steed_theme_mod($this->uid.'_text_align');
						
						
						echo '<section class="steed_pc_section pc_section_page_content '.$this->uid.' '.$settings['css_class'].' '.$color_mood.' pc-content-'.$settings['content'].' pc-title-'.$settings['title'].' pc-image-'.$settings['image'].' pc-button-'.$settings['button'].' '.esc_attr($text_align).'">';
							echo '<div class="steed_pc_section_in">';
								if(($settings['image'] != 'none') && ($settings['image'] != 'background') && (($settings['image'] == 'top') || ($settings['image'] == 'left')) ){
									echo '<div class="pc_image">';
										echo '<div class="pc_image_in">';
											echo get_the_post_thumbnail(get_the_ID(), $settings['image_size']);
										echo '</div>';
									echo '</div>';
								}
								if(($settings['image'] != 'none') && ($settings['image'] != 'background') && (($settings['image'] == 'full_left')) ){
									echo '<div class="pc_image" style="background-image:url('.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ).');">';
										echo '<div class="pc_image_in">';
											echo '<p>&nbsp;</p>';
										echo '</div>';
									echo '</div>';
								}
								if(($settings['content'] != 'none') || ($settings['title'] == true) || ($settings['button'] == true)){
									echo '<div class="pc_content">';
										echo '<div class="pc_content_in">';
											if($settings['title'] == true){
												echo '<'.$settings['title_tag'].'>';the_title(); echo '</'.$settings['title_tag'].'>';
											}
											if($settings['content'] == 'full'){
												//echo wp_kses_post(apply_filters( 'the_content', $post->post_content ));
												the_content(true, false);
											}elseif($settings['content'] == 'excerpt'){
												$the_post = get_post();
												if(strpos($the_post->post_content, '<!--more-->')){
													the_content(true, false);
												}else{
													the_excerpt();
												}
											}
											if($settings['button'] == true){
												if(steed_theme_mod($this->uid.'_disable_button') == false){
													echo '<div class="clear"></div><a href="'.esc_url( get_permalink(get_the_ID()) ).'" class="pc-button">';
														
															if(steed_theme_mod($this->uid.'_button_text') != ''){
																echo wp_kses_post( steed_theme_mod($this->uid.'_button_text') );
															}else{
																echo wp_kses_post($settings['button_text']);
															}
														
													echo '</a>';
												}
											}
										echo '</div>';
									echo '</div>';
								}
								if(($settings['image'] != 'none') && ($settings['image'] != 'background') && (($settings['image'] == 'bottom') || ($settings['image'] == 'right')) ){
									echo '<div class="pc_image">';
										echo '<div class="pc_image_in">';
											echo get_the_post_thumbnail(get_the_ID(), $settings['image_size']);
										echo '</div>';
									echo '</div>';
								}
								if(($settings['image'] != 'none') && ($settings['image'] != 'background') && (($settings['image'] == 'full_right')) ){
									echo '<div class="pc_image" style="background-image:url('.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ).');">';
										echo '<div class="pc_image_in">';
											echo '<p>&nbsp;</p>';
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</section>';
					endif;
				}
			}
			wp_reset_postdata();
		}
		
		function get_the_excerpt($post_id) {
			global $post;  
			$save_post = $post;
			$post = get_post($post_id);
		 	the_excerpt();
			$post = $save_post;
		}
		function get_the_content($post_id) {
			global $post;  
			$save_post = $post;
			$post = get_post($post_id);
		 	the_content(true, false);
			$post = $save_post;
		}
		
		
		
		function css(){
			$settings = $this->settings;
			$page_id =  steed_theme_mod($this->uid.'_page_id');
			$post   = get_post( $page_id );
			
			$bg_color =  steed_theme_mod($this->uid.'_bg_color');
			$bg_overlay =  steed_theme_mod($this->uid.'_bg_overlay_color');
			$bg_repeat =  steed_theme_mod($this->uid.'_bg_repeat');
			$bg_attachment =  steed_theme_mod($this->uid.'_bg_attachment');
			$bg_position =  steed_theme_mod($this->uid.'_bg_position');
			$bg_size =  steed_theme_mod($this->uid.'_bg_size');
			
			$padding_top =  steed_theme_mod($this->uid.'_padding_top');
			$padding_bottom =  steed_theme_mod($this->uid.'_padding_bottom');
			$padding_top_t =  steed_theme_mod($this->uid.'_padding_top_t');
			$padding_bottom_t =  steed_theme_mod($this->uid.'_padding_bottom_t');
			$padding_top_m =  steed_theme_mod($this->uid.'_padding_top_m');
			$padding_bottom_m =  steed_theme_mod($this->uid.'_padding_bottom_m');
			$content_width =  steed_theme_mod($this->uid.'_content_width');
			$text_align = steed_theme_mod($this->uid.'_text_align');
			
			$image =  wp_get_attachment_url( get_post_thumbnail_id($page_id) );
			
			ob_start();
				if(($settings['image'] != 'none') && ($settings['image'] == 'background') && (($bg_repeat != '') || ($bg_attachment != '') || ($bg_position != '') || ($bg_size != '') || ($image != ''))){
					echo '.'.$this->uid.'{'; 
						if($image != ''){ echo 'background-image:url('.esc_url( $image ).');'; }
						if($bg_repeat != ''){ echo 'background-repeat:'.esc_attr($bg_repeat).';'; }
						if($bg_attachment != ''){ echo 'background-attachment:'.esc_attr($bg_attachment).';'; }
						if($bg_position != ''){ echo 'background-position:'.esc_attr($bg_position).';'; }
						if($bg_size != ''){ echo 'background-size:'.esc_attr($bg_size).';'; }
					echo '}';
				}
				
				if($bg_color != ''){
					echo '.'.$this->uid.'{'; 
						echo 'background-color:'.steed_sanitize_rgba($bg_color).';';
					echo '}';
				}
				
				if($content_width != ''){
					echo '.'.$this->uid.' .pc_content{'; 
						echo 'max-width:'.esc_attr($content_width).';';
						if($text_align == 'left'){
							echo 'float:left;';
						}
						if($text_align == 'right'){
							echo 'float:right;';
						}
						if($text_align == 'center'){
							echo 'margin:0 auto;';
						}
					echo '}';
				}
				
				if(($settings['image'] == 'top')|| ($settings['image'] == 'left')|| ($settings['image'] == 'right')|| ($settings['image'] == 'bottom') || ($settings['image'] == 'none') || ($settings['image'] == 'background')){
					$padding_selector = '.'.$this->uid;	
				}else{
					$padding_selector = '.'.$this->uid.' .pc_content';	
				}
				
				if(($padding_top != '') || ($padding_bottom != '')){
					
					echo $padding_selector.'{'; 
						if($padding_top != ''){ echo 'padding-top:'.esc_attr($padding_top).';'; }
						if($padding_bottom != ''){ echo 'padding-bottom:'.esc_attr($padding_bottom).';'; }
					echo '}';
				}
				if(($padding_top_t != '') || ($padding_bottom_t != '')){
					echo '@media (max-width: 992px) {';
						echo $padding_selector.'{'; 
							if($padding_top_t != ''){ echo 'padding-top:'.esc_attr($padding_top_t).';'; }
							if($padding_bottom_t != ''){ echo 'padding-bottom:'.esc_attr($padding_bottom_t).';'; }
						echo '}';
					echo '}';
				}
				if(($padding_top_m != '') || ($padding_bottom_m != '')){
					echo '@media (max-width: 768px) {';
						echo $padding_selector.'{'; 
							if($padding_top_m != ''){ echo 'padding-top:'.esc_attr($padding_top_m).';'; }
							if($padding_bottom_m != ''){ echo 'padding-bottom:'.esc_attr($padding_bottom_m).';'; }
						echo '}';
					echo '}';
				}			
				
				if($bg_overlay != ''){
					echo '.'.$this->uid.':after{';
						echo 'background-color:'.steed_sanitize_rgba($bg_overlay).';';
					echo '}';
				}
				
			$output = ob_get_contents();
			ob_end_clean();
			
			return 	$output;
		}
		
		
		function js(){
			$settings = $this->settings;
			
		}
		
		
		function customize($wp_customize){
			$settings = $this->settings;
			
			$wp_customize->add_section( $this->section_id , array(
				'title'		=> $this->section_title,
				'priority'	=> $this->section_priority,
				'panel'		=> $this->panel_id,
			));
			
			$uid = $this->uid.'_disable';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => 'Disable '.$this->section_title,
				'section'    => $this->section_id,
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
			));
			
			$uid = $this->uid.'_page_id';
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Select a Page', 'steed'),
				'section'    => $this->section_id,
				'settings'   => $uid,
				'type'       => 'dropdown-pages',
				'description' => '',
			));
			
			
			$section_id = $this->section_id;
			$the_uid = $this->uid;
			do_action('steed_pc_section_page_content', $wp_customize, $section_id, $the_uid, $settings );

			return $wp_customize;
			
		}
	}
endif;