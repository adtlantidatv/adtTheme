<?php
/**
 * Template Name: Live Videojs Template
 *
 */
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<link href="http://vjs.zencdn.net/4.0/video-js.css" rel="stylesheet">
	<script src="http://vjs.zencdn.net/4.0/video.js"></script>
</head>

<body <?php body_class(); ?>>

<?php while ( have_posts() ) : the_post(); ?>
<article>
	<?php the_title(); ?>
	<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
	
	<video id="example_video_1" class="video-js vjs-default-skin"
	  controls preload="auto" width="640" height="264"
	  poster="<?php echo $url; ?>"
	  data-setup='{"example_option":true}'>
		<?php if(get_post_meta($post->ID, 'adt_stream_url_webm', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_webm', true); ?>" type="video/webm">
	    <?php } ?>
		<?php if(get_post_meta($post->ID, 'adt_stream_url_mp4', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_mp4', true); ?>" type="video/mp4">
	    <?php } ?>
		<?php if(get_post_meta($post->ID, 'adt_stream_url_ogv', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_ogv', true); ?>" type="video/ogg">
	    <?php } ?>
		<?php if(get_post_meta($post->ID, 'adt_stream_url_other', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_other', true); ?>">
	    <?php } ?>
	</video>	
</article>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>