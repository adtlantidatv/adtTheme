<?php
/**
 * Template Name: Inicio Final
 *
 */
get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="author_line margin_top_60 row">
	<div class="span1">
		<div class="float_01">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01"></a>
		</div>
	</div>

	<div class="span8">
		<h1 class="titulo_01">
			adtlantida.tv			
			<span><?php _e('sistema de radiotelevisión libre', 'adt'); ?></span>
		</h1>
		<div class="descripcion_sitio">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<?php endwhile; // end of the loop. ?>
<?php wp_reset_postdata(); ?>

<div class="row-fluid list_01 clearfix">
	<?php
	$args = array(
		'post_type' 		=>	array('post'),
		'paged' 			=> get_query_var( 'paged' )
	);
	
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
	while ( $query->have_posts() ) :
		$query->the_post();
	?>
	
	<article class="span1_of_3">
		<?php $files = getFilesUrlByType($post->ID); ?>
		
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="main_link">

			<!-- Converting ... -->
			<?php if(get_post_meta( $post->ID, 'adt_is_converting', true ) == '1'){ ?>
				<div class="relative">
					<?php echo the_post_thumbnail( 'list_01_1_of_3' ); ?>
					<div class="converting">
						<div class="estado"><?php _e('converting...', 'adt'); ?></div>
						<div class="adt_loading animation_spin"></div>
					</div>
				</div>			
					
			<?php }else{ ?>
				<div class="image">
					<?php if(has_post_thumbnail()){ ?>
						<?php if($files['mp3'] || $files['ogg']){ ?>
						<div class="image_audio"><?php echo the_post_thumbnail( 'list_01_1_of_3' ); ?></div>
						<?php }else{ ?>
						<?php echo the_post_thumbnail( 'list_01_1_of_3' ); ?>
						<?php } ?>
					<?php }else{ ?>
						<?php echo wp_get_attachment_image( 615, 'list_01_1_of_3' ); ?>
					<?php } ?>
				</div>
			<?php } ?>
			
			<h2 class="margin_right_30">
				<?php the_title(); ?>				
			</h2>
		</a>
			<div class="fecha"><?php the_author_link(); ?> <i class="icon-angle-right"></i> <span> <?php the_time('d/m/Y'); ?></span></div>
	</article>

	<?php	
	endwhile; ?>
</div>

<?php adt_paging_nav(); ?>
<?php	
	endif; ?>

<?php get_footer(); ?>