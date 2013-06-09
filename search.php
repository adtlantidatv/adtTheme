<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
<h1><?php printf( __( 'Search Results for: %s', 'adt' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'content' ); ?>
<?php endwhile; ?>

<?php else : ?>
	<h1><?php _e( 'Nothing Found', 'adt' ); ?></h1>
	<div>
		<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'adt' ); ?>
		<?php get_search_form(); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>