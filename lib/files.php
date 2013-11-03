<?php
function adt_scripts_styles() {
	global $wp_styles;

	/* Loads our main stylesheet. */
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'font-awesome-style', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');
	wp_enqueue_style( 'videojs-style', get_template_directory_uri() . '/css/video-js.css');
	wp_enqueue_style( 'adt-style', get_stylesheet_uri() );

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'adt-ie', get_template_directory_uri() . '/css/ie.css', array( 'adt-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
	
	wp_enqueue_script("jquery");
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script('bootstrap_script', get_template_directory_uri() . '/js/bootstrap.min.js', false, null, true);
	// validation
	wp_register_script( 'validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'validation' );
	wp_enqueue_script('videojs_script', get_template_directory_uri() . '/js/adt_video.js', false, null, true);
	wp_enqueue_script('soundmanager2', get_template_directory_uri() . '/js/soundmanager2.js', false, null, false);
	wp_enqueue_script('adt_custom_script', get_template_directory_uri() . '/js/custom.js', false, null, true);
}
add_action( 'wp_enqueue_scripts', 'adt_scripts_styles' );