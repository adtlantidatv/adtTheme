jQuery(document).ready(function() {
 
    jQuery('.single .vjs-share-control').click(function(){
    	jQuery('body').addClass('go_left_50');
    	jQuery('.menu_right').addClass('pushed');
    });
    jQuery('.close_menu_black').click(function(){
	    jQuery('.menu_black').removeClass('pushed');
    	jQuery('body').removeClass('go_left_50');
    	jQuery('body').removeClass('go_right_100');
    	jQuery('.home_adt_menu').fadeIn(200);
    	jQuery('.upload_row').fadeIn(200);
    });
 
    // menu principal
    jQuery('#adt_menu').click(function(){
    	jQuery('body').addClass('go_right_100');
    	jQuery('#menu_principal').addClass('pushed');
    	jQuery('.home_adt_menu').fadeOut(200);
    	jQuery('.upload_row').fadeOut(200);
    });
});