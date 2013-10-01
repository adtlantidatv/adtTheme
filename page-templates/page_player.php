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
			<div id="video-post-<?php the_ID(); ?>" class="video_contenedor">
		
		<video class="video-js vjs-default-skin fullscreen" poster="<?php echo $url; ?>" controls="" data-setup='{"controls":true}' id="video_<?php the_ID(); ?>">
			<?php if($webms){ ?>
		    <source src="<?php echo wp_get_attachment_url( reset($webms)->ID ); ?>" type="video/webm">
			<?php } ?>
			<?php if($mp4s){ ?>
		    <source src="<?php echo wp_get_attachment_url( reset($mp4s)->ID ); ?>" type="video/mp4">
			<?php } ?>
			<?php if($oggs){ ?>
		    <source src="<?php echo wp_get_attachment_url( reset($oggs)->ID ); ?>" type="video/ogg">
			<?php } ?>
		    <p class="warning">Your browser does not support HTML5 video.</p>
		</video>
			</div>
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