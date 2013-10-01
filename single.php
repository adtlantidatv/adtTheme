<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="row">
	<div class="span12">
		<article class="video">
			<div class="clearfix">
			<?php
				$webms = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/webm', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
				$mp4s = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/mp4', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
				$oggs = get_children(array('numberposts' => 1, 'post_mime_type' => 'video/ogg', 'post_parent' => $post->ID, 'post_type' => 'attachment'));
			?>
			<?php if(!$webms){ ?>
			<div id="converting">
				<div class="converting_text">
					<div class="converting_title"><?php _e('O video ainda esta convertindose', 'adt'); ?></div>
					<div class="converting_descrip">
						<p><?php _e('Isto pode levarlle alguns minutos', 'adt'); ?></p>
						<p><?php _e('Mira os teus videos, volve mais tarde ou preme en actualizar', 'adt'); ?>
							<a href="javascript:location.reload(true);" title="<?php _e('actualiza a paxina', 'adt'); ?>">
								<i class="icon-refresh"></i>
							</a>
						</p>
					</div>
				</div>
				<div class="adt_loading animation_spin"></div>
			</div>
			<?php } ?>
			<div id="video-post-<?php the_ID(); ?>" class="video_contenedor">
				<?php 
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'video_poster' );
					$url = $thumb['0']; 
				?>
				<video class="video-js vjs-default-skin" poster="<?php echo $url; ?>" controls="" data-setup='{"controls":true}' id="video_<?php the_ID(); ?>">
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
	                        $edit_page = (int) wpuf_get_option( 'edit_page_id', 'wpuf_others' );
	                        $url = get_permalink( $edit_page );
	                        ?>
							<a href="<?php echo wp_nonce_url( $url . '?pid=' . $post->ID, 'wpuf_edit' ); ?>" title="<?php _e('Edit post', 'adt'); ?>"><i class="icon-gear"></i></a>
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
<div id="menu_embed" class="menu_right menu_black">
	<div class="container relative">
		
		<div class="row">
			<div class="span6">
				<section class="margin_top_100 form_02">
					<h1><?php _e('Codigo incrustar','adt'); ?></h1>
					<div class="descripcion"><?php _e('Copia o seguinte codigo e pegao onde queiras','adt') ?></div>
					<textarea id="embed_code" onclick="this.focus();this.select()" readonly="readonly" class="mono margin_top_50">
<iframe src="<?php echo get_bloginfo('url'); ?>/player/?id=<?php echo $post->ID; ?>" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></textarea>

					<h2 class="margin_top_30"><?php _e('Opcions para incrustar','adt'); ?></h2>
					<div class="row">
						<div class="span1">
							<label for="embed_ancho"><?php _e('ancho', 'adt'); ?> (px)</label>
							<input id="embed_ancho" name="embed_ancho" type="text" value="640" />
						</div>
						<div class="span1">
							<label for="embed_alto"><?php _e('alto', 'adt'); ?> (px)</label>
							<input id="embed_alto" name="embed_alto" type="text" value="360" />
						</div>
					</div>
					
					<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery('#embed_ancho').change(function(){
								updateIframe();
							});
							jQuery('#embed_alto').change(function(){
								updateIframe();
							});
							
							function updateIframe(){
								var contido = '<iframe src="<?php echo get_bloginfo('url'); ?>/player/?id=<?php echo $post->ID; ?>" width="'+jQuery('#embed_ancho').val()+'" height="'+jQuery('#embed_alto').val()+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
								jQuery('#embed_code').html(contido);
							}
						});
					</script>
				</section>
			</div>
			
			<div class="span6">
				<section class="margin_top_100 form_02">
					<h1><?php _e('Enlace','adt'); ?></h1>
					<div class="descripcion"><?php _e('Esta e a ruta para ver o video','adt') ?></div>
					<input type="text" value="<?php the_permalink(); ?>" onclick="this.focus();this.select()" readonly="readonly" class="margin_top_50">
				</section>
				
				<section class="margin_top_50 form_02">
					<h1><?php _e('Redes sociais','adt'); ?></h1>
					
					<ul class="reset social">
					
						<li class="so_facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" title="<?php _e('Compartir en ', 'adt'); ?>Facebook">
								<i class="icon-facebook"></i>
							</a>
						</li>
						
						<li class="so_twitter">
							<a href="//twitter.com/share?text=<?php _e('Botalle un ollo a', 'adt'); ?> &quot;<?php echo esc_attr(get_the_title()); ?>&quot; <?php _e('en Adtlantida.tv', 'adt'); ?>&amp;url=<?php the_permalink(); ?>&amp;hashtags=Adtlantida" target="_blank" title="<?php _e('Compartir en ', 'adt'); ?>Twitter">
								<i class="icon-twitter"></i>
							</a>
						</li>
						
						<li class="so_google-plus">
							<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" title="<?php _e('Compartir en ', 'adt'); ?>Google Plus">
								<i class="icon-google-plus"></i>
							</a>
						</li>
						
						<li class="so_tumblr">
							<a href="https://www.tumblr.com/share/video?embed=<?php the_permalink(); ?>&tags=Adtlantida" target="_blank" title="<?php _e('Compartir en ', 'adt'); ?>Tumblr">
								<i class="icon-tumblr"></i>
							</a>
						</li>
						
						<li class="so_pinterest">
							<a href="#">
								<i class="icon-pinterest"></i>
							</a>
						</li>
					</ul>
				</section>
			</div>
		</div>
		
		<a href="#" class="close_menu_black" title="<?php _e('cerrar menu', 'adt'); ?>"></a>
	</div>
</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>