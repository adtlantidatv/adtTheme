<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $files = getFilesUrlByType($post->ID); ?>

<div class="row">
	<div class="span12">
		<article class="video">
			<div class="clearfix">
							
				<!-- Converting video -->
				<?php if(get_post_meta( $post->ID, 'adt_is_converting', true ) == '1'){ ?>
					<div id="converting">
						<div class="converting_text">
							<div class="converting_title"><?php _e('Video is still converting...', 'adt'); ?></div>
							<div class="converting_descrip">
								<p><?php _e('It can take several minutes', 'adt'); ?></p>
								<p><?php _e('Take a look to your videos, come back later or click the update button', 'adt'); ?>
									<a href="javascript:location.reload(true);" title="<?php _e('update', 'adt'); ?>">
										<i class="icon-refresh"></i>
									</a>
								</p>
							</div>
						</div>
						<div class="adt_loading animation_spin"></div>
					</div>
				<?php } ?>
				<!-- video player -->
				<?php if($files['webm']!=null && $files['mp3']==null && $files['ogg']==null){ ?>
					<?php get_template_part( 'player', 'video' ); ?> 
				<?php } ?>
				
				<!-- audio player -->
				<?php if($files['mp3']!=null || $files['ogg']!=null){ ?>
					<?php get_template_part( 'player', 'audio' ); ?> 
				<?php } ?>
				
			</div>
			
			<div class="body row">
			
				<div class="span1">
					<ul class="main_menu reset clearfix">
						<li>
							<a href="#" id="adt_menu" class="btn_01" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>"></a>
						</li>
					
						<li>
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="author_link" style="background-image:url(<?php echo adt_get_avatar(get_the_author_meta( 'ID' )); ?>)">
								<?php echo adt_the_avatar( get_the_author_meta( 'ID' ) ); ?>
							</a>
						</li>
						
						<li>
							<time><?php the_time('d.m.Y'); ?></time>
						</li>
						
					</ul>
				</div>
				
				<div class="span7">
					<h1>
						<?php the_title(); ?>
						<?php if ( current_user_can('edit_post', $post->ID) ) {
	                        $edit_page = (int) wpuf_get_option( 'edit_page_id', 'adtp_others' );
	                        $url = get_permalink( $edit_page );
	                        ?>
							<a href="<?php echo wp_nonce_url( $url . '?pid=' . $post->ID, 'wpuf_edit' ); ?>" title="<?php _e('Edit post', 'adt'); ?>"><i class="icon-gear btn_06"></i></a>
						<?php } ?>					

					</h1>
					<div class="text">
						<?php the_content(); ?>
					</div>
				</div>
				
				<div class="span4">
					<section class="chat">
						<ul class="menu">
							<li><a href="#tabs_messages_1"><?php _e('comentarios', 'adt'); ?></a></li>
						</ul>

						<div class="tabs_container" id="chat_container_<?php echo $post->ID; ?>">
							<div id="tabs_messages_1" class="chat_container">
								<?php comments_template( '', true ); ?>
							</div>
						</div>
					</section>
				</div>
			</div>
		</article>
	</div>
</div>
<?php

 ?>
 
<?php if($files['webm']!=null && $files['mp3']==null && $files['ogg']==null){ ?>
	<?php get_template_part( 'share', 'video' ); ?>

<?php }else if($files['mp3']!=null || $files['ogg']!=null){ ?>
	<?php get_template_part( 'share', 'audio' ); ?>
<?php } ?>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>