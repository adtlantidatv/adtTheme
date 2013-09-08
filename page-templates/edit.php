<?php
/**
 * Template Name: Edit
 *
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<div class="row">
		<?php the_content(); ?>
	</div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>