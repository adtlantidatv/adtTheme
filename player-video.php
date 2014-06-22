<?php $files = getFilesUrlByType($post->ID); ?>
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
