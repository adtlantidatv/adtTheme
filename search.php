<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

	<section class="author_line margin_top_60 row" role="main">
			<div class="span1">
				<div class="float_01">
					<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01"></a>
				</div>
			</div>
			<div class="span10 margin_left_20">
					<?php if ( have_posts() ) : ?>
					<header>
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></h1>
					</header><!-- .page-header -->
					<?php 
						else :
							_e('Non se atopou nada. Segue buscando', 'adt');
		
						endif;
					
					 ?>
			</div>

	</section><!-- #primary -->
	<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
		's' => get_search_query(), 
		'posts_per_page' => 15, 
		'paged' => $paged
		);
	
	$wp_query = new WP_Query( $args );
	if($wp_query->have_posts()) : ?>

	<section class="row-fluid list_02">
	
	<?php while ( $wp_query->have_posts() ) :
		$wp_query->the_post(); ?>
				<article class="span1_of_5">
					<a href="<?php the_permalink(); ?>">
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
								<?php if($files['mp3'] || $files['ogg']){ ?>
								<div class="image_audio"><?php echo the_post_thumbnail( 'list_01_1_of_3' ); ?></div>
								<?php }else{ ?>
								<?php echo the_post_thumbnail( 'list_01_1_of_3' ); ?>
								<?php } ?>
							</div>
						<?php } ?>
	
						<h1><?php the_title(); ?></h1>
					</a>
				</article>
	
	<?php endwhile; ?>

	</section>
<?php adt_paging_nav();	?>
	<?php endif ?>


<?php
get_footer();

?>





