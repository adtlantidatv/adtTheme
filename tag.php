<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<h1>
		<?php printf( __( 'Tag Archives: %s', 'adt' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
	</h1>

	<?php if ( tag_description() ) : // Show an optional tag description ?>
		<div><?php echo tag_description(); ?></div>
	<?php endif; ?>

	<?php
		while ( have_posts() ) : the_post();
				get_template_part( 'content');
		endwhile;
	?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

<?php get_footer(); ?>