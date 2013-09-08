<?php
/**
 * Template Name: Upload
 *
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="row margin_top_220 margin_bottom_30 subir_video">		
		<div class="span12">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
		<div class="span8 offset2">
			<div class="text">
				<?php echo get_post_meta($post->ID, 'adt_excerpt', true); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<?php the_content(); ?>
	</div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>