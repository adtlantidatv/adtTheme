<?php
/**
 * Template Name: Player Audio
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

</head>

<body <?php body_class(); ?>>

	<?php
if(isset($_GET["id"]) && $_GET["id"] != ""){

	$id_post = $_GET["id"];
	$files = getFilesUrlByType($id_post);

	$query = new WP_Query( array('p' => $id_post) );

	while ( $query->have_posts() ) : $query->the_post();
		?>

<div id="audio-post-<?php the_ID(); ?>" class="audio_contenedor">
	<audio>
		<?php if($files['mp3']){ ?>
		<source src="<?php echo $files['mp3']; ?>" type="audio/mpeg" />
		<?php } ?>
		<?php if($files['ogg']){ ?>
		<source src="<?php echo $files['ogg']; ?>" type="audio/ogg" />
		<?php } ?>
	</audio>
	<a class="btn_01 play" href="#">play!</a>
	<div class="timer"><span class="actual">0:00</span> / <span class="total">0:00</span></div>
	<div class="controles"><a href="#" class="mute"><?php _e('mute', 'adt'); ?></a></div>
	<?php the_post_thumbnail('full', array('class' => 'waveform')); ?>
	<div class="lendo"></div>
	<div class="soado"></div>	
</div>

<script type="text/javascript">
		<?php if($files['ogg']){ ?>
			soundManager.setup({preferFlash: false, useFlashBlock: false});
		<?php }else{ ?>
			soundManager.setup({url: '<?php echo get_template_directory_uri(); ?>/lib/soundmanager/swf/', preferFlash: true});
		<?php } ?>
	soundManager.onready(function() {
		var thisSound = null;
		jQuery('.audio_contenedor a.play').each(function(){
			soando = function(){
				jQuery('.audio_contenedor .timer .total').empty().html(getTime(thisSound.durationEstimate,true));
				jQuery('.audio_contenedor .timer .actual').empty().html(getTime(this.position,true));
				
				var ancho = ((this.position/thisSound.durationEstimate)*100)+'%';
				jQuery('.audio_contenedor .soado').width(ancho);
			}
			
			lendo = function(){
				//console.log(thisSound.bytesLoaded);
			}

			getTime = function(nMSec, bAsString) {
			    // convert milliseconds to mm:ss, return as object literal or string
			    var nSec = Math.floor(nMSec/1000),
			        min = Math.floor(nSec/60),
			        sec = nSec-(min*60);
			    // if (min === 0 && sec === 0) return null; // return 0:00 as null
			    return (bAsString?(min+':'+(sec<10?'0'+sec:sec)):{'min':min,'sec':sec});
			};													
			
			sound_url = jQuery(this).siblings('audio').children('source').attr('src');
			thisSound = soundManager.createSound({
				url: sound_url,
				whileloading: lendo,
				whileplaying: soando
			});							
			
			jQuery(this).click(function(){
				thisSound.togglePause();				
				if(thisSound.paused){
					jQuery(this).empty().html('play!');
				}else{
					jQuery(this).empty().html('pause!');									
				}
				
				return false;
			});

			jQuery('.audio_contenedor').click(function(e){
				console.log(e.pageX);
				var location = Math.round( ( thisSound.duration * ( e.pageX - jQuery('.audio_contenedor').offset().left ) ) / jQuery('.audio_contenedor').width() );
				console.log(location);
				thisSound.setPosition(location);
			});
			
			console.log(jQuery('.audio_contenedor').offset().left);
			
			jQuery(this).siblings('.controles').children('.mute').click(function(){
				thisSound.toggleMute();	
			});
			

		});

	    jQuery('a.share').click(function(){
	    	jQuery('body').addClass('go_left_50');
	    	jQuery('.menu_right').addClass('pushed');
			return false;
	    });		
		
	});

</script>





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