<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<article class="video">
	<div class="row">
		<div class="span9_eat_gutter">
			<video poster="<?php echo $url; ?>" height="270" width="480" controls="">
				<?php if(get_post_meta($post->ID, 'adt_stream_url_mp4', true)){ ?>
			    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_mp4', true); ?>" type="video/mp4">
			    <?php } ?>
				<?php if(get_post_meta($post->ID, 'adt_stream_url_webm', true)){ ?>
			    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_webm', true); ?>" type="video/webm">
			    <?php } ?>
				<?php if(get_post_meta($post->ID, 'adt_stream_url_ogv', true)){ ?>
			    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_ogv', true); ?>" type="video/ogg">
			    <?php } ?>
				<?php if(get_post_meta($post->ID, 'adt_stream_url_other', true)){ ?>
			    <source src="<?php echo get_post_meta($post->ID, 'adt_stream_url_other', true); ?>">
			    <?php } ?>
			    <p class="warning">Your browser does not support HTML5 video.</p>
			</video>
		</div>
		
		<div class="span3 remove_margin">
			<div class="chat">
				chat
			</div>
		</div>	
	</div>
	
	<div class="body row">
			
		<div class="span1">
			<ul class="main_menu reset">
				<li>
					<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/img/adt_logo.png" alt="<?php _e('Adtlantida.tv menu logo'); ?>" />
					</a>
				</li>
			
				<li>
					<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/user.png" /></a>
				</li>
				
				<li>
					<time><?php the_time('d.m.Y'); ?></time>
				</li>
			</ul>
		</div>
				
		<div class="span8">
			<h1><?php the_title(); ?></h1>
			<div class="width670 text">
				<?php the_content(); ?>
			</div>
		</div>
				
		<div class="span3">
			<?php if(get_post_meta($post->ID, 'adt_twitter_hashtag', true)){ ?>
				<aside>
					<div class="twitter">
						<h3><i class="icon-twitter"></i>#<?php echo get_post_meta($post->ID, 'adt_twitter_hashtag', true); ?></h3>
					</div>
				</aside>
				
				<script type="text/javascript">
					/* <![CDATA[ */

					window.ify=function(){var entities={'"':'"','&':'&','<':'<','>':'>'};return{"link":function(t){return t.replace(/[a-z]+:\/\/[a-z0-9-_]+\.[a-z0-9-_:~%&\?\/.=]+[^:\.,\)\s*$]/ig,function(m){return'<a href="'+m+'">'+((m.length>25)?m.substr(0,24)+'...':m)+'</a>';});},"at":function(t){return t.replace(/(^|[^\w]+)\@([a-zA-Z0-9_]{1,15})/g,function(m,m1,m2){return m1+'@<a href="http://twitter.com/'+m2+'">'+m2+'</a>';});},"hash":function(t){return t.replace(/(^|[^\w'"]+)\#([a-zA-Z0-9_]+)/g,function(m,m1,m2){return m1+'#<a href="http://search.twitter.com/search?q=%23'+m2+'">'+m2+'</a>';});},"clean":function(tweet){return this.hash(this.at(this.link(tweet)));}};}();

					jQuery.noConflict()(function($){
						$(document).ready(function() {
							var contido = '<ul class="reset">';
							$.getJSON('<?php echo get_template_directory_uri(); ?>/api/twitter/?hash=<?php echo get_post_meta($post->ID, 'adt_twitter_hashtag', true); ?>', function(data){
								$.each(data.statuses, function(i, chio){
									console.log(chio.user.screen_name);
									contido += '<li><a href="http://twitter.com/'+chio.user.screen_name+'" class="user">'+chio.user.screen_name+': </a>'+ify.clean(chio.text)+'</li>';
								});
								contido += '</ul>';
								
								$('.twitter').append(contido);
							});
						});
					});
					/* ]]> */
				</script>		
			<?php } ?>
		</div>
	
	</div>
</article>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>