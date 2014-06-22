<?php
/**
 * Template Name: Engade stream
 *
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="row engade_stream margin_top_60">
		<div class="span4">		
			<a href="#" id="adt_menu" title="Adtlantida.tv menu" class="btn_01 right"></a>
		</div>
		
		<div class="span8">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
	</div>
	
	<div class="row">
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