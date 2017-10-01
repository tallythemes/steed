<?php
class pc_two_columns_page_and_map extends steed_pc_2_columns{
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
				'left_bg'			=> false, //true, false
				'left_color_mood'	=> false, //true, false
				'left_bg_full'		=> false, //true, false
				'left_full_content' => false, //true, false
				'left_padding'		=> false, //true, false
				'left_description'	=> false, //true, false
				
				'right'				=> true, //true, false
				'right_bg'			=> false, //true, false
				'right_color_mood'	=> false, //true, false
				'right_bg_full'		=> false, //true, false
				'right_full_content' => false, //true, false
				'right_padding'		=> false, //true, false
				'right_description' => false, //true, false
			);
			$this->settings =array_merge($default, $settings);
			
			$this->uid = $config['uid'];
			$this->section_id = $config['section_id'];
			$this->panel_id = $config['panel_id'];
			$this->section_title = $config['section_title'];
			$this->section_priority = $config['section_priority'];
			
			parent::__construct(array(
				'div_class'			=> $this->settings['div_class'],
				'div_id'			=> $this->settings['div_id'],
				
				'uid'				=> $this->uid,
				'section_id'		=> $this->section_id,
				'panel_id'			=> $this->panel_id,
				'section_title'		=> $this->section_title,
				'section_priority'	=> $this->section_priority,
				
				'row_bg'			=> $this->settings['row_bg'], //true, false
				'row_width'			=> $this->settings['row_width'], //true, false,
				'row_padding'		=> $this->settings['row_padding'], //true, false
				'row_margin'		=> $this->settings['row_margin'], //true, false
				'row_columns'		=> $this->settings['row_columns'], //true, false
				
				'left'				=> $this->settings['left'], //true, false
				'left_title'		=> 'Page',
				'left_bg'			=> $this->settings['left_bg'], //true, false
				'left_color_mood'	=> $this->settings['left_color_mood'], //true, false
				'left_bg_full'		=> $this->settings['left_bg_full'], //true, false
				'left_full_content' => $this->settings['left_full_content'], //true, false
				'left_padding'		=> $this->settings['left_padding'], //true, false
				'left_description'	=> $this->settings['left_description'], //true, false
				
				'right'				=> $this->settings['right'], //true, false
				'right_title'		=> 'Map',
				'right_bg'			=> $this->settings['right_bg'], //true, false
				'right_color_mood'	=> $this->settings['right_color_mood'], //true, false
				'right_bg_full'		=> $this->settings['right_bg_full'], //true, false
				'right_full_content' => $this->settings['right_full_content'], //true, false
				'right_padding'		=> $this->settings['right_padding'], //true, false
				'right_description' => $this->settings['right_description'], //true, false
			));
		}
		
		function left_html_inner(){
			echo '<p>This is an example page. It’s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors.</p>';
		}
		
		function right_html_inner(){
			echo '<p>This is an example page. It’s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors./p>';
		}
		
		function left_customize_inner(){
			
		}
		
		function right_customize_inner(){
			
		}
		
		function left_css_inner(){
			
		}
		
		function right_css_inner(){
			
		}
		
		function left_js_inner(){
			
		}
		
		function right_js_inner(){
			
		}
		
		
}