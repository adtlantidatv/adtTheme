<?php
/**
 * Template Name: Simple
 *
 */
get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="row margin_top_60">
		<div class="span1 offset1">
			<a href="#" id="adt_menu" class="btn_01" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>"></a>
		</div>
		<div class="span9">
			<h1 class="margin_bottom_30"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>