<div id="menu_embed" class="menu_right menu_black">
	<div class="container relative">
		
		<div class="row">
			<div class="span6">
				<section class="margin_top_100 form_02">
					<h1><?php _e('Embed code','adt'); ?></h1>
					<div class="descripcion"><?php _e('Copy the code and past it everywhere','adt') ?></div>
					<textarea id="embed_code" onclick="this.focus();this.select()" readonly="readonly" class="mono margin_top_50">
<iframe src="<?php echo get_bloginfo('url'); ?>/aplayer/?id=<?php echo $post->ID; ?>" width="640" height="121" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></textarea>

					<h2 class="margin_top_30"><?php _e('Embed options','adt'); ?></h2>
					<div class="row">
						<div class="span1">
							<label for="embed_ancho"><?php _e('width', 'adt'); ?>(px)</label>
							<input id="embed_ancho" name="embed_ancho" type="text" value="640" />
						</div>
						<div class="span1">
							<label for="embed_alto"><?php _e('height', 'adt'); ?>(px)</label>
							<input id="embed_alto" name="embed_alto" type="text" value="121" />
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
								var contido = '<iframe src="<?php echo get_bloginfo('url'); ?>/aplayer/?id=<?php echo $post->ID; ?>" width="'+jQuery('#embed_ancho').val()+'" height="'+jQuery('#embed_alto').val()+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
								jQuery('#embed_code').html(contido);
							}
						});
					</script>
				</section>
			</div>
			
			<div class="span6">
				<section class="margin_top_100 form_02">
					<h1><?php _e('Link','adt'); ?></h1>
					<div class="descripcion"><?php _e('This is the url for watching the video','adt') ?></div>
					<input type="text" value="<?php the_permalink(); ?>" onclick="this.focus();this.select()" readonly="readonly" class="margin_top_50">
				</section>
				
				<section class="margin_top_50 form_02">
					<h1><?php _e('Social networks','adt'); ?></h1>
					
					<ul class="reset social">
					
						<li class="so_facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" title="<?php _e('Share in ', 'adt'); ?>Facebook">
								<i class="icon-facebook"></i>
							</a>
						</li>
						
						<li class="so_twitter">
							<a href="//twitter.com/share?text=<?php _e('Take a look to', 'adt'); ?> &quot;<?php echo esc_attr(get_the_title()); ?>&quot; <?php _e('at Adtlantida.tv', 'adt'); ?>&amp;url=<?php the_permalink(); ?>&amp;hashtags=Adtlantida" target="_blank" title="<?php _e('Share in ', 'adt'); ?>Twitter">
								<i class="icon-twitter"></i>
							</a>
						</li>
						
						<li class="so_google-plus">
							<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" title="<?php _e('Share in ', 'adt'); ?>Google Plus">
								<i class="icon-google-plus"></i>
							</a>
						</li>
						
						<li class="so_tumblr">
							<a href="https://www.tumblr.com/share/video?embed=<?php the_permalink(); ?>&tags=Adtlantida" target="_blank" title="<?php _e('Share in ', 'adt'); ?>Tumblr">
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
		
		<a href="#" class="close_menu_black" title="<?php _e('close menu', 'adt'); ?>"></a>
	</div>
</div>