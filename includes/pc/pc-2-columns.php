<?php
if(!class_exists('steed_pc_2_columns')):
	class steed_pc_2_columns{
		public $settings;

		
		function __construct($settings){
			$default = array(
				'div_class'			=> '',
				'div_id'			=> '',
				'uid'				=> '',
				'section_id'		=> '',
				'panel_id'			=> '',
				'section_title'		=> '',
				'section_priority'	=> '',
				
				'row_bg'			=> false, //true, false
				'row_width'			=> false, //true, false,
				'row_padding'		=> false, //true, false
				'row_margin'		=> false, //true, false
				'row_columns'		=> false, //true, false
				
				'left'				=> true, //true, false
				'left_title'		=> 'Left',
				'left_bg'			=> false, //true, false
				'left_color_mood'	=> false, //true, false
				'left_bg_full'		=> false, //true, false
				'left_full_content' => false, //true, false
				'left_padding'		=> false, //true, false
				'left_description'	=> false, //true, false
				
				'right'				=> true, //true, false
				'right_title'		=> 'Right',
				'right_bg'			=> false, //true, false
				'right_color_mood'	=> false, //true, false
				'right_bg_full'		=> false, //true, false
				'right_full_content' => false, //true, false
				'right_padding'		=> false, //true, false
				'right_description' => false, //true, false
			);
			$this->settings =array_merge($default, $settings);
		}
		
		
		function html(){
			$settings = $this->settings;
			$enable = steed_theme_mod($this->uid.'_enable');
			$row_columns = (steed_theme_mod($this->uid.'_row_columns') != '') ? explode(',', steed_theme_mod($this->uid.'_row_columns')) : array(6,6);
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
			if($enable == false):
				?>
                <section class="pc-section pc-section-2-column <?php echo $settings['uid']; ?>">
                	<div class="steed_pc_section_in">
                    	<div class="row pc-flex">
                        	<?php
                            if($settings['left'] == true){
								if($settings['left_full_content'] == true){
									echo '<div class="col-md-'.$left_col_size.' pc-2colsection-left pc-follow-height" data-follow=".'.$settings['uid'].' .pc-2colsection-left-content">';
										echo '<div class="pc-2colsection-content pc-2colsection-left-content pc-bg-full" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in">';
											$this->left_html_inner();
										echo '</div>';
										if($settings['left_bg'] == true){
											if($settings['left_bg_full'] == true){
												echo '<div class="pc-2colsection-bg pc-bg-full" data-aline="left" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg"></div>';
											}
										}
									echo '</div>';
								}else{
									echo '<div class="col-md-'.$left_col_size.' pc-2colsection-left">';
										echo '<div class="pc-2colsection-content pc-2colsection-left-content">';
											$this->left_html_inner();
										echo '</div>';
										if($settings['left_bg'] == true){
											if($settings['left_bg_full'] == true){
												echo '<div class="pc-2colsection-bg pc-bg-full" data-aline="left" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg"></div>';
											}
										}
									echo '</div>';
								}
							}
							
							if($settings['right'] == true){
								if($settings['right_full_content'] == true){
									echo '<div class="col-md-'.$right_col_size.' pc-2colsection-right pc-follow-height" data-follow=".'.$settings['uid'].' .pc-2colsection-right-content">';
										echo '<div class="pc-2colsection-content pc-2colsection-right-content pc-bg-full" data-size="'.$left_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in">';
											$this->right_html_inner();
										echo '</div>';
										if($settings['right_bg'] == true){
											if($settings['right_bg_full'] == true){
												echo '<div class="pc-2colsection-bg pc-bg-full" data-aline="left" data-size="'.$right_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg"></div>';
											}
										}
									echo '</div>';
								}else{
									echo '<div class="col-md-'.$right_col_size.' pc-2colsection-right">';
										echo '<div class="pc-2colsection-content pc-2colsection-right-content">';
											$this->right_html_inner();
										echo '</div>';
										if($settings['right_bg'] == true){
											if($settings['right_bg_full'] == true){
												echo '<div class="pc-2colsection-bg pc-bg-full" data-aline="left" data-size="'.$right_col_size.'" data-content=".'.$settings['uid'].' .steed_pc_section_in"></div>';
											}else{
												echo '<div class="pc-2colsection-bg"></div>';
											}
										}
									echo '</div>';
								}
							}
							
							?>
                        </div>
                    </div>
                </section>
                <?php
			endif;		
			
		}
		
		
		
		function css(){
			$settings = $this->settings;

			ob_start();
				
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
				
				$this->left_customize_inner();
				
				if($settings['left_color_mood'] == true){
					$this->customizer_color_mood($wp_customize, $settings['uid'].'_left', $settings['section_id'], '');
				}
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
				
				if($settings['left_description'] == true){
					$this->customizer_description($wp_customize, $settings['uid'].'_right', $settings['section_id'], '');
				}
				
				$this->right_customize_inner();
				
				if($settings['right_color_mood'] == true){
					$this->customizer_color_mood($wp_customize, $settings['uid'].'_right', $settings['section_id'], '');
				}
			}
			
			
			/*
				Left Column Settings
			--------------------------------*/
			if(($settings['left'] == true) && ( ($settings['left_bg'] == true) || ($settings['left_padding'] == true) )){
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
			}
			
			
			/*
				Right Column Settings
			--------------------------------*/
			if(($settings['right'] == true) && ( ($settings['right_bg'] == true) || ($settings['right_padding'] == true) )){
				$uid = $settings['uid'].'_right_settings_head';
				$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
				$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
					'label'      => $settings['right_title'].' Settings',
					'section'    => $settings['section_id'],
					'settings'   => $uid,
					'description' => '',
				)));
				
				/*-- Left BG --*/
				if($settings['right_bg'] == true){
					$this->customizer_background($wp_customize, $settings['uid'].'_right', $settings['section_id'], $settings['right_title'].' Background');
				}
				
				/*-- Left Padding --*/
				if($settings['right_padding'] == true){
					$this->customizer_padding($wp_customize, $settings['uid'].'_right', $settings['section_id'], $settings['right_title'].' Padding');
				}
			}
			
			
			/*
				Section Settings
			--------------------------------*/
			if(($settings['row_bg'] == true) || ($settings['row_width'] == true) || ($settings['row_padding'] == true)){
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
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'esc_url', 'transport' => 'postMessage'));
			$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $uid, array(
				'label'      => __('Background Image', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_bg_color';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'steed_sanitize_rgba', 'transport' => 'postMessage'));
			$wp_customize->add_control(new steed_Customize_Alpha_Color_Control($wp_customize, $uid, array(
				'label'      => __('Background Color', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'priority'	=> $priority,
			)));
	
			$uid = $the_uid.'_bg_overlay_color';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ));
			$wp_customize->add_control(new steed_Customize_Alpha_Color_Control($wp_customize, $uid, array(
				'label'      => __('Background Overlay Color', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'description' => '',
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_bg_repeat';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
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
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field','transport' => 'postMessage' ));
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
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
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
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
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
				'tab_1' => array($the_uid.'_padding_top', $the_uid.'_padding_bottom'),
				'tab_2' => array($the_uid.'_padding_top_t', $the_uid.'_padding_bottom_t'),
				'tab_3' => array($the_uid.'_padding_top_m', $the_uid.'_padding_bottom_m'),
				'tab_4' => NULL,
				'tab_titles' => array('Desktop', 'Tab', 'Mobile', 'NULL'),
				'priority'	=> $priority,
			)));
			$uid = $the_uid.'_padding_top';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Top', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_padding_bottom';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Padding Bottom', 'steed'),
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
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Max. Width', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => '',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_width';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid, '90%'), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ));
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
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Margin Top', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => 'Example: <code>30px</code>',
				'priority'	=> $priority,
			));
				
			$uid = $the_uid.'_margin_bottom';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
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
			$uid = $the_uid.'_title';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Title', 'steed'),
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'text',
				'description' => '',
				'priority'	=> $priority,
			));
			$uid = $the_uid.'_description';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
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
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
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
		
		
		function customizer_row_columns($wp_customize, $the_uid, $section_id, $title, $priority = NULL){
			$uid = $the_uid.'_row_columns';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
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
		
		
		
		//this function will use by its child class
		function left_html_inner(){
			
		}
		
		//this function will use by its child class
		function right_html_inner(){
			
		}
		
		//this function will use by its child class
		function left_customize_inner(){
			
		}
		
		//this function will use by its child class
		function right_customize_inner(){
			
		}
		
		//this function will use by its child class
		function left_css_inner(){
			
		}
		
		//this function will use by its child class
		function right_css_inner(){
			
		}
		
		//this function will use by its child class
		function left_js_inner(){
			
		}
		
		//this function will use by its child class
		function right_js_inner(){
			
		}
		
		
	}
endif;