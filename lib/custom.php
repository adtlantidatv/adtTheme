<?php
// __________ Custom post-types ____________________________________________

add_action( 'init', 'adt_post_types_init' );

function adt_post_types_init() {

	// Streams Post Type
	$labels = array(
		'name' => __( 'Streams' ),
		'singular_name' => __( 'Stream' ),
		'add_new_item' => _x( 'Add New Stream', 'adt' )
	);
	register_post_type(
		'streams',
		array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
			'supports' => array('title', 'editor', 'thumbnail')
		)
	);

	// Colaboradores Post Type
	$labels = array(
		'name' => __( 'Collaborators' ),
		'singular_name' => __( 'Collaborator' ),
		'add_new_item' => _x( 'Add new collaborator', 'adt' )
	);
	register_post_type(
		'collaborator',
		array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
			'supports' => array('title', 'editor', 'thumbnail')
		)
	);
}

/* Custom boxes */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'adt_';

	$meta_boxes[] = array(
		'id'         => 'Stream metabox',
		'title'      => __('Video configuration'),
		'pages'      => array( 'page','post','streams' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Stream url .webm',
				'desc' => '',
				'id'   => $prefix . 'stream_url_webm',
				'type' => 'text',
			),
			array(
				'name' => 'Stream url .mp4',
				'desc' => '',
				'id'   => $prefix . 'stream_url_mp4',
				'type' => 'text',
			),
			array(
				'name' => 'Stream url .ogv',
				'desc' => '',
				'id'   => $prefix . 'stream_url_ogv',
				'type' => 'text',
			),
			array(
				'name' => 'Stream url other',
				'desc' => '',
				'id'   => $prefix . 'stream_url_other',
				'type' => 'text',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'Collaborators metabox',
		'title'      => __('Collaborator info'),
		'pages'      => array( 'collaborator' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'web',
				'desc' => '',
				'id'   => $prefix . 'web_url',
				'type' => 'text',
			),
			array(
				'name' => 'facebook',
				'desc' => '',
				'id'   => $prefix . 'facebook_url',
				'type' => 'text',
			),
			array(
				'name' => 'twitter',
				'desc' => '',
				'id'   => $prefix . 'twitter_url',
				'type' => 'text',
			),
			array(
				'name' => 'google +',
				'desc' => '',
				'id'   => $prefix . 'google_url',
				'type' => 'text',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'social_metabox',
		'title'      => __('Social configuration'),
		'pages'      => array( 'streams' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Twitter hashtag'),
				'desc' => '',
				'id'   => $prefix . 'twitter_hashtag',
				'type' => 'text',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'custom_boxes',
		'title'      => __('Campos Subir video'),
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Excerpt'),
				'desc' => '',
				'id'   => $prefix . 'excerpt',
				'type' => 'wysiwyg',
			),
		),
	);	

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'metabox/init.php';

}