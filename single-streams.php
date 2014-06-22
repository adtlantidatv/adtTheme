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
				<!-- Comprobando si hai streamings -->
				
				<?php if(!$admin){ ?>
					<div id="converting">
						<div class="converting_text">
							<div class="converting_title"><?php _e('Comprobando si hai algunha emisión...', 'adt'); ?></div>
							<div class="converting_descrip">
								<p><?php _e('Ten paciencia, isto pode tardar algún tempo', 'adt'); ?>
									<a href="javascript:location.reload(true);" title="<?php _e('update', 'adt'); ?>">
										<i class="icon-refresh"></i>
									</a>
								</p>
							</div>
						</div>
						<div class="adt_loading animation_spin"></div>
					</div>
				<?php } ?>
			

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
			</div>
            
            
				</div>
			<div class="span4">
				<section class="streaming_controls margin_bottom_30 margin_top_30">
					<ul>
						<li class="active"><a href="#tabs-1" class="adt">&nbsp;</a></li>
						<li><a href="#tabs-2" class="embed">embed</a></li>
					</ul>
					
					<div class="tabs_container">
						<div id="tabs-1" class="active">
							<?php if ( current_user_can('edit_post', $post->ID) ) { ?>
							<button id="stream_audio" class="btn_04"><?php _e('Stream audio', 'adt'); ?></button>
							<button id="stream_audio_video" class="btn_04"><?php _e('Stream video', 'adt'); ?></button>                
							<a href="<?php the_permalink(); ?>" class="btn_04"><?php _e('Stop stream', 'adt'); ?></a>                
			                <!-- list of all available broadcasting rooms -->
			                <?php }else{ ?>
			                <ul id="rooms-list"></ul>
			                <?php } ?>
			                <div><?php _e('Number of viewers: '); ?><span id="num_viewers">0</span></div>
						</div>
						<div id="tabs-2" class="form_02 stream">
							
							<textarea id="embed_code" onclick="this.focus();this.select()" readonly="readonly" class="mono"><iframe src="<?php echo get_bloginfo('url'); ?>/splayer/?id=<?php echo $post->ID; ?>" width="640" height="480" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></textarea>
							
							<div class="row-fluid margin_top_20">
								<div class="span6">
									<label for="embed_ancho"><?php _e('width', 'adt'); ?> (px)</label>
									<input id="embed_ancho" name="embed_ancho" type="text" value="640" class="pequeno margin_top_10" />
								</div>
								<div class="span6">
									<label for="embed_alto"><?php _e('height', 'adt'); ?> (px)</label>
									<input id="embed_alto" name="embed_alto" type="text" value="480" class="pequeno margin_top_10" />
								</div>
								
							</div>

							<div class="row-fluid margin_top_20">
								<div class="span12">
									<label for="embed_alto"><?php _e('link', 'adt'); ?></label>
									<input type="text" value="<?php the_permalink(); ?>" onclick="this.focus();this.select()" readonly="readonly" class="pequeno margin_top_10">
								</div>
							</div>
						</div>
					</div>
   				</section>
				
				<section class="chat">
					<ul class="menu">
						<li><a href="#tabs_messages_1">Chat</a></li>
						<li><a href="#tabs_messages_2"><i class="icon-twitter"></i> #<?php echo get_post_meta( get_the_ID(), 'adt_twitter_hashtag', true ); ?></a></li>
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
				
			<div>
		
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


				window.ify=function(){var entities={'"':'"','&':'&','<':'<','>':'>'};return{"link":function(t){if (typeof t!='undefined') return t.replace(/[a-z]+:\/\/[a-z0-9-_]+\.[a-z0-9-_:~%&\?\/.=]+[^:\.,\)\s*$]/ig,function(m){ if (typeof m!='undefined') return'<a href="'+m+'">'+((m.length>25)?m.substr(0,24)+'...':m)+'</a>';});},"at":function(t){ if (typeof t!='undefined') return t.replace(/(^|[^\w]+)\@([a-zA-Z0-9_]{1,15})/g,function(m,m1,m2){return m1+'@<a href="http://twitter.com/'+m2+'">'+m2+'</a>';});},"hash":function(t){ if (typeof t!='undefined')return t.replace(/(^|[^\w'"]+)\#([a-zA-Z0-9_]+)/g,function(m,m1,m2){return m1+'#<a href="http://search.twitter.com/search?q=%23'+m2+'">'+m2+'</a>';});},"clean":function(tweet){return this.hash(this.at(this.link(tweet)));}};}();

			function formateaFechaTwitter(time){
				time = time.replace(/ \+0000/g, ' UTC+0000');

				var date = new Date(time),
					diff = (((new Date()).getTime() - date.getTime()) / 1000),
					day_diff = Math.floor(diff / 86400);

				if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
					return;

				return day_diff == 0 && (
						diff < 60 && "Agora" ||
						diff < 120 && "Hai 1 minuto" ||
						diff < 3600 && "Hai " + Math.floor( diff / 60 ) + " minutos" ||
						diff < 7200 && "Hai 1 hora" ||
						diff < 86400 && "Hai " + Math.floor( diff / 3600 ) + " horas") ||
					day_diff == 1 && "Onte" ||
					day_diff < 7 && "Hai " + day_diff + " d&iacute;as" ||
					day_diff < 31 && "Hai " + Math.ceil( day_diff / 7 ) + " semanas";
			}

				jQuery(function() {

					setInterval(collerTweets, 10000);

					function collerTweets(){
						
						jQuery.getJSON( "<?php echo get_template_directory_uri(); ?>/api/chios/?hash=<?php echo get_post_meta( get_the_ID(), 'adt_twitter_hashtag', true ); ?>", function( data ) {
							
							jQuery('.lsitado_tweets').empty();
							
							jQuery.each(data.statuses, function(entryIndex, entry){
								var contido = '<li>';
								contido += '<span class="usuario"><a href="https://twitter.com/'+entry.user.screen_name+'" target="_blank">' + entry.user.screen_name + ' </a></span>';
								contido += ify.clean(entry.text);
								contido += '<span class="fecha">'+formateaFechaTwitter(entry.created_at)+'</span>';
								contido += '</li>';
								jQuery('.lsitado_tweets').append(contido);
							});
							
							jQuery('.lsitado_tweets').perfectScrollbar({suppressScrollX:true});
						});
					}
					
				});
			</script>
			
            <script>
                // Muaz Khan     - https://github.com/muaz-khan
                // MIT License   - https://www.webrtc-experiment.com/licence/
                // Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/webrtc-broadcasting

				var SIGNALING_SERVER = 'http://147.83.72.228:1984/';
				var mainStream;
				var shared = 'audio';

                var config = {
                    openSocket: function(config) {
					   var channel = config.channel || this.channel || '<?php echo $post->post_name; ?>';
					   var sender = Math.round(Math.random() * 9999999999) + 9999999999;
					   
					   io.connect(SIGNALING_SERVER).emit('new-channel', {
					      channel: channel,
					      sender : sender
					   });
					   
					   var socket = io.connect(SIGNALING_SERVER + channel);
					   socket.channel = channel;
					   
					   socket.on('connect', function () {
					      if (config.callback) config.callback(socket);
					   });
					   
					   socket.send = function (message) {
					        socket.emit('message', {
					            sender: sender,
					            data  : message
					        });
					    };
					   
					   socket.on('message', config.onmessage);
                    },
                    onRemoteStream: function(htmlElement) {
                        videosContainer.insertBefore(htmlElement, videosContainer.firstChild);
                        htmlElement.play();
                        jQuery('#converting').fadeOut();
                    },
                    onRoomFound: function(room) {
                        var alreadyExist = document.querySelector('button[data-broadcaster="' + room.broadcaster + '"]');
                        if (alreadyExist) return;

                        if (typeof roomsList === 'undefined') roomsList = document.body;
						
						jQuery('.converting_title').append(' <?php _e('Conectando...', 'adt') ?>');
						
                        roomsList.innerHTML = '<li>' + room.roomName + ' <?php _e('is broadcasting his media', 'adt') ?></li>';
                        
                        // Vemos o stream
                        setTimeout(function(){
                            broadcastUI.joinRoom({
                                roomToken: room.broadcaster,
                                joinUser: room.broadcaster
                            });
                            hideUnnecessaryStuff();
                            },100);
                    },
                    onNewParticipant: function(numberOfViewers) {
                    	visitantes.innerHTML = numberOfViewers;
                        document.title = 'Viewers: ' + numberOfViewers;
                    }
                };

                function setupNewAudioBroadcastButtonClickHandler() {
                    shared = 'audio';
                    captureUserMedia(function() {
                        broadcastUI.createRoom({
                            roomName: '<?php echo $current_user->user_login; ?>_<?php echo( basename(get_permalink()) ); ?>',
                            isAudio: shared === 'audio'
                        });
                    });
                    hideUnnecessaryStuff();
                }

                function setupNewVideoBroadcastButtonClickHandler() {
                    shared = 'video';
                    captureUserMedia(function() {
                        broadcastUI.createRoom({
                            roomName: '<?php echo $current_user->user_login; ?>_<?php echo( basename(get_permalink()) ); ?>',
                            isAudio: shared === 'video'
                        });
                    });
                    hideUnnecessaryStuff();
                }

                function captureUserMedia(callback) {
                    var constraints = null;
                    if (shared === 'audio') {
                        constraints = {
                            audio: true,
                            video: false
                        };
                    }else if(shared === 'video'){
                        constraints = {
                            audio: true,
                            video: true
                        };	                    
                    }
					
					// we create video element container for streaming
                    var htmlElement = document.createElement(shared === 'audio' ? 'audio' : 'video');
                    htmlElement.setAttribute('autoplay', true);
                    htmlElement.setAttribute('controls', true);
                    videosContainer.insertBefore(htmlElement, videosContainer.firstChild);

                    var mediaConfig = {
                        video: htmlElement,
                        onsuccess: function(stream) {
                            config.attachStream = stream;
                            callback && callback();

                            htmlElement.setAttribute('muted', true);
                        },
                        onerror: function() {
                            if (shared === 'Only Audio') alert('unable to get access to your microphone');
                            else alert('unable to get access to your webcam');
                        }
                    };
                    if (constraints) mediaConfig.constraints = constraints;
                    getUserMedia(mediaConfig);
                }

                var broadcastUI = broadcast(config);

                /* UI specific */
                var videosContainer = document.getElementById('videos-container') || document.body;
                var setupNewAudioBroadcast = document.getElementById('stream_audio');
                var setupNewVideoBroadcast = document.getElementById('stream_audio_video');
                var roomsList = document.getElementById('rooms-list');
                var visitantes = document.getElementById('num_viewers');


                if (setupNewAudioBroadcast) setupNewAudioBroadcast.onclick = setupNewAudioBroadcastButtonClickHandler;
                if (setupNewVideoBroadcast) setupNewVideoBroadcast.onclick = setupNewVideoBroadcastButtonClickHandler;

                function hideUnnecessaryStuff() {
                    var visibleElements = document.getElementsByClassName('visible'),
                        length = visibleElements.length;
                    for (var i = 0; i < length; i++) {
                        visibleElements[i].style.display = 'none';
                    }
                    document.getElementById('stream_audio').disabled = true;
                    document.getElementById('stream_audio_video').disabled = true;
                }

            </script>						
			
        </article> 
        
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
