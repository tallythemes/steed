<?php
if(!class_exists('steed_pc_2_columns')):
	class steed_pc_2_columns{
		public $uid;
		public $section_id;
		public $panel_id;
		public $section_title;
		public $section_priority;
		public $settings;

		
		function __construct($settings, $config){
			$default = array(
				'div_class'			=> '',
				'div_id'			=> '',
				
				'row_bg'			=> false, //true, false
				'row_width'			=> false, //true, false,
				'row_padding'		=> false, //true, false
				'row_margin'		=> false, //true, false
				'row_columns'		=> false, //true, false
				
				'left'				=> true, //true, false
				'left_title'		=> 'Left',
				'left_bg'			=> false, //true, false
				'left_content'		=> 'page', //page, map
				'left_color_mood'	=> false, //true, false
				'left_bg_full'		=> false, //true, false
				'left_full_content' => false, //true, false
				'left_padding'		=> false, //true, false
				'left_description'	=> false, //true, false
				'left_text_align'	=> false, //true, false
				
				'right'				=> true, //true, false
				'right_title'		=> 'Right',
				'right_bg'			=> false, //true, false
				'right_content'		=> 'page', //page, map
				'right_color_mood'	=> false, //true, false
				'right_bg_full'		=> false, //true, false
				'right_full_content' => false, //true, false
				'right_padding'		=> false, //true, false
				'right_description' => false, //true, false
				'right_text_align'	=> false, //true, false
			);
			$this->settings =array_merge($default, $settings);
			
			$this->uid = $config['uid'];
			$this->section_id = $config['section_id'];
			$this->panel_id = $config['panel_id'];
			$this->section_title = $config['section_title'];
			$this->section_priority = $config['section_priority'];
			
			$this->settings['uid'] = $config['uid'];
			$this->settings['section_id'] = $config['section_id'];
			$this->settings['panel_id'] = $config['panel_id'];
			$this->settings['section_title'] = $config['section_title'];
			$this->settings['section_priority'] = $config['section_priority'];
		}
		
		
		function html(){
			$settings = $this->settings;
			$enable = steed_theme_mod($settings['uid'].'_enable');
			
			$left_full_bg		= $settings['left_bg_full'];	
			$left_full_content	= $settings['left_full_content'];
			$right_full_bg		= $settings['right_bg_full'];	
			$right_full_content = $settings['right_full_content'];
			
			$right_color_mood = (steed_theme_mod($settings['uid'].'_right_color_mood') != '') ? 'color-'.steed_theme_mod($settings['uid'].'_right_color_mood') : NULL;
			$left_color_mood = (steed_theme_mod($settings['uid'].'_left_color_mood') != '') ? 'color-'.steed_theme_mod($settings['uid'].'_left_color_mood') : NULL;
			
			$row_columns = (steed_theme_mod($settings['uid'].'_row_columns') != '') ? explode(',', steed_theme_mod($this->uid.'_row_columns')) : array(6,6);
			
			
			if(($settings['row_columns'] == true) && ($settings['left'] == true) && ($settings['right'] == true)){
				$left_col_size = $row_columns[0];
				$right_col_size = $row_columns[1];
			}elseif(($settings['row_columns'] == false) && ($settings['left'] == true) && ($settings['right'] == true)){
				$left_col_size = '6';
				$right_col_size = '6';
			}else{
				$left_col_size = '12';
				$right_col_size = '12';
			}
			
			$text_align_left_col = (steed_theme_mod($settings['uid'].'_left_text_align') != '') ? 'pc-text-align-'.steed_theme_mod($settings['uid'].'_left_text_align') : NULL;
			$text_align_left_col .= (steed_theme_mod($settings['uid'].'_left_text_align_t') != '') ? ' pc-text-align-t-'.steed_theme_mod($settings['uid'].'_left_text_align_t') : NULL;
			$text_align_left_col .= (steed_theme_mod($settings['uid'].'_left_text_align_m') != '') ? ' pc-text-align-m-'.steed_theme_mod($settings['uid'].'_left_text_align_m') : NULL;
			
			$text_align_right_col = (steed_theme_mod($settings['uid'].'_right_text_align') != '') ? 'pc-text-align-'.steed_theme_mod($settings['uid'].'_right_text_align') : NULL;
			$text_align_right_col .= (steed_theme_mod($settings['uid'].'_right_text_align_t') != '') ? ' pc-text-align-t-'.steed_theme_mod($settings['uid'].'_right_text_align_t') : NULL;
			$text_align_right_col .= (steed_theme_mod($settings['uid'].'_right_text_align_m') != '') ? ' pc-text-align-m-'.steed_theme_mod($settings['uid'].'_right_text_align_m') : NULL;
			
			
			
			if($enable == false):
				?>
                <section class="pc-section pc-section-2-column <?php echo $settings['uid']; ?>">
                	<div class="steed_pc_section_in">
                    	<div class="row pc-flex pc-2colsection-row">
                        	<?php
                            if($settings['left'] == true){
								if($left_full_content == true){
									echo '<div class="col-md-'.$left_col_size.' '.esc_attr($left_color_mood).' '.esc_attr($text_align_left_col).' pc-2colsection-left pc-follow-height" data-follow=".'.$settings['uid'].' .pc-2colsection-left-content-in">';
										echo '<div class="pc-2colsection-content pc-2colsection-left-content pc-bg-full"  data-aline="left" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in">';
											echo '<div class="pc-2colsection-left-content-in">';
												if($settings['left_description'] == true){
													$this->html_description($settings['uid'].'_left');
												}
												$this->left_html_inner();
											echo '</div>';
										echo '</div>';
										if($settings['left_bg'] == true){
											if($left_full_bg == true){
												echo '<div class="pc-2colsection-bg pc-bg-full pc-2colsection-bg-left" data-aline="left" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg pc-2colsection-bg-left"></div>';
											}
										}
									echo '</div>';
								}else{
									echo '<div class="col-md-'.$left_col_size.' '.esc_attr($left_color_mood).' '.esc_attr($text_align_left_col).' pc-2colsection-left">';
										echo '<div class="pc-2colsection-content pc-2colsection-left-content">';
											if($settings['left_description'] == true){
												$this->html_description($settings['uid'].'_left');
											}
											$this->left_html_inner();
										echo '</div>';
										if($settings['left_bg'] == true){
											if($left_full_bg == true){
												echo '<div class="pc-2colsection-bg pc-bg-full pc-2colsection-bg-left" data-aline="left" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg pc-2colsection-bg-left"></div>';
											}
										}
									echo '</div>';
								}
							}
							
							if($settings['right'] == true){
								if($right_full_content == true){
									echo '<div class="col-md-'.$right_col_size.' '.esc_attr($right_color_mood).' '.esc_attr($text_align_right_col).' pc-2colsection-right pc-follow-height" data-follow=".'.$settings['uid'].' .pc-2colsection-right-content-in">';
										echo '<div class="pc-2colsection-content pc-2colsection-right-content pc-bg-full"  data-aline="right" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in">';
											echo '<div class="pc-2colsection-right-content-in">';
												if($settings['right_description'] == true){
													$this->html_description($settings['uid'].'_right');
												}
												$this->right_html_inner();
											echo '</div>';
										echo '</div>';
										if($settings['right_bg'] == true){
											if($right_full_bg == true){
												echo '<div class="pc-2colsection-bg pc-2colsection-bg-right pc-bg-full" data-aline="right" data-size="'.$right_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg pc-2colsection-bg-right"></div>';
											}
										}
									echo '</div>';
								}else{
									echo '<div class="col-md-'.$right_col_size.' '.esc_attr($right_color_mood).' '.esc_attr($text_align_right_col).' pc-2colsection-right">';
										echo '<div class="pc-2colsection-content pc-2colsection-right-content">';
											if($settings['right_description'] == true){
												$this->html_description($settings['uid'].'_right');
											}
											$this->right_html_inner();
										echo '</div>';
										if($settings['right_bg'] == true){
											if($right_full_bg == true){
												echo '<div class="pc-2colsection-bg pc-bg-full pc-2colsection-bg-right" data-aline="right" data-size="'.$right_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg pc-2colsection-bg-right"></div>';
											}
										}
									echo '</div>';
								}
							}
							
							?>
                        </div>
                    </div>
                    <span class="pc-bg-overlay"></span>
                </section>
                <?php
			endif;		
			
		}
		
		
		function html_description($the_uid){
			$title	= steed_theme_mod($the_uid.'_description_title');
			$des	= steed_theme_mod($the_uid.'_description_text');
			if(($title != '') || ($des != '')){
				echo '<div class="pc-2colsection-description">';
					if($title != ''){
						echo '<h2>'.wp_kses_post($title).'</h2>';	
					}
					if($des != ''){
						echo '<div class="pc-2colsection-description-text">'.wp_kses_post($des).'</div>';
					}
				echo '</div>';
			}
		}
		
	
		
		
		
		function css(){
			$settings = $this->settings;
			$left_full_bg		= steed_theme_mod($settings['uid'].'_left_full_bg');	
			$left_full_content	= steed_theme_mod($settings['uid'].'_left_full_content');
			$right_full_bg		= steed_theme_mod($settings['uid'].'_right_full_bg');	
			$right_full_content = steed_theme_mod($settings['uid'].'_right_full_content');

			ob_start();
				if($settings['left_bg'] == true){
					$this->css_background($settings['uid'].'_left', '.'.$settings['uid'].' .pc-2colsection-bg-left');
				}
				if($settings['right_bg'] == true){
					$this->css_background($settings['uid'].'_right', '.'.$settings['uid'].' .pc-2colsection-bg-right');
				}
				if($settings['left_padding'] == true){
					if($left_full_content == true){
						$this->css_padding($settings['uid'].'_left', '.'.$settings['uid'].' .pc-2colsection-left-content-in');
					}else{
						$this->css_padding($settings['uid'].'_left', '.'.$settings['uid'].' .pc-2colsection-left-content');
					}
				}
				if($settings['right_padding'] == true){
					if($right_full_content == true){
						$this->css_padding($settings['uid'].'_right', '.'.$settings['uid'].' .pc-2colsection-right-content-in');
					}else{
						$this->css_padding($settings['uid'].'_right', '.'.$settings['uid'].' .pc-2colsection-right-content');
					}
				}
				
				if($settings['row_bg'] == true){
					$this->css_background($settings['uid'].'_row', '.'.$settings['uid']);
				}
				if($settings['row_padding'] == true){
					$this->css_padding($settings['uid'].'_row', '.'.$settings['uid']);
				}
				if($settings['row_margin'] == true){
					$this->css_margin($settings['uid'].'_row', '.'.$settings['uid']);
				}
				if($settings['row_width'] == true){
					$this->css_content_width($settings['uid'].'_row', '.'.$settings['uid'].' .steed_pc_section_in');
				}
				
				
				$this->left_css_inner();
				$this->right_css_inner();
				
			$output = ob_get_contents();
			ob_end_clean();
			
			return 	$output;
		}
		
		
		function js(){
			$settings = $this->settings;
			
			$this->left_js_inner();
			$this->right_js_inner();
			
		}
		
		
		function customize($wp_customize){
			$settings = $this->settings;
			
			$wp_customize->add_section( $settings['section_id'] , array(
				'title'		=> $settings['section_title'],
				'priority'	=> $settings['section_priority'],
				'panel'		=> $settings['panel_id'],
			));
			
			$uid = $settings['uid'].'_disable';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => 'Disable '.$settings['section_title'],
				'section'    => $settings['section_id'],
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
			));
			
			/*
				Left Column Content
			--------------------------------*/
			if($settings['left'] == true){
				$uid = $settings['uid'].'_left_content_head';
				$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
				$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
					'label'      => $settings['left_title'].' Content',
					'section'    => $settings['section_id'],
					'settings'   => $uid,
					'description' => '',
				)));
				
				if($settings['left_description'] == true){
					$this->customizer_description($wp_customize, $settings['uid'].'_left', $settings['section_id'], $settings['left_title'].' Background');
				}
				
				$this->left_customize_inner($wp_customize);
				
				
			}
			
			
			/*
				Right Column Content
			--------------------------------*/
			if($settings['right'] == true){
				$uid = $settings['uid'].'_right_content_head';
				$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
				$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
					'label'      => $settings['right_title'].' Content',
					'section'    => $settings['section_id'],
					'settings'   => $uid,
					'description' => '',
				)));
				
				if($settings['right_description'] == true){
					$this->customizer_description($wp_customize, $settings['uid'].'_right', $settings['section_id'], '');
				}
				
				$this->right_customize_inner($wp_customize);
				
				
				
			}
			
			
			/*
				Left Column Settings
			--------------------------------*/
			if(($settings['left'] == true) && ( ($settings['left_bg'] == true) || ($settings['left_padding'] == true) || ($settings['left_text_align'] == true) || ($settings['left_color_mood'] == true) )){
				$uid = $settings['uid'].'_left_settings_head';
				$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
				$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
					'label'      => $settings['left_title'].' Settings',
					'section'    => $settings['section_id'],
					'settings'   => $uid,
					'description' => '',
				)));
				
				/*-- Left BG --*/
				if($settings['left_bg'] == true){
					$this->customizer_background($wp_customize, $settings['uid'].'_left', $settings['section_id'], $settings['left_title'].' Background');
				}
				
				/*-- Left Padding --*/
				if($settings['left_padding'] == true){
					$this->customizer_padding($wp_customize, $settings['uid'].'_left', $settings['section_id'], $settings['left_title'].' Padding');
				}
				
				/*-- Left Text Align --*/
				if($settings['left_text_align'] == true){
					$this->customizer_text_align($wp_customize, $settings['uid'].'_left', $settings['section_id'], $settings['left_title'].' Text Align');
				}
				
				if($settings['left_color_mood'] == true){
					$this->customizer_color_mood($wp_customize, $settings['uid'].'_left', $settings['section_id'], '');
				}
				
				/*-- Left Full BG --*/
				/*if(($settings['left_bg_full'] == true) && ($settings['left_bg'] == true)){
					$this->customizer_full_bg($wp_customize, $settings['uid'].'_left', $settings['section_id'], $settings['left_title']);
				}*/
				
				/*-- Left Full Content --*/
				/*if($settings['left_full_content'] == true){
					$this->customizer_full_content($wp_customize, $settings['uid'].'_left', $settings['section_id'], $settings['left_title']);
				}*/
			}
			
			
			/*
				Right Column Settings
			--------------------------------*/
			if(($settings['right'] == true) && ( ($settings['right_bg'] == true) || ($settings['right_padding'] == true) || ($settings['right_text_align'] == true) || ($settings['right_color_mood'] == true) )){
				$uid = $settings['uid'].'_right_settings_head';
				$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
				$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
					'label'      => $settings['right_title'].' Settings',
					'section'    => $settings['section_id'],
					'settings'   => $uid,
					'description' => '',
				)));
				
				/*-- Right BG --*/
				if($settings['right_bg'] == true){
					$this->customizer_background($wp_customize, $settings['uid'].'_right', $settings['section_id'], $settings['right_title'].' Background');
				}
				
				/*-- Right Padding --*/
				if($settings['right_padding'] == true){
					$this->customizer_padding($wp_customize, $settings['uid'].'_right', $settings['section_id'], $settings['right_title'].' Padding');
				}
				
				/*-- Right Text Align --*/
				if($settings['right_text_align'] == true){
					$this->customizer_text_align($wp_customize, $settings['uid'].'_right', $settings['section_id'], $settings['right_title'].' Text Align');
				}
				
				if($settings['right_color_mood'] == true){
					$this->customizer_color_mood($wp_customize, $settings['uid'].'_right', $settings['section_id'], '');
				}
				
				/*-- Right Full BG --*/
				/*if(($settings['right_bg_full'] == true) && ($settings['right_bg'] == true)){
					$this->customizer_full_bg($wp_customize, $settings['uid'].'_right', $settings['section_id'], $settings['right_title']);
				}*/
				
				/*-- Right Full Content --*/
				/*if($settings['right_full_content'] == true){
					$this->customizer_full_content($wp_customize, $settings['uid'].'_right', $settings['section_id'], $settings['right_title']);
				}*/
			}
			
			
			/*
				Section Settings
			--------------------------------*/
			if(($settings['row_bg'] == true) || ($settings['row_width'] == true) || ($settings['row_padding'] == true) || ($settings['row_columns'] == true)){
				$uid = $settings['uid'].'_row_settings_head';
				$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
				$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
					'label'      => 'Section Settings',
					'section'    => $settings['section_id'],
					'settings'   => $uid,
					'description' => '',
				)));
				
				/*-- ROW BG --*/
				if($settings['row_bg'] == true){
					$this->customizer_background($wp_customize, $settings['uid'].'_row', $settings['section_id'], 'Section Background');
				}
				
				/*-- Row Content Width --*/
				if($settings['row_width'] == true){
					$this->customizer_content_width($wp_customize, $settings['uid'].'_row', $settings['section_id'], 'Section Content Width');
				}
				
				/*-- Row Padding --*/
				if($settings['row_padding'] == true){
					$this->customizer_padding($wp_customize, $settings['uid'].'_row', $settings['section_id'], 'Section Padding');
				}
				
				/*-- Row Margin --*/
				if($settings['row_margin'] == true){
					$this->customizer_margin($wp_customize, $settings['uid'].'_row', $settings['section_id'], 'Section Margin');
				}
				
				/*-- Row Column --*/
				if(($settings['row_columns'] == true) && ($settings['left'] == true) && ($settings['right'] == true)){
					$this->customizer_row_columns($wp_customize, $settings['uid'].'_row', $settings['section_id'], '');
				}
			}/*END of Section Settings */
			
			
			return $wp_customize;
			
		}
		
		
		function customizer_background($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_bg_header';
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
				'label'      => $title,
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'tabs' => true,
				'tab_1' => array($the_uid.'_bg_image'),
				'tab_2' => array($the_uid.'_bg_color', $the_uid.'_bg_overlay_color'),
				'tab_3' => array($the_uid.'_bg_repeat', $the_uid.'_bg_attachment', $the_uid.'_bg_position', $the_uid.'_bg_size'),
				'tab_4' => NULL,
				'tab_titles' => array('Image', 'Color', 'Others', 'NULL'),
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_bg_image';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'esc_url', 'transport' => 'refresh'));
			$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $uid, array(
				'label'      => __('Background Image', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_bg_color';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'steed_sanitize_rgba', 'transport' => 'refresh'));
			$wp_customize->add_control(new steed_Customize_Alpha_Color_Control($wp_customize, $uid, array(
				'label'      => __('Background Color', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'priority'	=> $priority,
			)));
	
			$uid = $the_uid.'_bg_overlay_color';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field','transport' => 'refresh' ));
			$wp_customize->add_control(new steed_Customize_Alpha_Color_Control($wp_customize, $uid, array(
				'label'      => __('Background Overlay Color', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_bg_repeat';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Background Repeat', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'choices' => array(
					'' => 'none',
					'no-repeat' => 'no-repeat',
					'repeat-x' => 'repeat-x',
					'repeat-y' => 'repeat-y',
				),
				'priority'	=> $priority,
			));
					
			$uid = $the_uid.'_bg_attachment';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field','transport' => 'refresh' ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Background Attachment', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'choices' => array(
					'' => 'none',
					'fixed' => 'fixed',
					'inherit' => 'inherit',
				),
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_bg_position';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Background Position', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'choices' => array(
					'' => 'none',
					'center center' => 'center center',
					'center top' => 'center top',
					'center bottom' => 'center bottom',
					'left top' => 'left top',
					'left bottom' => 'left bottom',
					'right top' => 'right top',
					'right bottom' => 'right bottom',
					'left center' => 'left center',
					'right center' => 'right center',
				),
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_bg_size';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Background Size', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'choices' => array(
					'' => 'none',
					'cover' => 'cover',
					'contain' => 'contain',
				),
				'priority'	=> $priority,
			));
			
			return $wp_customize;
		}
		
		
		function customizer_padding($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_padding_header';
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
				'label'      => $title,
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'tabs' => true,
				'tab_1' => array($the_uid.'_padding_top', $the_uid.'_padding_bottom' , $the_uid.'_padding_left', $the_uid.'_padding_right'),
				'tab_2' => array($the_uid.'_padding_top_t', $the_uid.'_padding_bottom_t', $the_uid.'_padding_left_t', $the_uid.'_padding_right_t'),
				'tab_3' => array($the_uid.'_padding_top_m', $the_uid.'_padding_bottom_m', $the_uid.'_padding_left_m', $the_uid.'_padding_right_m'),
				'tab_4' => NULL,
				'tab_titles' => array('Desktop', 'Tab', 'Mobile', 'NULL'),
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_padding_top';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Top', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_bottom';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Bottom', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_left';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Left', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_right';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Right', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
							
			$uid = $the_uid.'_padding_top_t';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Top (Tab)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_bottom_t';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Bottom (Tab)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_left_t';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Left (Tab)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_right_t';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Right (Tab)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_padding_top_m';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Top (Mobile)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_bottom_m';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Bottom (Mobile)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_left_m';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Left (Mobile)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_padding_right_m';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Right (Mobile)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			
			return $wp_customize;
		}
		
		
		function customizer_content_width($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_section_content_width';
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
				'label'      => $title,
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'tabs' => true,
				'tab_1' => array($the_uid.'_max_width'),
				'tab_2' => array($the_uid.'_width'),
				'tab_3' => NULL,
				'tab_4' => NULL,
				'tab_titles' => array('Max. Width', 'Normal Width', 'NULL', 'NULL'),
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_max_width';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Max. Width', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => '',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_width';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid, '90%'), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Normal Width', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => __('This value will be a <strong>%</strong> base value. Example <code>90%</code>', 'steed'),
				'priority'	=> $priority,
			));
			
			return $wp_customize;
		}
		
		
		function customizer_margin($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_margin_header';
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
				'label'      => $title,
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'tabs' => true,
				'tab_1' => array($the_uid.'_margin_top', $the_uid.'_margin_bottom'),
				'tab_2' => array($the_uid.'_margin_top_t', $the_uid.'_margin_bottom_t'),
				'tab_3' => array($the_uid.'_margin_top_m', $the_uid.'_margin_bottom_m'),
				'tab_4' => NULL,
				'tab_titles' => array('Desktop', 'Tab', 'Mobile', 'NULL'),
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_margin_top';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Margin Top', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_margin_bottom';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Margin Bottom', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_margin_top_t';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Margin Top (Tab)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_margin_bottom_t';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Margin Bottom (Tab)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_margin_top_m';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Margin Top (Mobile)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_margin_bottom_m';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Margin Bottom (Mobile)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
			
			return $wp_customize;
		}
		
		
		function customizer_description($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_description_title';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Title', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => '',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_description_text';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Description', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'textarea',
				'description' => '',
				'priority'	=> $priority,
			));
			
			return $wp_customize;
		}
		
		
		function customizer_color_mood($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_color_mood';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Color Mood', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'priority'	=> $priority,
				'choices'     => array(
					'dark' => 'Dark',
					'light' => 'Light',
				),
			));
			
			return $wp_customize;
		}
		
		
		function customizer_text_align($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_text_aline_header';
			$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
				'label'      => $title,
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'tabs' => true,
				'tab_1' => array($the_uid.'_text_align'),
				'tab_2' => array($the_uid.'_text_align_t'),
				'tab_3' => array($the_uid.'_text_align_m'),
				'tab_4' => NULL,
				'tab_titles' => array('Desktop', 'Tab', 'Mobile', 'NULL'),
				'priority'	=> $priority,
			)));
			
			$uid = $the_uid.'_text_align';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Text Align', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'priority'	=> $priority,
				'choices'     => array(
					'left' => 'Left',
					'right' => 'Right',
					'center' => 'Center',
					'none' => 'None',
				),
			));
			$uid = $the_uid.'_text_align_t';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Text Align (Tab)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'priority'	=> $priority,
				'choices'     => array(
					'left' => 'Left',
					'right' => 'Right',
					'center' => 'Center',
					'none' => 'None',
				),
			));
			$uid = $the_uid.'_text_align_m';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Text Align (Mobile)', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'priority'	=> $priority,
				'choices'     => array(
					'left' => 'Left',
					'right' => 'Right',
					'center' => 'Center',
					'none' => 'None',
				),
			));
			
			return $wp_customize;
		}
		
		
		function customizer_row_columns($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_columns';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Columns Layout', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'select',
				'description' => '',
				'priority'	=> $priority,
				'choices'     => array(
					'3,9' => '25% + 75%',
					'4,8' => '33% + 66%',
					'6,6' => '50% + 50%',
					'8,4' => '66% + 33%',
					'9,3' => '75% + 25%',
				),
			));
			
			return $wp_customize;
		}
		
		
		function customizer_full_bg($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_full_bg';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => 'Enable Full '.$title.' Background',
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
			));
			
			return $wp_customize;
		}
		
		
		function customizer_full_content($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_full_content';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => 'Enable Full '.$title.' Content',
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
			));
			
			return $wp_customize;
		}
		
		
		function css_background($the_uid, $selector){
			
			$bg_color		= steed_theme_mod($the_uid.'_bg_color');
			$bg_image		= steed_theme_mod($the_uid.'_bg_image');
			$bg_repeat		= steed_theme_mod($the_uid.'_bg_repeat');
			$bg_position	= steed_theme_mod($the_uid.'_bg_position');
			$bg_attachment	= steed_theme_mod($the_uid.'_bg_attachment');
			$bg_size		= steed_theme_mod($the_uid.'_bg_size');
			$bg_overlay		= steed_theme_mod($the_uid.'_bg_overlay_color');
			
			if(!empty($bg_color) || !empty($bg_image) || !empty($bg_repeat) || !empty($bg_position) || !empty($bg_attachment) || !empty($bg_size)){
				echo $selector.'{';
					echo (!empty($bg_color))		? 'background-color:'.steed_sanitize_rgba($bg_color).';'	: '';
					echo (!empty($bg_image))		? 'background-image:url('.esc_url($bg_image).');'			: '';
					echo (!empty($bg_repeat))		? 'background-repeat:'.esc_attr($bg_repeat).';'				: '';
					echo (!empty($bg_position))		? 'background-position:'.esc_attr($bg_position).';'			: '';
					echo (!empty($bg_attachment))	? 'background-attachment:'.esc_attr($bg_attachment).';'		: '';
					echo (!empty($bg_size))			? 'background-size:'.esc_attr($bg_size).';'					: '';
				echo '}';
			}
			
			if(!empty($bg_overlay)){
				echo $selector.' > .pc-bg-overlay{';
					echo (!empty($bg_overlay))		? 'background-color:'.steed_sanitize_rgba($bg_overlay).';'	: '';
				echo '}';
			}
		}
		
		
		function css_padding($the_uid, $selector){
			$top		= steed_theme_mod($the_uid.'_padding_top');
			$bottom		= steed_theme_mod($the_uid.'_padding_bottom');
			$left		= steed_theme_mod($the_uid.'_padding_left');
			$right		= steed_theme_mod($the_uid.'_padding_right');
			
			$top_t		= steed_theme_mod($the_uid.'_padding_top_t');
			$bottom_t	= steed_theme_mod($the_uid.'_padding_bottom_t');
			$left_t		= steed_theme_mod($the_uid.'_padding_left_t');
			$right_t	= steed_theme_mod($the_uid.'_padding_right_t');
			
			$top_m		= steed_theme_mod($the_uid.'_padding_top_m');
			$bottom_m	= steed_theme_mod($the_uid.'_padding_bottom_m');
			$left_m		= steed_theme_mod($the_uid.'_padding_left_m');
			$right_m	= steed_theme_mod($the_uid.'_padding_right_m');
			
			
			if(!empty($top) || !empty($bottom) || !empty($left) || !empty($right)){
				echo $selector.'{';
					echo (!empty($top))		? 'padding-top:'.esc_attr($top).';'			: '';
					echo (!empty($bottom))	? 'padding-bottom:'.esc_attr($bottom).';'	: '';
					echo (!empty($left))	? 'padding-left:'.esc_attr($left).';'		: '';
					echo (!empty($right))	? 'padding-right:'.esc_attr($right).';'		: '';
				echo '}';
			}
			
			if(!empty($top_t) || !empty($bottom_t) || !empty($left_t) || !empty($right_t)){
				echo '@media (max-width: 992px) {';
					echo $selector.'{';
						echo (!empty($top_t))		? 'padding-top:'.esc_attr($top_t).';'		: '';
						echo (!empty($bottom_t))	? 'padding-bottom:'.esc_attr($bottom_t).';'	: '';
						echo (!empty($left_t))		? 'padding-left:'.esc_attr($left_t).';'		: '';
						echo (!empty($right_t))		? 'padding-right:'.esc_attr($right_t).';'		: '';
					echo '}';
				echo '}';
			}
			
			if(!empty($top_m) || !empty($bottom_m) || !empty($left_m) || !empty($right_m)){
				echo '@media (max-width: 768px) {';
					echo $selector.'{';
						echo (!empty($top_m))		? 'padding-top:'.esc_attr($top_m).';'		: '';
						echo (!empty($bottom_m))	? 'padding-bottom:'.esc_attr($bottom_m).';'	: '';
						echo (!empty($left_m))		? 'padding-left:'.esc_attr($left_m).';'		: '';
						echo (!empty($right_m))		? 'padding-right:'.esc_attr($right_m).';'		: '';
					echo '}';
				echo '}';
			}
		}
		
		
		function css_margin($the_uid, $selector){
			$top		= steed_theme_mod($the_uid.'_margin_top');
			$bottom		= steed_theme_mod($the_uid.'_margin_bottom');
			$left		= steed_theme_mod($the_uid.'_margin_left');
			$right		= steed_theme_mod($the_uid.'_margin_right');
			
			$top_t		= steed_theme_mod($the_uid.'_margin_top_t');
			$bottom_t	= steed_theme_mod($the_uid.'_margin_bottom_t');
			$left_t		= steed_theme_mod($the_uid.'_margin_left_t');
			$right_t	= steed_theme_mod($the_uid.'_margin_right_t');
			
			$top_m		= steed_theme_mod($the_uid.'_margin_top_m');
			$bottom_m	= steed_theme_mod($the_uid.'_margin_bottom_m');
			$left_m		= steed_theme_mod($the_uid.'_margin_left_m');
			$right_m	= steed_theme_mod($the_uid.'_margin_right_m');
			
			
			if(!empty($top) || !empty($bottom) || !empty($left) || !empty($right)){
				echo $selector.'{';
					echo (!empty($top))		? 'margin-top:'.esc_attr($top).';'			: '';
					echo (!empty($bottom))	? 'margin-bottom:'.esc_attr($bottom).';'	: '';
					echo (!empty($left))	? 'margin-left:'.esc_attr($left).';'		: '';
					echo (!empty($right))	? 'margin-right:'.esc_attr($right).';'		: '';
				echo '}';
			}
			
			if(!empty($top_t) || !empty($bottom_t) || !empty($left_t) || !empty($right_t)){
				echo '@media (max-width: 992px) {';
					echo $selector.'{';
						echo (!empty($top_t))		? 'margin-top:'.esc_attr($top_t).';'		: '';
						echo (!empty($bottom_t))	? 'margin-bottom:'.esc_attr($bottom_t).';'	: '';
						echo (!empty($left_t))		? 'margin-left:'.esc_attr($left_t).';'		: '';
						echo (!empty($right_t))		? 'margin-right:'.esc_attr($right_t).';'	: '';
					echo '}';
				echo '}';
			}
			
			if(!empty($top_m) || !empty($bottom_m) || !empty($left_m) || !empty($right_m)){
				echo '@media (max-width: 768px) {';
					echo $selector.'{';
						echo (!empty($top_m))		? 'margin-top:'.esc_attr($top_m).';'		: '';
						echo (!empty($bottom_m))	? 'margin-bottom:'.esc_attr($bottom_m).';'	: '';
						echo (!empty($left_m))		? 'margin-left:'.esc_attr($left_m).';'		: '';
						echo (!empty($right_m))		? 'margin-right:'.esc_attr($right_m).';'	: '';
					echo '}';
				echo '}';
			}
		}
		
		
		function css_content_width($the_uid, $selector){
			$width		= steed_theme_mod($the_uid.'_width');
			$max_width	= steed_theme_mod($the_uid.'_max_width');
			if(!empty($width) || !empty($max_width)){
				echo $selector.'{';
					echo (!empty($width))		? 'width:'.esc_attr($width).';'		: '';
					echo (!empty($max_width))	? 'max-width:'.esc_attr($max_width).';'	: '';
				echo '}';
			}
		}
		
		
		
		//this function will use by its child class
		public function left_html_inner(){
			$settings = $this->settings;
			$this->content_types_html($settings['left_content'], 'left');
		}
		
		//this function will use by its child class
		public function right_html_inner(){
			$settings = $this->settings;
			$this->content_types_html($settings['right_content'], 'right');
		}
		
		//this function will use by its child class
		public function left_customize_inner($wp_customize){
			$settings = $this->settings;
			$this->content_types_customize($wp_customize, $settings['left_content'], 'left');
			
			return $wp_customize;
		}
		
		//this function will use by its child class
		public function right_customize_inner($wp_customize){
			$settings = $this->settings;
			$this->content_types_customize($wp_customize, $settings['right_content'], 'right');
			
			return $wp_customize;
		}
		
		//this function will use by its child class
		public function left_css_inner(){
			$settings = $this->settings;
			$this->content_types_css($settings['left_content'], 'left');
		}
		
		//this function will use by its child class
		public function right_css_inner(){
			$settings = $this->settings;
			$this->content_types_css($settings['right_content'], 'right');
		}
		
		//this function will use by its child class
		public function left_js_inner(){
			$settings = $this->settings;
			$this->content_types_js($settings['left_content'], 'left');
		}
		
		//this function will use by its child class
		public function right_js_inner(){
			$settings = $this->settings;
			$this->content_types_js($settings['right_content'], 'right');
		}
		
		
		function content_types_html($type, $position){
			$settings = $this->settings;
			$uid = $settings['uid'] .'_'. $position;
			
			if(class_exists('steed_pc_mod_page') && ($type == 'page')){
				steed_pc_mod_page::html($uid);
			}elseif(class_exists('steed_pc_mod_map') && ($type == 'map')){
				steed_pc_mod_map::html($uid);
			}
		}
		function content_types_customize($wp_customize, $type, $position){
			$settings = $this->settings;
			$uid = $settings['uid'] .'_'. $position;
			
			if(class_exists('steed_pc_mod_page') && ($type == 'page')){
				steed_pc_mod_page::customizer($wp_customize, $settings['section_id'], $uid);
			}elseif(class_exists('steed_pc_mod_map') && ($type == 'map')){
				steed_pc_mod_map::customizer($wp_customize, $settings['section_id'], $uid);
			}
			
			return $wp_customize;
		}
		function content_types_css($type, $position){
			$settings = $this->settings;
			$uid = $settings['uid'] .'_'. $position;
			
			if(class_exists('steed_pc_mod_page') && ($type == 'page')){
				steed_pc_mod_page::css($uid);
			}elseif(class_exists('steed_pc_mod_map') && ($type == 'map')){
				steed_pc_mod_map::css($uid);
			}
		}
		function content_types_js($type, $position){
			$settings = $this->settings;
			$uid = $settings['uid'] .'_'. $position;
			
			if(class_exists('steed_pc_mod_page') && ($type == 'page')){
				steed_pc_mod_page::js($uid);
			}elseif(class_exists('steed_pc_mod_map') && ($type == 'map')){
				steed_pc_mod_map::js($uid);
			}
		}
		
		
	}
endif;