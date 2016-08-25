/*
	Responsive Menu
------------------------------------------------------*/
jQuery(document).ready(function($) {
	"use strict";
	
	var ph1_responsive_menu = $(".responsive-menu");
	
	$( "#site-navigation > div > ul" ).clone().appendTo( ph1_responsive_menu );
    $( "<i class='fa fa-angle-down'></i>" ).appendTo( $( ".responsive-menu > ul li.menu-item-has-children" ) );
    
    var ttes_menu_panels = $('.responsive-menu > ul li.menu-item-has-children ul.sub-menu').hide();
    $('.responsive-menu > ul li.menu-item-has-children i').click(function() {
		if($(this).prev('ul.sub-menu, ul.children').hasClass('active')){
			$(this).prev('ul.sub-menu, ul.children').slideUp();
			$(this).prev('ul.sub-menu, ul.children').removeClass('active');
		}else{
			if(!$(this).parent().parent().hasClass('active')){
				ttes_menu_panels.slideUp();
				ttes_menu_panels.removeClass('active');
			}
			
			$(this).prev('ul.sub-menu, ul.children').slideDown();
			$(this).prev('ul.sub-menu, ul.children').addClass('active');
		}
		return false;
	});
    
	$('a.responsive-menu-hand').click(function() {
		if($(".responsive-menu").hasClass('active')){
        
			$(".responsive-menu").slideUp();
			$(".responsive-menu").removeClass('active');
		}else{
			$(".responsive-menu").slideDown();
			$(".responsive-menu").addClass('active');
		}
		return false;
	});
	
	$('a.responsive-menu-close').click(function() {
		$(".responsive-menu").slideUp();
		$(".responsive-menu").removeClass('active');
	});
});