<?php get_header('webrtc'); ?>
<?php global $current_user;
      get_currentuserinfo();
	if ( current_user_can('edit_post', $post->ID) ) {
		$admin = true;
	}else{
		$admin = false;
	}
      
?>
<?php while ( have_posts() ) : the_post(); ?>

		<div id="contenedor_twitter_streamings" class="row-fluid">
			<?php 
			$posts_id = get_post_meta( $post->ID, 'adt_streaming_ids', true );
			$posts_array = explode(',', $posts_id);
			$args = array(
				'post_type' => 'streams',
				'post__in' => $posts_array
			);
			$the_query = new WP_Query( $args );
			
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
					<div class="span4">
						<div class="iframe_contenedor">
							<iframe src="<?php echo get_bloginfo('url'); ?>/splayer/?id=<?php echo $post->ID; ?>" width="460" height="320" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
					</div>
					<?php
				}
			}
			wp_reset_postdata();						
			 ?>
			
		</div><!-- contenedor dos streamings de twitter -->


		<article id="main_article" class="video" data-id="<?php echo $post->ID; ?>">
			<div class="row">
				<div class="span8">
        	        
		            <!-- just copy this <section> and next script -->
		            <section class="experiment">                
		                <!-- local/remote videos container -->
		                <div id="videos-container"></div>
		            </section>                    
            
					<div class="body row">
					
						<div class="span1">
							<ul class="main_menu reset">
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
								<?php if ( $admin ) {
			                        $edit_page = (int) wpuf_get_option( 'edit_stream_id', 'adtp_others' );
			                        $url = get_permalink( $edit_page );
			                        ?>
									<a href="<?php echo wp_nonce_url( $url . '?pid=' . $post->ID, 'wpuf_edit' ); ?>" title="<?php _e('Edit stream', 'adt'); ?>"><i class="icon-gear"></i></a>
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
						
					</div> <!-- fin body row -->       
									
				</div> <!-- fin span8 -->
			
			<div class="span4">				
				<section class="chat margin_top_40">
					<ul class="menu">
						<li><a href="#tabs_messages_2"><i class="icon-twitter"></i> #<?php echo get_post_meta( get_the_ID(), 'adt_twitter_hashtag', true ); ?></a></li>
						<li><a href="#tabs_messages_1">Chat</a></li>
					</ul>
					
					<div class="tabs_container" id="chat_container_<?php echo $post->ID; ?>">
						<div id="tabs_messages_1" class="chat_container">
							<div class="messages_container">
								<ul id="chatlog"><?php echo get_post_meta( get_the_ID(), 'adt_chat', true ); ?></ul>
							</div>
							<textarea id="message_input" rows="3" placeholder="<?php _e('escribe...', 'adt') ?>"></textarea>
							<div class="chat_controls">
								<button onclick="sendMessage()" id="send_chat" data-id="<?php echo $post->ID; ?>">send</button>
								<?php if (is_user_logged_in()){ ?>
								<input type="text" placeholder="<?php _e('nome...', 'adt'); ?>" value="<?php echo $current_user->user_login; ?>" />
								<?php }else{ ?>
								<input type="text" placeholder="<?php _e('nome...', 'adt'); ?>" value="" />								
								<?php } ?>
							</div>
						</div>
						<ul id="tabs_messages_2" class="lsitado_tweets"></ul>
					</div>
				</section>
				
			<div> <!-- fin span4 -->
		
				</div>
			</div>	
			</div><!-- fin row 1 -->			
			
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#embed_ancho').change(function(){
						updateIframe();
					});
					jQuery('#embed_alto').change(function(){
						updateIframe();
					});
					
					function updateIframe(){
						var contido = '<iframe src="<?php echo get_bloginfo('url'); ?>/splayer/?id=<?php echo $post->ID; ?>" width="'+jQuery('#embed_ancho').val()+'" height="'+jQuery('#embed_alto').val()+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
						jQuery('#embed_code').html(contido);
					}
				});
				
				// js/multistreaming.js
				// manexa os streaming que venhen via twitter
				multistreaming.init(["<?php echo get_post_meta( get_the_ID(), 'adt_twitter_hashtag', true ); ?>", "<?php echo get_template_directory_uri(); ?>", "<?php echo get_the_ID(); ?>", "<?php echo get_bloginfo('url'); ?>"]);
				
			</script>					
			
        </article> 
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
