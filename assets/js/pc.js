(function ( $ ) {
	 "use strict";
    $.fn.pc_toggle = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            active_class: "pc-active"
        }, options );
 
        // Greenify the collection based on the settings variable.
        $( this ).on( "click", function() {
			if($(this).hasClass(settings.active_class)){
				$(this).removeClass(settings.active_class);
				$(this).next().removeClass(settings.active_class);
				$(this).next().slideUp( "slow", function() {});
			}else{
				$(this).addClass(settings.active_class);
				$(this).next().addClass(settings.active_class);
				$(this).next().slideDown( "slow", function() {});
			}
		});
 
    };
 
}( jQuery ));


(function ( $ ) {
	 "use strict";
    $.fn.pc_accordion = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            active_class: "pc-active",
			hand: ".pc_accordion_hand",
        }, options );
 
        // Greenify the collection based on the settings variable.
        $( this ).on( "click", function() {			
			if($(this).hasClass(settings.active_class)){
				$(settings.hand).removeClass(settings.active_class);
				$(settings.hand).next().removeClass(settings.active_class);
				$(settings.hand).next().slideUp( "slow");
			}else{
				$(settings.hand).removeClass(settings.active_class);
				$(settings.hand).next().removeClass(settings.active_class);
				$(settings.hand).next().slideUp( "slow");
				
				$(this).addClass(settings.active_class);
				$(this).next().addClass(settings.active_class);
				$(this).next().slideDown( "slow");
			}
		});
 
    };
 
}( jQuery ));

(function ( $ ) {
	 "use strict";
	$.fn.pc_hover_color_effect = function() {
		return this.each( function() {
			var hover_color = $(this).attr("data-hover-color");
			var already_color = $(this).attr("data-already-color");
			$(this).hover(
				function() {
					$(this).css("color", hover_color);
					//alert('on');
				}, function() {
					$(this).css("color", already_color);
					//alert('off');
				}
			);
		});
	};
}( jQuery ));


(function ( $ ) {
	 "use strict";
	$.fn.customizee_hover_color_effect_helper = function(options) {
		// This is the easiest way to have default options.
        var settings = $.extend({
			newval: "",
        }, options );
		
		var already_color = $(this).css("color");
		$(this).addClass( "data-hover-color");
		$(this).attr( "data-already-color",  already_color);
		$(this).attr( "data-hover-color", settings.newval );
		$('.data-hover-color').pc_hover_color_effect();
	};
}( jQuery ));


jQuery(document).ready(function() {
	"use strict";
	
});