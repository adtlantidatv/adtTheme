<?php
function adt_setup() {
	load_theme_textdomain( 'adt', get_template_directory() . '/languages' );
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );

	// menus
	register_nav_menu( 'primary', __( 'Primary Menu', 'adt' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'adt' ) );
	
	// images
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 480, 9999 ); // Unlimited height, soft crop
	add_image_size( 'list_01_1_of_3', 390, 220, true );
	add_image_size( 'video_poster', 1170, 659, true );
}
add_action( 'after_setup_theme', 'adt_setup' );
show_admin_bar( false );