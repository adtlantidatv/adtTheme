<?php
/**
 * Template Name: Player
 */
 ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="embed_audio_player" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php header("X-XSS-Protection: 0"); ?>
	<?php wp_head(); ?>

	<style>
		.vjs-share-control{display:none !important}
	</style>
</head>

<body <?php body_class(); ?>>

<?php
if(isset($_GET["id"]) && $_GET["id"] != ""){

	$id_post = $_GET["id"];
	$files = getFilesUrlByType($id_post);

	$query = new WP_Query( array('p' => $id_post) );

	while ( $query->have_posts() ) : $query->the_post();
		?>
			<div id="video-post-<?php the_ID(); ?>" class="video_contenedor">
				<?php 
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'video_poster' );
					$url = $thumb['0']; 
				?>
		
						<video class="video-js vjs-default-skin" poster="<?php echo $url; ?>" controls="" data-setup='{"controls":true}' id="video_<?php the_ID(); ?>">
			<?php if($files['webm']){ ?>
		    <source src="<?php echo $files['webm'] ?>" type="video/webm">
			<?php } ?>
			<?php if($files['mp4']){ ?>
		    <source src="<?php echo $files['mp4']; ?>" type="video/mp4">
			<?php } ?>-
			<?php if($files['ogv']){ ?>
		    <source src="<?php echo $files['ogv']; ?>" type="video/ogg">
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