<?php
/**
 * Template Name: Live Template
 *
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<article>
	<?php the_title(); ?>
	<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
	<video poster="<?php echo $url; ?>" height="270" width="480" controls="">
		<?php if(get_post_meta($post->ID, 'adt_stream_url_mp4', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_mp4', true); ?>" type="video/mp4">
	    <?php } ?>
		<?php if(get_post_meta($post->ID, 'adt_stream_url_webm', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_webm', true); ?>" type="video/webm">
	    <?php } ?>
		<?php if(get_post_meta($post->ID, 'adt_stream_url_ogv', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_ogv', true); ?>" type="video/ogg">
	    <?php } ?>
		<?php if(get_post_meta($post->ID, 'adt_stream_url_other', true)){ ?>
	    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_other', true); ?>">
	    <?php } ?>
	    <p class="warning">Your browser does not support HTML5 video.</p>
	</video>
</article>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>