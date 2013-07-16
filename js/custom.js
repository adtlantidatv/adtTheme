jQuery(document).ready(function() {
 
    jQuery('#share').click(function(){
    	jQuery('body').addClass('go_left_50');
    	jQuery('.menu_right').addClass('pushed');
    });
    jQuery('.close_menu_black').click(function(){
	    jQuery('.menu_black').removeClass('pushed');
    	jQuery('body').removeClass('go_left_50');
    });
 
});