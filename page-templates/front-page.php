<?php
/**
 * Template Name: Front Page Template
 *
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php if ( has_post_thumbnail() ) : ?>
	<div>
	<?php the_post_thumbnail(); ?>
	</div>
<?php endif; ?>

<?php get_template_part( 'content'); ?>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>