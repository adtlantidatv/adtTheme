<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>

<?php if ( category_description() ) : // Show an optional category description ?>
	<div><?php echo category_description(); ?></div>
	<?php endif; ?>
	
	<?php while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
	endwhile; ?>

<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>