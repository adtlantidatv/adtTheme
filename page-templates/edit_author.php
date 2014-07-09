<?php
/**
 * Template Name: Edit author
 *
 */
get_header();
?>

<?php if ( is_user_logged_in() ) { ?>
<?php while ( have_posts() ) : the_post(); ?>

	<div class="row margin_top_60">
		<div class="span4">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01 right"></a>
			
			<?php $log_user_id = get_current_user_id(); ?>
			<a href="<?php echo esc_url( get_author_posts_url( $log_user_id ) ); ?>" rel="author" class="author_link right margin_right_10" style="background-image:url(<?php echo adt_get_avatar($log_user_id); ?>)">
				<?php echo adt_the_avatar( $log_user_id ); ?>
			</a>
		</div>
		
		<div class="span6">
			<h1>
				<?php the_title(); ?>
			</h1>
			<div class="margin_right_300 text">
				<?php echo get_post_meta($post->ID, 'adt_excerpt', true); ?>
			</div>
		</div>

				<div class="span1 text_right">
					<a href="<?php echo esc_url( get_author_posts_url( $log_user_id ) ); ?>" class="btn_delete"><</a>
				</div>
	</div>
	
	<div class="row">
		<?php the_content(); ?>
	</div>

<?php endwhile; // end of the loop. ?>
<?php } ?>
<?php get_footer(); ?>