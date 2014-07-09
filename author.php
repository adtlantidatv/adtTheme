<?php get_header(); ?>

<?php if ( have_posts() ){ ?>
<?php the_post(); ?>

<div class="author_line margin_top_60 row">
	
	<div class="span2">
		<div class="float_01">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01"></a>
		</div>

		<div class="float_01 margin_left_10">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="author_link right margin_right_10" style="background-image:url(<?php echo adt_get_avatar(get_the_author_meta( 'ID' )); ?>)">
				<?php echo adt_the_avatar( get_the_author_meta( 'ID' ) ); ?>
			</a>
		</div>
	</div>
	
	<div class="span8 remove_margin">
		<h1>
			<a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta("ID")); ?>" title="<?php echo esc_attr(get_the_author()); ?>" rel="me">
				<?php echo get_the_author(); ?>
			</a>
			<?php if ( current_user_can('edit_post', $post->ID) ) { ?>
			<a href="/editar-autor"><i class="icon-gear btn_06"></i></a>
			<?php } ?>					
		</h1>
		<a href="<?php the_author_url(); ?>" title="<?php echo esc_attr(get_the_author()); ?>" class="web">
			<?php the_author_url(); ?>
		</a>
		<?php the_author_meta( 'description' ); ?>
	</div>
	
</div>

<div class="row-fluid list_01 clearfix">
	<?php
	$args = array(
		'post_type' 		=>	array('post', 'streams', 'multistreamings'),
		'author'			=> get_the_author_meta( 'ID' ),
		'paged' 			=> get_query_var( 'paged' )
	);
	
	$query = new WP_Query( $args );
	
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
			
			<h1 class="margin_right_30">
				<?php the_title(); ?>
			</h1>
		</a>
	</article>
	<?php	
	endwhile; ?>

</div>
<?php
adt_paging_nav();	
	
wp_reset_postdata();	
?>

<?php }else{ ?>
<div class="author_line row">
	
	<div class="span2">
		<div class="float_01">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01"></a>
		</div>

		<div class="float_01 margin_left_10">
			<?php  
				global $current_user;
				get_currentuserinfo();
				$html = get_avatar( $current_user->user_email, apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') );
				$src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($html))->xpath("//img/@src"));
			?>
			<a href="<?php echo esc_url( get_author_posts_url( $current_user->ID ) ); ?>" rel="author" class="author_link" style="background-image:url(<?php echo $src; ?>)">
				<?php echo get_avatar( $current_user->user_email, apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') ); ?>
			</a>
		</div>
	</div>
	
	<div class="span9_eat_gutter remove_margin">
		<h1>
			<a class="url fn n" href="<?php echo get_author_posts_url( $current_user->ID ); ?>" title="<?php echo esc_attr($current_user->display_name); ?>" rel="me">
				<?php echo $current_user->display_name; ?>
			</a>
			<?php if ( current_user_can('publish_posts') ) { ?>
			<a href="/editar-autor"><i class="icon-gear"></i></a>
			<?php } ?>					
		</h1>
		<?php _e('Here you will find your archives. You can upload a new archive by pressing the upload button (the one that has a cloud) in your right. You can also change your personal information by pressing the little circle that is close to your name', 'adt'); ?>
	</div>
	
	<div class="span1">
		<?php if ( is_user_logged_in() ) { ?>
		<a href="/subir" class="blue btn_01" title="<?php _e('Upload a video', 'adt'); ?>"><i class="icon-cloud-upload"></i></a>
		<?php } ?>
	</div>
</div>
<?php } ?>
<?php get_footer(); ?>