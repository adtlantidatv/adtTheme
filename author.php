<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
<?php the_post(); ?>

<div class="author_line row">
	
	<div class="span2">
		<div class="float_01">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01"></a>
		</div>

		<div class="float_01 margin_left_10">
			<?php  
				$html = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') );
				$src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($html))->xpath("//img/@src"));
			?>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="author_link" style="background-image:url(<?php echo $src; ?>)">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') ); ?>
			</a>
		</div>
	</div>
	
	<div class="span9_eat_gutter remove_margin">
		<h1>
			<a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta("ID")); ?>" title="<?php echo esc_attr(get_the_author()); ?>" rel="me">
				<?php echo get_the_author(); ?>
			</a>
			<?php if ( current_user_can('edit_post', $post->ID) ) { ?>
			<a href="/editar-autor"><i class="icon-gear"></i></a>
			<?php } ?>					
		</h1>
		<a href="<?php the_author_url(); ?>" title="<?php echo esc_attr(get_the_author()); ?>" class="web">
			<?php the_author_url(); ?>
		</a>
		<?php the_author_meta( 'description' ); ?>
	</div>
	
	<div class="span1">
		<?php if ( is_user_logged_in() ) { ?>
		<a href="/subir" class="blue btn_01" title="<?php _e('Upload a video', 'adt'); ?>"><i class="icon-cloud-upload"></i></a>
		<?php } ?>
	</div>
</div>

<div class="row-fluid list_01">
	<?php
	$args = array(
		'post_type' 		=>	array('post', 'streams'),
		'author'			=> get_the_author_meta( 'ID' )
	);
	
	$query = new WP_Query( $args );
	
	while ( $query->have_posts() ) :
		$query->the_post();
	?>
	<article class="span1_of_3">
		<?php
			$webms = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/webm', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
			$mp4s = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/mp4', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
			$oggs = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/ogg', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
		?>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
			<?php if($webms){ ?>
				<?php echo the_post_thumbnail( 'list_01_1_of_3' ); ?>
			<?php }else{ ?>
				<div class="relative">
					<?php echo the_post_thumbnail( 'list_01_1_of_3' ); ?>
					<div class="converting">
						<div class="estado"><?php _e('convertindo...', 'adt'); ?></div>
						<div class="adt_loading animation_spin"></div>
					</div>
				</div>
			<?php } ?>
			
			<h1 class="margin_right_30">
				<?php the_title(); ?>
			</h1>
		</a>
	</article>
	<?php	
	endwhile;
	
	wp_reset_postdata();	
	?>
</div>

<?php endif; ?>
<?php get_footer(); ?>