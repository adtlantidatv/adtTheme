<?php
/**
 * Template Name: Player
 */
get_header('home');
if(isset($_GET["id"]) && $_GET["id"] != ""){

	$id_post = $_GET["id"];
	$query = new WP_Query( array('p' => $id_post) );

	while ( $query->have_posts() ) : $query->the_post();
		$webms = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/webm', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
		$mp4s = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/mp4', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
		$oggs = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/ogg', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
		?>
		
		<video class="video-js vjs-default-skin fullscreen" poster="<?php echo $url; ?>" height="659" width="100%" controls="" data-setup='{"controls":true}' id="video_<?php the_ID(); ?>">
			<?php if($webms){ ?>
		    <source src="<?php echo wp_get_attachment_url( reset($webms)->ID ); ?>" type="video/webm">
			<?php } ?>
			<?php if($mp4s){ ?>
		    <source src="<?php echo wp_get_attachment_url( reset($mp4s)->ID ); ?>" type="video/mp4">
			<?php } ?>
			<?php if($oggs){ ?>
		    <source src="<?php echo wp_get_attachment_url( reset($oggs)->ID ); ?>" type="video/ogg">
			<?php } ?>
			<?php if(get_post_meta($post->ID, 'adt_stream_url_mp4', true)){ ?>
		    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_mp4', true); ?>" type="video/mp4">
		    <?php } ?>
			<?php if(get_post_meta($post->ID, 'adt_stream_url_webm', true)){ ?>
		    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_webm', true); ?>" type="video/webm">
		    <?php } ?>
			<?php if(get_post_meta($post->ID, 'adt_stream_url_ogv', true)){ ?>
		    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_ogv', true); ?>" type="video/ogg">
		    <?php } ?>
			<?php if(get_post_meta($post->ID, 'adt_stream_url_other', true)){ ?>
		    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_other', true); ?>">
		    <?php } ?>
		    <p class="warning">Your browser does not support HTML5 video.</p>
		</video>
	
		<?php
	endwhile;

	wp_reset_postdata();
	?>

<?php
}else{
	echo 'vacio';
?>


<?php } ?>
<?php get_footer('full'); ?>