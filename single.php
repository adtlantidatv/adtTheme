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
					<ul class="main_menu reset">
						<li>
							<a href="#" id="adt_menu" class="btn_01" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>"></a>
						</li>
					
						<li>
							<?php  
								$html = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') );
								$src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($html))->xpath("//img/@src"));
							?>
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="author_link" style="background-image:url(<?php echo $src; ?>)">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') ); ?>
							</a>
						</li>
						
						<li>
							<time><?php the_time('d.m.Y'); ?></time>
						</li>
						
					</ul>
				</div>
				
				<div class="span10">
					<h1>
						<?php the_title(); ?>
						<?php if ( current_user_can('edit_post', $post->ID) ) {
	                        $edit_page = (int) wpuf_get_option( 'edit_page_id', 'adtp_others' );
	                        $url = get_permalink( $edit_page );
	                        ?>
							<a href="<?php echo wp_nonce_url( $url . '?pid=' . $post->ID, 'wpuf_edit' ); ?>" title="<?php _e('Edit post', 'adt'); ?>"><i class="icon-gear btn_06"></i></a>
						<?php } ?>					

					</h1>
					<div class="width670 text">
						<?php the_content(); ?>
					</div>
				</div>
				
				<div class="span1">
					<!--
					<ul class="reset actions">
						<li><i class="icon-heart"></i></li>
						<li><i class="icon-comment"></i></li>
					</ul>
					-->
				</div>
			</div>
			
			<?php comments_template( '', true ); ?>
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