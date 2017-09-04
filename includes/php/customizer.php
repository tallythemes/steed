<?php
/**
 * Steed Theme Customizer.
 *
 * @package Steed
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function steed_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->add_panel( 'site_header', array(
		'title'			=> __('Site Header', 'steed'),
		'description'	=> '',
		'priority'		=> 160,
	));
	$wp_customize->add_section( 'steed_topbar' , array(
		'title'      => __( 'Topbar', 'steed' ),
		'priority'   => 30,
		'panel'		=> 'site_header',
	));
	$wp_customize->add_section( 'steed_main_menu' , array(
		'title'		=> __( 'Main Menu', 'steed' ),
		'priority'	=> 30,
		'panel'		=> 'site_header',
	));
	$wp_customize->add_section( 'steed_header_style' , array(
		'title'		=> __( 'Header Style & Background', 'steed' ),
		'priority'	=> 160,
		'panel'		=> 'site_header',
	));
	$wp_customize->add_section( 'steed_branding_style' , array(
		'title'		=> __( 'Branding Area Style & Background', 'steed' ),
		'priority'	=> 160,
		'panel'		=> 'site_header',
	));
	$wp_customize->add_section( 'site_subheader' , array(
		'title'		=> __( 'Page / Post Title area', 'steed' ),
		'priority'	=> 160,
		//'panel'		=> '',
	));
	$wp_customize->add_section( 'steed_content_area_style' , array(
		'title'		=> __( 'Content Area Style', 'steed' ),
		'priority'	=> 160,
		//'panel'		=> '',
	));
	$wp_customize->add_panel( 'site_Footer', array(
		'title'			=> __('Site Footer', 'steed'),
		'description'	=> '',
		'priority'		=> 160,
	));
	$wp_customize->add_section( 'steed_footer_warp_style' , array(
		'title'		=> __( 'Footer Warp Style & Background', 'steed' ),
		'priority'	=> 160,
		'panel'		=> 'site_Footer',
	));
	$wp_customize->add_section( 'steed_footer_widgets' , array(
		'title'      => __( 'Footer Widgets', 'steed' ),
		'priority'   => 30,
		'panel'		=> 'site_Footer',
	));
	$wp_customize->add_section( 'steed_footer_bar' , array(
		'title'      => __( 'Footer Bar', 'steed' ),
		'priority'   => 30,
		'panel'		=> 'site_Footer',
	));
}
add_action( 'customize_register', 'steed_customize_register' );


if( class_exists( 'WP_Customize_Control' ) ):
	class steed_Customize_Control_heading extends WP_Customize_Control {
		
		public $label;
		public $description;
		public $tabs = false;
		public $tab_titles = NULL;
		public $tab_1 = NULL;
		public $tab_2 = NULL;
		public $tab_3 = NULL;
		public $tab_4 = NULL;
		public $type = 'steed-heading';
		
		public function render_content(){
			
			?>
            <div class="steed_Customize_Control_heading <?php echo ($this->tabs == true) ? 'hastab' : ''; ?>">
              	<?php
					
					
					if($this->tabs == true){
						
						
						$tab1_ids = '';
						$tab2_ids = '';
						$tab3_ids = '';
						$tab4_ids = '';
						
						$all_tab_ids = '';
						
						$tab_1_title = (!empty($this->tab_titles[0])) ? $this->tab_titles[0] : 'Tab 1';
						$tab_2_title = (!empty($this->tab_titles[1])) ? $this->tab_titles[1] : 'Tab 2';
						$tab_3_title = (!empty($this->tab_titles[2])) ? $this->tab_titles[2] : 'Tab 3';
						$tab_4_title = (!empty($this->tab_titles[3])) ? $this->tab_titles[3] : 'Tab 4';
						
						$i = 0;
						if(($this->tabs == true) && is_array($this->tab_1)){
							foreach($this->tab_1 as $tab_1){
								if($i > 0){ $tab1_ids .= '|'; }
								$tab1_ids .= '#customize-control-'.$tab_1;
								$all_tab_ids .= '|#customize-control-'.$tab_1;
								$i++;
							}
						}
						
						$i = 0;
						if(($this->tabs == true) && is_array($this->tab_2)){
							foreach($this->tab_2 as $tab_2){
								if($i > 0){ $tab2_ids .= '|'; }
								$tab2_ids .= '#customize-control-'.$tab_2;
								$all_tab_ids .= '|#customize-control-'.$tab_2;
								$i++;
							}
						}
						
						$i = 0;
						if(($this->tabs == true) && is_array($this->tab_3)){
							foreach($this->tab_3 as $tab_3){
								if($i > 0){ $tab3_ids .= '|'; }
								$tab3_ids .= '#customize-control-'.$tab_3;
								$all_tab_ids .= '|#customize-control-'.$tab_3;
								$i++;
							}
						}
						
						$i = 0;
						if(($this->tabs == true) && is_array($this->tab_4)){
							foreach($this->tab_4 as $tab_4){
								if($i > 0){ $tab4_ids .= '|'; }
								$tab4_ids .= '#customize-control-'.$tab_4;
								$all_tab_ids .= '|#customize-control-'.$tab_4;
								$i++;
							}
						}
						echo '<span class="tab_all" data-all-tab="'.$all_tab_ids.'" style="height:0; width:0;"></span>';
						
						
					}
					
					if($this->label){ 
						echo '<h4>';
							echo $this->label;
							if($this->tabs == true){
								echo '<a class="closeallitems" href="#" data-all-tab="'.$all_tab_ids.'" data-tab="'.$tab1_ids.'">+</a>';
							}
						echo '</h4>'; 
					}
					if($this->description){ echo '<p>'.$this->description.'</p>'; }
					
					if($this->tabs == true){
						if(is_array($this->tab_1)){echo '<a href="#" class="tabhand" data-tab="'.$tab1_ids.'" data-all-tab="'.$all_tab_ids.'">'.$tab_1_title.'</a>';}
						if(is_array($this->tab_2)){echo '<a href="#" class="tabhand" data-tab="'.$tab2_ids.'" data-all-tab="'.$all_tab_ids.'">'.$tab_2_title.'</a>';}
						if(is_array($this->tab_3)){echo '<a href="#" class="tabhand" data-tab="'.$tab3_ids.'" data-all-tab="'.$all_tab_ids.'">'.$tab_3_title.'</a>';}
						if(is_array($this->tab_4)){echo '<a href="#" class="tabhand" data-tab="'.$tab4_ids.'" data-all-tab="'.$all_tab_ids.'">'.$tab_4_title.'</a>';}
					}
				?>
            </div>
            <?php
		}
	}
endif;

function steed_Customize_Control_heading($prefix, $section_prefix_id, $title="", $des ="", $wp_customize){
	$uid = $prefix.'heading_aa';
	$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
	$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
		'label'      => $title,
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => $des,
	)));
	return $wp_customize;	
}

function steed_Customize_Control_color($prefix, $section_prefix_id, $title="", $des ="", $wp_customize, $std = ''){
	$uid = $prefix.'color';
	$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid, $std), 'sanitize_callback' => 'sanitize_hex_color', ));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $uid, array(
		'label'      => $title,
		'section'    => $section_prefix_id,
		'settings'   => $uid,
		'description' => $des,
	)));
	
	
	return $wp_customize;	
}



if(class_exists('WP_Customize_Control')):
	/**
	 * steed_Control_Upsell_Theme_Info class.
	 */
	class steed_Customize_Control_Padding extends WP_Customize_Control {

		/**
		 * Control type
		 *
		 * @var string control type
		 */
		public $type = 'steed-customize-control-padding';

		/**
		 * Button text
		 *
		 * @var string button text
		 */
		public $button_text = '';

		/**
		 * Button link
		 *
		 * @var string button url
		 */
		public $button_url = '#';

		/**
		 * List of features
		 *
		 * @var array theme features / options
		 */
		public $options = array();

		/**
		 * List of explanations
		 *
		 * @var array additional info
		 */
		public $explained_features = array();

		/**
		 * Label text for each feature
		 *
		 * @var string|void label text
		 */
		public $pro_label = '';

		/**
		 * Hestia_Control_Upsell_Theme_Info constructor.
		 *
		 * @param WP_Customize_Manager $manager the customize manager class.
		 * @param string               $id id.
		 * @param array                $args customizer manager parameters.
		 */
		public function __construct( WP_Customize_Manager $manager, $id, array $args ) {
	
			$manager->register_control_type( 'steed_Customize_Control_Padding' );
			parent::__construct( $manager, $id, $args );

		}
		/**
		 * Enqueue resources for the control
		 */
		public function enqueue() {
			//wp_enqueue_style( 'steed-upsell-style', get_template_directory_uri() . '/includes/php/customizer-theme-upsell-control/style.css', STEED_VERSION );
		}

		/**
		 * Json conversion
		 */
		public function to_json() {
			parent::to_json();
			$this->json['button_text']  = $this->button_text;
			$this->json['button_url']   = $this->button_url;
			$this->json['options']      = $this->options;
			$this->json['explained_features'] = $this->explained_features;
			$this->json['pro_label'] = $this->pro_label;
		}

		/**
		 * Control content
		 */
		public function content_template() {
	?>
			<div class="steed-upsell">
				<# if ( data.options ) { #>
					<ul class="steed-upsell-features">
						<# for (option in data.options) { #>
							<li><span class="upsell-pro-label">{{ data.pro_label }}</span>{{ data.options[option] }}
							</li>
							<# } #>
					</ul>
					<# } #>

						<# if ( data.button_text && data.button_url ) { #>
							<a target="_blank" href="{{ data.button_url }}" class="button button-primary" target="_blank">{{
								data.button_text }}</a>
							<# } #>
								<hr>

								<# if ( data.explained_features ) { #>
									<ul class="steed-upsell-feature-list">
										<# for (requirement in data.explained_features) { #>
											<li>* {{ data.explained_features[requirement] }}</li>
											<# } #>
									</ul>
									<# } #>
			</div>
		<?php
		}
	}
endif;