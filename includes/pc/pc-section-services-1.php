<?php
if(!class_exists('steed_pc_section_services_1')):
	class steed_pc_section_services_1{
		public $uid;
		public $section_id;
		public $panel_id;
		public $section_title;
		public $section_priority;
		
		function __construct($settings, $config){
			$default = array(
				'media_type' => 'carousel', //none, audio, video, gallery, slider, image, map, carousel
				'media_position' => 'full_left', //left, right, full_left, full_right
				'media_size' => '6', //9, 8, 6, 4, 3
				'list_items' => false,
				'description' => true,
				'footer_description' => false,
				'buttons' => false,
				'css_class' => '',
			);
			$this->settings =array_merge($default, $settings);
			
			$this->uid = $config['uid'];
			$this->section_id = $config['section_id'];
			$this->panel_id = $config['panel_id'];
			$this->section_title = $config['section_title'];
			$this->section_priority = $config['section_priority'];
			
			$this->Kirki_options();
		}
		
		
		/*
			Main HTML function
		--------------------*/
		function html(){
			$settings = $this->settings;
			$enable = steed_theme_mod($this->uid.'_enable');
			$padding = steed_theme_mod($this->uid.'_padding');
			$background = steed_theme_mod($this->uid.'_background');
			$color_mood = steed_theme_mod($this->uid.'_color_mood');
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			if($enable):
			if(is_customize_preview()){ echo '<div class="'.$this->uid.'_customize_preview">'; }
			?>
            <section class="pc-section pc-section-content-1 <?php echo $this->uid; ?> color-<?php echo esc_attr($color_mood); ?>">
            	<div class="steed_pc_section_in">
                	<div class="row pc-flex">
						<?php
							if(($media_position == 'left') || ($media_position == 'full_left')){
								$this->html_media();
							}
                           
                            $this->html_content(); 
							
							if(($media_position == 'right') || ($media_position == 'full_right')){
								$this->html_media();
							}
                        ?>
                    </div>
                </div>
            </section>
            <?php
			if(is_customize_preview()){ echo '</div>'; }
			endif;
		}
		
		
		
		/*
			HTML Media
		--------------------*/
		function html_media(){
			$settings = $this->settings;
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			if($settings['media_type'] != 'none'){
				if($settings['media_type'] == 'video'){
					if(($media_position == 'full_left') || ($media_position == 'full_right')){
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column pc-follow-height" data-follow=".'.$this->uid.' .video-full .pc-videoWrapper">';
							$this->html_video();
						echo '</div>';
					}else{
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column" ">';
							$this->html_video();
						echo '</div>';
					}
				}elseif($settings['media_type'] == 'map'){
					if(($media_position == 'full_left') || ($media_position == 'full_right')){
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column pc-follow-height" data-follow=".'.$this->uid.' .pc-s-content-1-map iframe">';
							$this->html_map();
						echo '</div>';
					}else{
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column" ">';
							$this->html_map();
						echo '</div>';
					}
				}elseif($settings['media_type'] == 'gallery'){
					if(($media_position == 'full_left') || ($media_position == 'full_right')){
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column pc-follow-height" data-follow=".'.$this->uid.' .pc-grid-items">';
							$this->html_gallery();
						echo '</div>';
					}else{
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column" ">';
							$this->html_gallery();
						echo '</div>';
					}
				}elseif($settings['media_type'] == 'slider'){
					if(($media_position == 'full_left') || ($media_position == 'full_right')){
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column pc-follow-height" data-follow=".'.$this->uid.' .pc-s-content-1-slider-items">';
							$this->html_slider();
						echo '</div>';
					}else{
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column" ">';
							$this->html_slider();
						echo '</div>';
					}
				}elseif($settings['media_type'] == 'carousel'){
					if(($media_position == 'full_left') || ($media_position == 'full_right')){
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column pc-follow-height" data-follow=".'.$this->uid.' .pc-s-content-1-carousel-items">';
							$this->html_carousel();
						echo '</div>';
					}else{
						echo '<div class="col-md-'.$media_size.' pc-s-content-media-column" ">';
							$this->html_carousel();
						echo '</div>';
					}
				}else{
					echo '<div class="col-md-'.$media_size.' pc-s-content-media-column">';
						if($settings['media_type'] == 'audio'){
							$this->html_audio();
						}elseif($settings['media_type'] == 'image'){
							$this->html_image();
						}
					echo '</div>';
				}
			}
		}
		
		
		
		/*
			HTML Content
		--------------------*/
		function html_content(){
			$settings = $this->settings;
			
			$title = steed_theme_mod($this->uid.'_title');
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			$column = '6';
			if($media_size == '3'){
				$column = '9';
			}elseif($media_size == '4'){
				$column = '8';
			}elseif($media_size == '6'){
				$column = '6';
			}elseif($media_size == '8'){
				$column = '4';
			}elseif($media_size == '9'){
				$column = '3';
			}
			
			
			echo '<div class="col-md-'.$column.' pc-s-content-text-column">';
				if($title){ echo '<h2 class="pc-s-content-1-title">'.$title.'</h2>'; }
				$this->html_description();
				$this->html_lists();
				$this->html_footer();
				$this->html_buttons();
			echo '</div>';
		}
		
		
		
		function css(){
			
			ob_start();
			$settings = $this->settings;
			$enable = steed_theme_mod($this->uid.'_enable');
			$padding = steed_theme_mod($this->uid.'_padding');
			$background = steed_theme_mod($this->uid.'_background');
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			$map_height = steed_theme_mod($this->uid.'_map_height');
			
			
			$slider_height = (steed_theme_mod($this->uid.'_slider_height') != '') ? steed_theme_mod($this->uid.'_slider_height') : '400';
			$slider_height_t = steed_theme_mod($this->uid.'_slider_height_t');
			$slider_height_m = steed_theme_mod($this->uid.'_slider_height_m');
			
			$gallery_gap_pre = steed_theme_mod($this->uid.'_gallery_gap');
			$gallery_gap = ($gallery_gap_pre != '') ? $gallery_gap_pre / 2 : NULL;
			
			
			if(($media_position == 'full_left') || ($media_position == 'full_right')){
				echo '.'.$this->uid.' .pc-s-content-text-column{';
					echo (!empty($padding['top']))		? 'padding-top:'.esc_attr($padding['top']).';'	: '';
					echo (!empty($padding['bottom']))	? 'padding-bottom:'.esc_attr($padding['bottom']).';'	: '';
					echo (!empty($padding['left']))		? 'padding-left:'.esc_attr($padding['left']).';'	: '';
					echo (!empty($padding['right']))	? 'padding-right:'.esc_attr($padding['right']).';'	: '';
				echo '}';
			}else{
				echo '.'.$this->uid.'{';
					echo (!empty($padding['top']))		? 'padding-top:'.esc_attr($padding['top']).';'	: '';
					echo (!empty($padding['bottom']))	? 'padding-bottom:'.esc_attr($padding['bottom']).';'	: '';
					echo (!empty($padding['left']))		? 'padding-left:'.esc_attr($padding['left']).';'	: '';
					echo (!empty($padding['right']))	? 'padding-right:'.esc_attr($padding['right']).';'	: '';
				echo '}';
			}
			
			echo '.'.$this->uid.'{';
				echo (!empty($background['background-color']))		? 'background-color:'.steed_sanitize_rgba($background['background-color']).';'	: '';
				echo (!empty($background['background-image']))		? 'background-image:url('.esc_url($background['background-image']).');'			: '';
				echo (!empty($background['background-repeat']))		? 'background-repeat:'.esc_attr($background['background-repeat']).';'			: '';
				echo (!empty($background['background-position']))	? 'background-position:'.esc_attr($background['background-position']).';'		: '';
				echo (!empty($background['background-attachment']))	? 'background-attachment:'.esc_attr($background['background-attachment']).';'	: '';
				echo (!empty($background['background-size']))		? 'background-size:'.esc_attr($background['background-size']).';'				: '';
			echo '}';
			
			if(($settings['media_type'] == 'map') && ($map_height != '')){
				echo '.'.$this->uid.' .pc-s-content-1-map iframe{';
					echo 'height:'.$map_height.'px;';
				echo '}';
			}
			
			if((($settings['media_type'] == 'slider') || ($settings['media_type'] == 'carousel')) && ($slider_height != '')){
				echo '.'.$this->uid.' .pc-s-content-1-gallery-item{';
					echo 'height:'.$slider_height.'px;';
				echo '}';
			}
			if((($settings['media_type'] == 'slider') || ($settings['media_type'] == 'carousel')) && ($slider_height_t != '')){
				echo '@media (max-width: 992px) {';
					echo '.'.$this->uid.' .pc-s-content-1-gallery-item{';
						echo 'height:'.$slider_height_t.'px;';
					echo '}';
				echo '}';
			}
			if((($settings['media_type'] == 'slider') || ($settings['media_type'] == 'carousel')) && ($slider_height_m != '')){
				echo '@media (max-width: 768px) {';
					echo '.'.$this->uid.' .pc-s-content-1-gallery-item{';
						echo 'height:'.$slider_height_m.'px;';
					echo '}';
				echo '}';
			}
			if(($settings['media_type'] == 'gallery') && ($gallery_gap != '')){
				echo '.'.$this->uid.' .pc-s-content-1-carousel-items{';
					echo 'padding: -'.$gallery_gap.'px;';
				echo '}';
				echo '.'.$this->uid.' .pc-s-content-1-gallery-item{';
					echo 'padding:'.$gallery_gap.'px;';
				echo '}';
			}
			if(($settings['media_type'] == 'carousel') && ($gallery_gap != '')){
				echo '.'.$this->uid.' .pc-s-content-1-carousel-items{';
					echo 'margin-left: -'.$gallery_gap.'px;';
					echo 'margin-right: -'.$gallery_gap.'px;';
				echo '}';
				echo '.'.$this->uid.' .pc-s-content-1-gallery-item{';
					echo 'margin-left:'.$gallery_gap.'px;';
					echo 'margin-right:'.$gallery_gap.'px;';
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
			

			return $wp_customize;
			
		}
		
		
		/*
			Main Option function
		--------------------*/
		function Kirki_options(){
			$settings = $this->settings;
			
			$uid = $this->uid.'_enable';
			steed_Kirki::add_field( 'steedcom', array(
				'type'     => 'switch',
				'settings' => $uid,
				'label'    => __( 'Enable This Section', 'steed' ),
				'section'  => $this->section_id,
				'default'  => steed_customiz_std($uid),
				'priority' => 10,
				'choices'     => array(
					'on'  => esc_attr__( 'Enable', 'steed' ),
					'off' => esc_attr__( 'Disable', 'steed' ),
				),
			));
			
			$uid = $this->uid.'_title';
			steed_Kirki::add_field( 'steedcom', array(
				'type'     => 'text',
				'settings' => $uid,
				'label'    => __( 'Title', 'steed' ),
				'section'  => $this->section_id,
				'default'  => steed_customiz_std($uid),
				'priority' => 10,
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.'.$this->uid.' .pc-s-content-1-title',
						'function' => 'html',
						'property' => 'html',
					),
				)
			));
			
			$uid = $this->uid.'_color_mood';
			steed_Kirki::add_field( 'steedcom', array(
				'type'     => 'select',
				'settings' => $uid,
				'label'    => __( 'Color Mood', 'steed' ),
				'section'  => $this->section_id,
				'default'  => steed_customiz_std($uid),
				'priority' => 10,
				'choices'     => array(
					'dark' => 'Dark',
					'light' => 'Light',
				),
				'partial_refresh' => array(
					$uid => array(
						'selector'        => '.'.$this->uid.'_customize_preview',
						'render_callback' => array($this, 'html'),
					),
				),
			));
			

			$this->option_description();
			$this->option_image();
			$this->option_video();
			$this->option_audio();
			$this->option_gallery();
			$this->option_map();
			$this->option_lists();
			$this->option_footer();
			$this->option_buttons();
			
			
			$uid = $this->uid.'_background_header';
			steed_Kirki::add_field( 'steedcom', array(
				'type'     => 'custom',
				'settings' => $uid,
				'label'    => '',
				'section'  => $this->section_id,
				'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Section Background</div>',
				'priority' => 10,
			));
			$uid = $this->uid.'_background';
			$default = steed_customiz_std($uid);
			$default_color		= (!empty($default['background-color']))		? $default['background-color']		: '';
			$default_image		= (!empty($default['background-image']))		? $default['background-image']		: '';
			$default_repeat		= (!empty($default['background-repeat']))		? $default['background-repeat']		: '';
			$default_position	= (!empty($default['background-position']))		? $default['background-position']	: '';
			$default_attachment	= (!empty($default['background-attachment']))	? $default['background-attachment']	: '';
			steed_Kirki::add_field( 'steedcom', array(
				'type'     => 'background',
				'settings' => $uid,
				'label'    => __( 'Section Background', 'steed' ),
				'section'  => $this->section_id,
				'default'  => array(
					'background-color' => $default_color,
					'background-image' => $default_image,
					'background-repeat' => $default_repeat,
					'background-position' => $default_position,
					'background-attachment' => $default_attachment,
				),
				'priority' => 10,
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.'.$this->uid,
						'function' => 'css',
						'property' => 'background',
					),
				)
			));
			
			
			$uid = $this->uid.'_padding_header';
			steed_Kirki::add_field( 'steedcom', array(
				'type'     => 'custom',
				'settings' => $uid,
				'label'    => '',
				'section'  => $this->section_id,
				'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Section Padding</div>',
				'priority' => 10,
			));
			$uid = $this->uid.'_padding';
			$default = steed_customiz_std($uid);
			$default_top	= (!empty($default['top']))		? $default['top']		: '';
			$default_bottom	= (!empty($default['bottom']))	? $default['bottom']	: '';
			$default_left	= (!empty($default['left']))	? $default['left']		: '';
			$default_right	= (!empty($default['right']))	? $default['right']		: '';
			steed_Kirki::add_field( 'steedcom', array(
				'type'     => 'spacing',
				'settings' => $uid,
				'label'    => __( 'Padding', 'steed' ),
				'section'  => $this->section_id,
				'default'  => array(
					'top'    => $default_top,
					'bottom' => $default_bottom,
					'left'   => $default_left,
					'right'  => $default_right,
				),
				'priority' => 10,
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.'.$this->uid,
						'function' => 'css',
						'property' => 'padding',
					),
				)
			));
			
			if($settings['media_type'] != 'none'){
				$uid = $this->uid.'_media_settings_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Media Settings</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_media_position';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'radio-buttonset',
					'settings' => $uid,
					'label'    => __( 'Media Position', 'steed' ),
					'section'  => $this->section_id,
					'default'  => 'link',
					'priority' => 10,
					'choices'     => array(
						'left'   => 'left',
						'right'   => 'right',
						'full_left'   => 'Left Full',
						'full_right'   => 'Right Full',
					),
				));
				$uid = $this->uid.'_media_size';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'radio-buttonset',
					'settings' => $uid,
					'label'    => __( 'Media Size', 'steed' ),
					'section'  => $this->section_id,
					'default'  => 'link',
					'priority' => 10,
					'choices'     => array(
						'3'   => '1/4',
						'4'   => '1/3',
						'6'   => '1/2',
						'8'   => '2/3',
						'9'   => '3/4',
					),
				));
			}
		}
		
		
		/*
			Audio Option [DONE]
		--------------------*/
		function option_audio(){
			$settings = $this->settings;
			
			if($settings['media_type'] == 'audio'){
				$uid = $this->uid.'_audio_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Audio</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_audio';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'upload',
					'settings' => $uid,
					'label'    => __( 'Audio MP3', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
				$uid = $this->uid.'_audio_poster';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'image',
					'settings' => $uid,
					'label'    => __( 'Audio Poster', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
			}
		}
		
		
		/*
			Audio HTML [DONE]
		--------------------*/
		function html_audio(){
			$settings = $this->settings;
			$audio = steed_theme_mod($this->uid.'_audio');
			$title = steed_theme_mod($this->uid.'_title');
			$poster = steed_theme_mod($this->uid.'_audio_poster');
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			$data_size = '2';
			$data_aline = 'left';
			$data_content = '.'.$this->uid.' .steed_pc_section_in';
			
			if($media_position == 'full_right'){
				$data_aline = 'right';
			}
			if($media_size == '3'){
				$data_size = '4';
			}elseif($media_size == '4'){
				$data_size = '3';
			}elseif($media_size == '6'){
				$data_size = '2';
			}elseif($media_size == '8'){
				$data_size = '1.5';
			}elseif($media_size == '9'){
				$data_size = '1.3332';
			}
			
			if(($media_position == 'left') || ($media_position == 'right')){
				echo '<div class="pc-s-content-1-audio">';
					if($audio != ''){
						echo '<img src="'.esc_url($poster).'" alt="'.wp_kses_post($title).'">';
						echo do_shortcode('[audio src="'.esc_url($audio).'"]');
					}
				echo '</div>';
			}elseif(($media_position == 'full_left') || ($media_position == 'full_right')){
				echo '<div class="pc-s-content-1-audio audio-full pc-bg-full" data-aline="'.$data_aline.'" data-size="'.$data_size.'" data-content="'.$data_content.'" >';
					if($audio != ''){
						echo '<div class="pc-s-content-1-audio-poster" style="background-image:url('.esc_url($poster).');"></div>';
						echo '<div class="pc-s-content-1-audio-player">'.do_shortcode('[audio src="'.esc_url($audio).'"]').'</div>';
					}
				echo '</div>';
			}
		}
		
		
		/*
			Video Option [DONE]
		--------------------*/
		function option_video(){
			$settings = $this->settings;
			
			if($settings['media_type'] == 'video'){
				$uid = $this->uid.'_video_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Video</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_video';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'text',
					'settings' => $uid,
					'label'    => __( 'Video Link', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
			}
		}
		
		
		/*
			Video HTML  [DONE]
		--------------------*/
		function html_video(){
			$settings = $this->settings;
			$video = steed_theme_mod($this->uid.'_video');
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			$data_size = '2';
			$data_aline = 'left';
			$data_content = '.'.$this->uid.' .steed_pc_section_in';
			
			if($media_position == 'full_right'){
				$data_aline = 'right';
			}
			if($media_size == '3'){
				$data_size = '4';
			}elseif($media_size == '4'){
				$data_size = '3';
			}elseif($media_size == '6'){
				$data_size = '2';
			}elseif($media_size == '8'){
				$data_size = '1.5';
			}elseif($media_size == '9'){
				$data_size = '1.3332';
			}
			
			
			if(($media_position == 'left') || ($media_position == 'right')){
				echo '<div class="pc-s-content-1-video">';
					echo '<div class="pc-videoWrapper">';
						if($video != ''){
							echo wp_oembed_get(esc_url($video));
						}
					echo '</div>';
				echo '</div>';
			}elseif(($media_position == 'full_left') || ($media_position == 'full_right')){
				echo '<div class="pc-s-content-1-video video-full pc-bg-full" data-aline="'.$data_aline.'" data-size="'.$data_size.'" data-content="'.$data_content.'" >';
					echo '<div class="pc-videoWrapper">';
						if($video != ''){
							echo wp_oembed_get(esc_url($video));
						}
					echo '</div>';
				echo '</div>';
			}
		}
		
		
		/*
			Gallery Option (Slider + Carousel) [DONE]
		--------------------*/
		function option_gallery(){
			$settings = $this->settings;
			
			if(($settings['media_type'] == 'gallery') || ($settings['media_type'] == 'slider') || ($settings['media_type'] == 'carousel')){
				$header_label = 'Gallery';
				if($settings['media_type'] == 'slider'){
					$header_label = 'Slider';
				}elseif($settings['media_type'] == 'carousel'){
					$header_label = 'Carousel';
				}
				
				$uid = $this->uid.'_gallery_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">'.$header_label.'</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_gallery';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'repeater',
					'settings' => $uid,
					'label'    => $header_label.' Items',
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'row_label' => array(
						'type' => 'text',
						'value' => 'Image',
						'field' => 'title',
					),
					'fields' => array(
						'title' => array(
							'type'        => 'text',
							'label'       => 'Title',
							'description' => '',
							'default'     => '',
						),
						'image' => array(
							'type'        => 'image',
							'label'       => 'Image',
							'description' => '',
							'default'     => '',
						),
						'caption' => array(
							'type'        => 'text',
							'label'       => 'Caption',
							'description' => '',
							'default'     => '',
						),
						'link' => array(
							'type'        => 'text',
							'label'       => 'Link',
							'description' => '',
							'default'     => '',
						),
					)
				));
				if($settings['media_type'] == 'gallery'){
					$uid = $this->uid.'_gallery_columns';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'radio-buttonset',
						'settings' => $uid,
						'label'    => __( 'Gallery Columns', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid),
						'priority' => 10,
						'choices'     => array(
							'1'		=> '1',
							'2'		=> '2',
							'3'		=> '3',
							'4'		=> '4',
							'5'		=> '5',
							'6'		=> '6',
							'7'		=> '7',
						),
					));
				}
				if($settings['media_type'] == 'slider'){
					$uid = $this->uid.'_slider_height';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'text',
						'settings' => $uid,
						'label'    => __( 'Slider Height', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid),
						'priority' => 10,
					));
					$uid = $this->uid.'_slider_height_t';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'text',
						'settings' => $uid,
						'label'    => __( 'Slider Height on Tabs', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid),
						'priority' => 10,
					));
					$uid = $this->uid.'_slider_height_m';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'text',
						'settings' => $uid,
						'label'    => __( 'Slider Height on Mobile', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid),
						'priority' => 10,
					));
					$uid = $this->uid.'_gallery_fade';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'radio-buttonset',
						'settings' => $uid,
						'label'    => __( 'Fade', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid, 'true'),
						'priority' => 10,
						'choices'     => array(
							'true'		=> 'True',
							'false'		=> 'False',
						),
					));
				}
				if(($settings['media_type'] == 'slider') || ($settings['media_type'] == 'carousel')){
					$uid = $this->uid.'_gallery_nav';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'radio-buttonset',
						'settings' => $uid,
						'label'    => __( 'Navigation', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid),
						'priority' => 10,
						'choices'     => array(
							'none'		=> 'None',
							'all'		=> 'All Nav',
							'dot'		=> 'Dot Only',
							'nav'		=> 'Nav Only',
						),
					));
					
					$uid = $this->uid.'_gallery_autoplay';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'radio-buttonset',
						'settings' => $uid,
						'label'    => __( 'Autoplay', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid),
						'priority' => 10,
						'choices'     => array(
							'true'		=> 'True',
							'false'		=> 'False',
						),
					));
					$uid = $this->uid.'_gallery_autoplayspeed';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'slider',
						'settings' => $uid,
						'label'    => __( 'Autoplay Speed', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid, '2000'),
						'priority' => 10,
						'choices'     => array(
							'min'  => '500',
							'max'  => '6000',
							'step' => '500',
						),
					));
					$uid = $this->uid.'_gallery_infinite';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'radio-buttonset',
						'settings' => $uid,
						'label'    => __( 'Infinite', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid, 'true'),
						'priority' => 10,
						'choices'     => array(
							'true'		=> 'True',
							'false'		=> 'False',
						),
					));
					$uid = $this->uid.'_gallery_speed';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'slider',
						'settings' => $uid,
						'label'    => __( 'Speed', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid, '500'),
						'priority' => 10,
						'choices'     => array(
							'min'  => '100',
							'max'  => '1500',
							'step' => '100',
						),
					));
					
				}
				if($settings['media_type'] == 'carousel'){
					$uid = $this->uid.'_gallery_slidesToShow';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'slider',
						'settings' => $uid,
						'label'    => __( 'Slides To Show', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid, '3'),
						'priority' => 10,
						'choices'     => array(
							'min'  => '1',
							'max'  => '12',
							'step' => '1',
						),
					));
					
					$uid = $this->uid.'_gallery_slidesToScroll';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'slider',
						'settings' => $uid,
						'label'    => __( 'Slides To Scroll', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid, '1'),
						'priority' => 10,
						'choices'     => array(
							'min'  => '1',
							'max'  => '12',
							'step' => '1',
						),
					));
					
					
				}
				if(($settings['media_type'] == 'gallery') || ($settings['media_type'] == 'carousel')){
					$uid = $this->uid.'_gallery_gap';
					steed_Kirki::add_field( 'steedcom', array(
						'type'     => 'slider',
						'settings' => $uid,
						'label'    => __( 'Gap', 'steed' ),
						'section'  => $this->section_id,
						'default'  => steed_customiz_std($uid),
						'priority' => 10,
						'choices'     => array(
							'min'  => '0',
							'max'  => '50',
							'step' => '1',
						),
					));
				}
				$uid = $this->uid.'_gallery_image_size';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'select',
					'settings' => $uid,
					'label'    => __( 'Image Size', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'choices'     =>  steed_Kirki_image_size(),
				));
			}
		}
		
		
		/*
			Gallery HTML [DONE]
		--------------------*/
		function html_gallery(){
			$settings = $this->settings;
			$gallery = steed_theme_mod($this->uid.'_gallery');
			$column = steed_theme_mod($this->uid.'_gallery_columns');
			$image_size = (steed_theme_mod($this->uid.'_gallery_image_size')) ? steed_theme_mod($this->uid.'_gallery_image_size') : 'thumbnail';
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			$data_size = '2';
			$data_aline = 'left';
			$data_content = '.'.$this->uid.' .steed_pc_section_in';
			
			if($media_position == 'full_right'){
				$data_aline = 'right';
			}
			if($media_size == '3'){
				$data_size = '4';
			}elseif($media_size == '4'){
				$data_size = '3';
			}elseif($media_size == '6'){
				$data_size = '2';
			}elseif($media_size == '8'){
				$data_size = '1.5';
			}elseif($media_size == '9'){
				$data_size = '1.3332';
			}
			
			
			if(($media_position == 'left') || ($media_position == 'right')){
				echo '<div class="pc-s-content-1-gallery">';
				
			}elseif(($media_position == 'full_left') || ($media_position == 'full_right')){
				echo '<div class="pc-s-content-1-gallery gallery-full pc-bg-full" data-aline="'.$data_aline.'" data-size="'.$data_size.'" data-content="'.$data_content.'" >';	
			}

				echo '<ul class="pc-grid-items pc-grid-'.$column.'">';
					if(is_array($gallery)){
						foreach($gallery as $img){
							$image_url = NULL;
							$image_full = NULL;
							
							if(!empty($img['image'])){
								$pre_image = wp_get_attachment_image_src($img['image'], $image_size);
								$pre_image_full = wp_get_attachment_image_src($img['image'], 'full');
								$image_url = (!empty($pre_image[0])) ? $pre_image[0] : NULL;
								$image_full = (!empty($pre_image_full[0])) ? $pre_image_full[0] : NULL;;
							}
							if($image_url != ''){
								echo '<li class="pc-grid-item">';
									echo '<div class="pc-s-content-1-gallery-item">';
										echo '<img src="'.esc_url($image_url).'" alt="'.esc_attr($img['caption']).'">';
										echo '<figcaption>'.esc_attr($img['caption']).'</figcaption>';
										if(!empty($img['link'])){
											echo '<a href="'.esc_url($img['link']).'">&nbsp;</a>';
										}else{
											echo '<a href="'.esc_url($image_full).'" class="image-lightbox">&nbsp;</a>';
										}
									echo '</div>';
								echo '</li>';
							}
						}
					}
				echo '</ul>';					
			echo '</div>';
		}
		
		
		
		/*
			Slider HTML [DONE]
		--------------------*/
		function html_slider(){
			$settings		= $this->settings;
			
			if($settings['media_type'] == 'slider'){
				$media_use = 'slider';
			}else{
				$media_use = 'carousel';
			}
			
			$gallery		= steed_theme_mod($this->uid.'_gallery');
			$nav			= steed_theme_mod($this->uid.'_gallery_nav');
			$autoplay		= (steed_theme_mod($this->uid.'_gallery_autoplay') == 'false') ? 'false' : 'true';
			$autoplayspeed	= (steed_theme_mod($this->uid.'_gallery_autoplayspeed') != '') ? steed_theme_mod($this->uid.'_gallery_autoplayspeed') : 2000;
			$infinite		= (steed_theme_mod($this->uid.'_gallery_infinite') == 'false') ? 'false' : 'true';;
			$speed			= (steed_theme_mod($this->uid.'_gallery_speed') != '') ? steed_theme_mod($this->uid.'_gallery_speed') : 500;
			$fade			= (steed_theme_mod($this->uid.'_gallery_fade') != '') ? 'true' : 'false';
			$slidesToShow	= (steed_theme_mod($this->uid.'_gallery_slidesToShow') != '') ? steed_theme_mod($this->uid.'_gallery_slidesToShow') : 3;
			$slidesToScroll	= (steed_theme_mod($this->uid.'_gallery_slidesToScroll') != '') ? steed_theme_mod($this->uid.'_gallery_slidesToScroll') : 1;
			
			$image_size		= (steed_theme_mod($this->uid.'_gallery_image_size')) ? steed_theme_mod($this->uid.'_gallery_image_size') : 'thumbnail';
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size		= steed_theme_mod($this->uid.'_media_size');
			
			$data_size		= '2';
			$data_aline		= 'left';
			$data_content	= '.'.$this->uid.' .steed_pc_section_in';
			
			if($media_position == 'full_right'){
				$data_aline = 'right';
			}
			if($media_size == '3'){
				$data_size = '4';
			}elseif($media_size == '4'){
				$data_size = '3';
			}elseif($media_size == '6'){
				$data_size = '2';
			}elseif($media_size == '8'){
				$data_size = '1.5';
			}elseif($media_size == '9'){
				$data_size = '1.3332';
			}
			
			if($nav == 'all'){
				$nav_dot = 'true';
				$nav_arrow = 'true';
			}elseif($nav == 'dot'){
				$nav_dot = 'true';
				$nav_arrow = 'false';
			}elseif($nav == 'nav'){
				$nav_dot = 'false';
				$nav_arrow = 'true';
			}else{
				$nav_dot = 'false';
				$nav_arrow = 'false';
			}
			

			
			
			if(($media_position == 'left') || ($media_position == 'right')){
				echo '<div class="pc-s-content-1-'.$media_use.'">';
				
			}elseif(($media_position == 'full_left') || ($media_position == 'full_right')){
				echo '<div class="pc-s-content-1-'.$media_use.' '.$media_use.'-full pc-bg-full" data-aline="'.$data_aline.'" data-size="'.$data_size.'" data-content="'.$data_content.'" >';	
			}

				echo '<div class="pc-s-content-1-'.$media_use.'-items pc-slick-'.$media_use.'">';
					if(is_array($gallery)){
						foreach($gallery as $img){
							$image_url = NULL;
							$image_full = NULL;
							
							if(!empty($img['image'])){
								$pre_image = wp_get_attachment_image_src($img['image'], $image_size);
								$pre_image_full = wp_get_attachment_image_src($img['image'], 'full');
								$image_url = (!empty($pre_image[0])) ? $pre_image[0] : NULL;
								$image_full = (!empty($pre_image_full[0])) ? $pre_image_full[0] : NULL;;
							}
							if($image_url != ''){
								echo '<div class="pc-s-content-1-'.$media_use.'-item">';
									echo '<div class="pc-s-content-1-gallery-item" style="background-image:url('.esc_url($image_url).');">';
										echo '<figcaption>'.esc_attr($img['caption']).'</figcaption>';
										if(!empty($img['link'])){
											echo '<a href="'.esc_url($img['link']).'">&nbsp;</a>';
										}else{
											echo '<a href="'.esc_url($image_full).'" class="image-lightbox">&nbsp;</a>';
										}
									echo '</div>';
								echo '</div>';
							}
						}
					}
				echo '</div>';					
			echo '</div>';
			?>
            <script type="text/javascript">
				jQuery(document).ready(function($) {
					$('.<?php echo $this->uid; ?> .pc-slick-<?php echo $media_use; ?>').slick({
						dots: <?php echo esc_attr($nav_dot); ?>,
						arrows: <?php echo esc_attr($nav_arrow); ?>,
						autoplay: <?php echo esc_attr($autoplay); ?>,
						autoplayspeed: <?php echo esc_attr($autoplayspeed); ?>,
						infinite: <?php echo esc_attr($infinite); ?>,
						speed: <?php echo esc_attr($speed); ?>,
						<?php if($settings['media_type'] == 'slider'): ?>
							fade: <?php echo esc_attr($fade); ?>,
							slidesToShow: 1,
							slidesToScroll: 1,	
						<?php else: ?>
							fade: false,
							slidesToShow: <?php echo esc_attr($slidesToShow); ?>,
							slidesToScroll: <?php echo esc_attr($slidesToScroll); ?>,	
						<?php endif; ?>
					});
				});
			</script>
            <?php
		}
		
		
		/*
			Carousel HTML [DONE]
		--------------------*/
		function html_carousel(){
			$this->html_slider();
		}
		
		
		
		/*
			Image Option  [DONE]
		--------------------*/
		function option_image(){
			$settings = $this->settings;
			
			if($settings['media_type'] == 'image'){
				$uid = $this->uid.'_image_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Image</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_image';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'image',
					'settings' => $uid,
					'label'    => __( 'Image', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
				$uid = $this->uid.'_image_caption';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'text',
					'settings' => $uid,
					'label'    => __( 'Image Caption', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
			}
			
		}
		
		
		/*
			Image HTML  [DONE]
		--------------------*/
		function html_image(){
			$settings = $this->settings;
			$full_class = '';
			$image = steed_theme_mod($this->uid.'_image');
			$caption = steed_theme_mod($this->uid.'_image_caption');
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			$caption_class = ($caption != '') ? 'has-caption' : NULL;
			$data_size = '2';
			$data_aline = 'left';
			$data_content = '.'.$this->uid.' .steed_pc_section_in';
			
			if($media_position == 'full_right'){
				$data_aline = 'right';
			}
			if($media_size == '3'){
				$data_size = '4';
			}elseif($media_size == '4'){
				$data_size = '3';
			}elseif($media_size == '6'){
				$data_size = '2';
			}elseif($media_size == '8'){
				$data_size = '1.5';
			}elseif($media_size == '9'){
				$data_size = '1.3332';
			}
			
			
			if(($media_position == 'left') || ($media_position == 'right')){
				echo '<div class="pc-s-content-1-image '.$caption_class.'">';
					echo '<img src="'.esc_url($image).'" alt="'.wp_kses_post($caption).'">';
					if($caption != ''){
						echo '<figcaption>'.wp_kses_post($caption).'</figcaption>';
					}
				echo '</div>';
			}elseif(($media_position == 'full_left') || ($media_position == 'full_right')){
				echo '<div class="pc-s-content-1-image '.$caption_class.' image-full pc-bg-full" data-aline="'.$data_aline.'" data-size="'.$data_size.'" data-content="'.$data_content.'" style="background-image:url('.esc_url($image).'); background-size: cover;">';
					if($caption != ''){
						echo '<figcaption>'.wp_kses_post($caption).'</figcaption>';
					}
				echo '</div>';
			}
		}
		
		
		/*
			List Items Options (Tab, Accordion, Toggol, Boxes, )
		--------------------*/
		function option_lists(){
			$settings = $this->settings;
			
			if($settings['list_items'] == true){
				$uid = $this->uid.'_lists_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">List Items</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_items';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'repeater',
					'settings' => $uid,
					'label'    => __( 'Items', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'row_label' => array(
						'type' => 'text',
						'value' => 'Item',
						'field' => 'title',
					),
					'fields' => array(
						'title' => array(
							'type'        => 'text',
							'label'       => 'Title',
							'description' => '',
							'default'     => '',
						),
						'content' => array(
							'type'        => 'textarea',
							'label'       => 'Content',
							'description' => '',
							'default'     => '',
						),
						'image' => array(
							'type'        => 'image',
							'label'       => 'Content Image',
							'description' => '',
							'default'     => '',
						),
						'link' => array(
							'type'        => 'text',
							'label'       => 'Button Link',
							'description' => '',
							'default'     => '',
						),
						'button' => array(
							'type'        => 'text',
							'label'       => 'Button Text',
							'description' => '',
							'default'     => '',
						),
						'icon' => array(
							'type'        => 'image',
							'label'       => 'Icon Image',
							'description' => '',
							'default'     => '',
						),
					)
				));
				$uid = $this->uid.'_items_columns';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'radio-buttonset',
					'settings' => $uid,
					'label'    => __( 'List Columns', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'choices'     => array(
						'12'	=> 'One',
						'6'		=> 'Two',
						'4'		=> 'Three',
						'3'		=> 'Four',
					),
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					)
				));
			}
		}
		
		
		/*
			List Items HTML
		--------------------*/
		function html_lists(){
			$settings = $this->settings;
			if($settings['list_items'] == true){
				
				$items = steed_theme_mod($this->uid.'_items');
				$items_column = steed_theme_mod($this->uid.'_items_columns');
				
				if(is_array($items)){
					echo '<div class="pc-s-content-1-lists">';
						echo '<div class="row">';
							foreach($items as $item){
								
								$title		= (!empty($item['title'])) ? $item['title'] : '';
								$content 	= (!empty($item['content'])) ? $item['content'] : '';
								$icon		= (!empty($item['icon'])) ? $item['icon'] : '';
								$image 		= (wp_get_attachment_url($icon) != '') ? wp_get_attachment_url($icon) : '';
								$link		= (!empty($item['link'])) ? $item['link'] : '';
								
								echo '<div class="col-md-'.$items_column.'">';
									echo '<div class="pc-s-content-1-list">';
										echo '<div class="pc-s-content-1-list-head">';
											if($image != ''){
												echo '<img src="'.$image.'" alt="'.$title.'">';
											}
											echo '<h4>'.$title.'</h4>';
										echo '</div>';
										echo '<div class="pc-s-content-1-list-content">'.$content.'</div>';
										if($link != ''){
											echo '<a href="'.$link.'" class="pc-s-content-1-list-link">&nbsp;</a>';
										}
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="pc-clear"></div>';
				}
			}
		}
		
		
		/*
			Description Options  [DONE]
		--------------------*/
		function option_description(){
			$settings = $this->settings;
			
			if($settings['description'] == true){
				$uid = $this->uid.'_description';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'textarea',
					'settings' => $uid,
					'label'    => __( 'Description', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.'.$this->uid.' .pc-s-content-1-description',
							'function' => 'html',
							'property' => '',
						),
					)
				));
			}
		}
		
		
		/*
			Description HTML  [DONE]
		--------------------*/
		function html_description(){
			$settings = $this->settings;
			
			if($settings['description'] == true){
				$description = steed_theme_mod($this->uid.'_description');
				
				if($description != ''){
					echo '<div class="pc-s-content-1-description">';
						echo $description;
					echo '</div>';
				}
			}
		}
		
		
		/*
			Footer Options  [DONE]
		--------------------*/
		function option_footer(){
			$settings = $this->settings;
			
			if($settings['footer_description'] == true){
				$uid = $this->uid.'_footer_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Footer Description</div>',
					'priority' => 10,
				));
			
				$uid = $this->uid.'_footer';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'textarea',
					'settings' => $uid,
					'label'    => __( 'Footer Description', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.'.$this->uid.' .pc-s-content-1-footer',
							'function' => 'html',
							'property' => '',
						),
					)
				));
			}
		}
		
		
		/*
			Footer HTML  [DONE]
		--------------------*/
		function html_footer(){
			$settings = $this->settings;
			
			if($settings['footer_description'] == true){
				$description = steed_theme_mod($this->uid.'_footer');
				
				if($description != ''){
					echo '<div class="pc-s-content-1-footer">';
						echo $description;
					echo '</div>';
				}
			}
		}
		
		
		/*
			Buttons Options [DONE]
		--------------------*/
		function option_buttons(){
			$settings = $this->settings;
			if($settings['buttons'] == true){
				$uid = $this->uid.'_buttons_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Button</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_button1_hand';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'radio-buttonset',
					'settings' => $uid,
					'label'    => __( 'Button Settings', 'steed' ),
					'section'  => $this->section_id,
					'default'  => 'link',
					'priority' => 10,
					'transport' => 'postMessage',
					'choices'     => array(
						'link'   => 'Link',
						'size'   => 'Size',
						'color'   => 'Color',
						'style'   => 'Style',
					),
				));
				$uid = $this->uid.'_button_text';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'text',
					'settings' => $uid,
					'label'    => __( 'Button Text', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'active_callback'    => array(
						array(
							'setting'  => $this->uid.'_button1_hand',
							'operator' => '==',
							'value'    => 'link',
						),
					),
				));
				$uid = $this->uid.'_button_link';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'text',
					'settings' => $uid,
					'label'    => __( 'Button Link', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'active_callback'    => array(
						array(
							'setting'  => $this->uid.'_button1_hand',
							'operator' => '==',
							'value'    => 'link',
						),
					),
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
				$uid = $this->uid.'_button_size';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'select',
					'settings' => $uid,
					'label'    => __( 'Button Size', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'multiple'    => 1,
					'active_callback'    => array(
						array(
							'setting'  => $this->uid.'_button1_hand',
							'operator' => '==',
							'value'    => 'size',
						),
					),
					'choices' => array(
						'md' => 'default',
						'xl'	=> __( 'XL', 'steed' ),
						'lg'	=> __( 'lg', 'steed' ),
						'sm'	=> __( 'sm', 'steed' ),
						'xs'	=> __( 'xs', 'steed' ),
					),
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
				$uid = $this->uid.'_button_color';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'select',
					'settings' => $uid,
					'label'    => __( 'Button Color', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'multiple'    => 1,
					'active_callback'    => array(
						array(
							'setting'  => $this->uid.'_button1_hand',
							'operator' => '==',
							'value'    => 'color',
						),
					),
					'choices' => array(
						'primary'	=> __( 'Primary', 'steed' ),
						'light'		=> __( 'Light', 'steed' ),
						'dark'		=> __( 'Dark', 'steed' ),
						'green'		=> __( 'Green', 'steed' ),
						'red'		=> __( 'Red', 'steed' )
					),
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
				$uid = $this->uid.'_button_type';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'select',
					'settings' => $uid,
					'label'    => __( 'Button Type', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'multiple'    => 1,
					'active_callback'    => array(
						array(
							'setting'  => $this->uid.'_button1_hand',
							'operator' => '==',
							'value'    => 'style',
						),
					),
					'choices' => array(
						'fill'		=> __( 'Fill', 'steed' ),
						'border'	=> __( 'Border', 'steed' ),
					),
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
				$uid = $this->uid.'_button_radius';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'select',
					'settings' => $uid,
					'label'    => __( 'Button Radius', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'multiple'    => 1,
					'active_callback'    => array(
						array(
							'setting'  => $this->uid.'_button1_hand',
							'operator' => '==',
							'value'    => 'style',
						),
					),
					'choices' => array(
						'round'		=> __( 'round', 'steed' ),
						'squire'	=> __( 'squire', 'steed' ),
						'pill'		=> __( 'pill', 'steed' ),
					),
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
			}
		}
		
		
		/*
			Buttons HTML [DONE]
		--------------------*/
		function html_buttons(){
			$settings = $this->settings;
			if($settings['buttons'] == true){
				$size	= steed_theme_mod($this->uid.'_button_size');
				$radius = steed_theme_mod($this->uid.'_button_radius');
				$type	= steed_theme_mod($this->uid.'_button_type');
				$color	= steed_theme_mod($this->uid.'_button_color');
				$text	= steed_theme_mod($this->uid.'_button_text');
				$link	= steed_theme_mod($this->uid.'_button_link');
				if($link != ''){
					echo '<div class="pc-s-content-1-buttons">';
						echo '<a href="'.$link.'" class="pc-btn pc-btn-'.$size.' pc-btn-'.$radius.' pc-btn-'.$type.'-'.$color.'">'.$text.'</a>';
					echo '</div>';
				}
			}
		}
		
		
		
		/*
			Map Options [DONE]
		--------------------*/
		function option_map(){
			$settings = $this->settings;
			
			if($settings['media_type'] == 'map'){
				$uid = $this->uid.'_map_header';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'custom',
					'settings' => $uid,
					'label'    => '',
					'section'  => $this->section_id,
					'default'  => '<div style="padding: 10px 20px; background-color: #6a109a; color: #fff; margin-top: 20px; margin-left: -15px; margin-right: -15px; font-size: 18px;">Map</div>',
					'priority' => 10,
				));
				$uid = $this->uid.'_map';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'code',
					'settings' => $uid,
					'label'    => __( 'Google Map Code', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'choices'     => array(
						'language' => 'html',
						'theme'    => 'monokai',
						'height'   => 250,
					),
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
				$uid = $this->uid.'_map_height';
				steed_Kirki::add_field( 'steedcom', array(
					'type'     => 'text',
					'settings' => $uid,
					'label'    => __( 'Map Height', 'steed' ),
					'section'  => $this->section_id,
					'default'  => steed_customiz_std($uid),
					'priority' => 10,
					'partial_refresh' => array(
						$uid => array(
							'selector'        => '.'.$this->uid.'_customize_preview',
							'render_callback' => array($this, 'html'),
						),
					),
				));
			}
		}
		
		
		/*
			Map HTML [DONE]
		--------------------*/
		function html_map(){
			$settings = $this->settings;
			$map = steed_theme_mod($this->uid.'_map');
			$map_height = steed_theme_mod($this->uid.'_map_height');
			
			$media_position = steed_theme_mod($this->uid.'_media_position');
			$media_size = steed_theme_mod($this->uid.'_media_size');
			
			$data_size = '2';
			$data_aline = 'left';
			$data_content = '.'.$this->uid.' .steed_pc_section_in';
			
			if($media_position == 'full_right'){
				$data_aline = 'right';
			}
			if($media_size == '3'){
				$data_size = '4';
			}elseif($media_size == '4'){
				$data_size = '3';
			}elseif($media_size == '6'){
				$data_size = '2';
			}elseif($media_size == '8'){
				$data_size = '1.5';
			}elseif($media_size == '9'){
				$data_size = '1.3332';
			}
			
			
			if(($media_position == 'left') || ($media_position == 'right')){
				echo '<div class="pc-s-content-1-map">';
					if($map != ''){
						echo $map;
					}
				echo '</div>';
			}elseif(($media_position == 'full_left') || ($media_position == 'full_right')){
				echo '<div class="pc-s-content-1-map video-map pc-bg-full" data-aline="'.$data_aline.'" data-size="'.$data_size.'" data-content="'.$data_content.'" >';
					
						echo $map;
					
				echo '</div>';
			}
		}
		
	}
endif;

/*
Testimonials: Slider, grid, carousel, list
Member		: Slider, grid, carousel, list
Boxes		: Slider, grid, carousel, list
Blog		: Slider, grid, carousel, list
Products	: Slider, grid, carousel, list
Contact Box	: grid
Tab			:
Taggol		:
Accordion	:
status		: Grid, List
Infobar		:
*/