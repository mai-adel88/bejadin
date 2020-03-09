
//Template script here

(function($) {
  'use strict' ;
		
	$('nav').coreNavigation({
		menuPosition: "right",
		container: true,	
    	mode: 'sticky',		
				
		onStartSticky: function(){
        	console.log('Start Sticky');
		},
		onEndSticky: function(){
			console.log('End Sticky');
		},
		
		dropdownEvent: 'hover',
		onOpenDropdown: function(){
			console.log('open');
		},
		onCloseDropdown: function(){
			console.log('close');
		},
		
		onInit: function(){
			$('input').keypress(function (e) {
				console.log(e.target.value);
			});
		},
		
		onOpenMegaMenu: function(){
			console.log('Open Megamenu');
		},
		onCloseMegaMenu: function(){
			console.log('Close Megamenu');
		}		
	});	
	$(".language-menu").hide(0)
	$(".Notifications").hide(0)
	$(window).scroll(function(){
		$(".language-menu").fadeOut()
		$(".Notifications").fadeOut()
	})
	$(".lang-earth").click(function(){
		$(".language-menu").toggle()
		$(".Notifications").hide(0)
	})
	$(".notification-bell").click(function(){
		$(".Notifications").toggle()
		$(".language-menu").hide(0)
	})
	$(".language-menu").mouseleave(function(){
		$(this).fadeOut()
	})
	$(".Notifications").mouseleave(function(){
		$(this).fadeOut()
	})
	$(".toggle-bar").click(function(){
		$(".language-menu").fadeOut()
		$(".Notifications").fadeOut()
	})
	
})(jQuery);// End of use strict



