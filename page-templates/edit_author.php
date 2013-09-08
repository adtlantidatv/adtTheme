<?php
/**
 * Template Name: Edit author
 *
 */
get_header();
?>

<?php if ( is_user_logged_in() ) { ?>
<?php while ( have_posts() ) : the_post(); ?>

	<div class="row margin_top_50">
		<div class="span1">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01"></a>
			
			<?php $log_user_id = get_current_user_id(); ?>			
			<?php  
				$html = get_avatar( $log_user_id, apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') );
				$src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($html))->xpath("//img/@src"));
			?>
			<a href="<?php echo esc_url( get_author_posts_url( $log_user_id ) ); ?>" rel="author" class="author_link margin_top_10" style="background-image:url(<?php echo $src; ?>)">
				<?php echo get_avatar( $log_user_id, apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') ); ?>
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
<?php } ?>
<?php get_footer(); ?>