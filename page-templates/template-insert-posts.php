<?php
/**
 * Template Name: Upload
 *
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="row margin_top_50">
		<div class="span1">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/adt_logo.png" alt="<?php _e('Adtlantida.tv menu logo'); ?>" />
			</a>
		</div>
		
		<div class="span11">
			<h1>
				<?php the_title(); ?>
			</h1>
			<div class="margin_right_300 text">
				<?php echo get_post_meta($post->ID, 'adt_excerpt', true); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<?php the_content(); ?>
	</div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>