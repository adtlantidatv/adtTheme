<?php
/**
 * Template Name: Player Stream
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
<html class="embed_stream_player" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/webrtc/socket.io.js"> </script>
	<?php wp_head(); ?>
	
	<!-- scripts used for broadcasting -->
	<!-- <script type="text/javascript" src="https://www.webrtc-experiment.com/RTCPeerConnection-v1.5.js"> </script> -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/RTCPeerConnection-v1.5.js"> </script>
	<script type="text/javascript" src="https://www.webrtc-experiment.com/webrtc-broadcasting/broadcast.js"> </script>
	
</head>
<body <?php body_class($style); ?>>
<?php global $current_user;
      get_currentuserinfo();
	if ( current_user_can('edit_post', $post->ID) ) {
		$admin = true;
	}else{
		$admin = false;
	}
      
?>
	<?php
if(isset($_GET["id"]) && $_GET["id"] != ""){
	$id_post = $_GET["id"];
	$query = new WP_Query( array('p' => $id_post, 'post_type' => 'streams') );

	while ( $query->have_posts() ) : $query->the_post();
		?>
				<!-- Comprobando si hai streamings -->
					<div id="converting" class="embed">
					<div class="converting_warper">
						<div class="converting_text">
						<!--
							<div class="adt_loading"></div>
							-->
							<div class="embed_bottons clearfix">
								<div class="adt_loading"></div>		
								<a href="#" class="play_stream"><?php _e('play', 'adt'); ?></a>					
							</div>
							
							<div class="converting_descrip"></div>
						</div>
					</div>
					</div>
			
        	        
				<div id="videos-container"></div>
		                              
		
			
            <script>
                // Muaz Khan     - https://github.com/muaz-khan
                // MIT License   - https://www.webrtc-experiment.com/licence/
                // Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/webrtc-broadcasting

				var SIGNALING_SERVER = 'http://147.83.72.228:1984/';
				var mainStream;
				var shared = 'audio';
				var playing = false;

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
                        console.log('lalo');
                    },
                    onRoomFound: function(room) {
                        var alreadyExist = document.querySelector('button[data-broadcaster="' + room.broadcaster + '"]');
                        if (alreadyExist) return;
						jQuery('.converting_descrip').append('<br /><?php _e('Conectando...', 'adt') ?>');
						                        
                        // Vemos o stream
                        setTimeout(function(){
                            broadcastUI.joinRoom({
                                roomToken: room.broadcaster,
                                joinUser: room.broadcaster
                            });
                            },100);
                    },
                    onNewParticipant: function(numberOfViewers) {
                    }
                };

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

                var broadcastUI;
				jQuery(document).ready(function() {

	            	jQuery('.play_stream').click(function(){
	            		if(!playing){
			                broadcastUI = broadcast(config);
						   jQuery('.converting_descrip').append('<?php _e('Comprobando si hai algunha emisión...', 'adt'); ?>');
						   jQuery('.adt_loading').addClass('animation_spin');
						   jQuery('.play_stream').addClass('apagado');
						   playing = true;
					   }
		                return false;	            	
	            	});
				});
                /* UI specific */
                var videosContainer = document.getElementById('videos-container') || document.body;

            </script>						
			        
<?php endwhile; // end of the loop. ?>
<?php get_footer('full'); ?>
<?php } ?>
</body>
