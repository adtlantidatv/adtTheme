<?php get_header(); ?>

<?php 
$query = new WP_Query( array( 'post_type' => 'collaborator', 'posts_per_page' => '-1', 'order' => 'ASC'  ) );

	if ( $query->have_posts() ) : ?>
	<div class="row margin_top_30">
		<div class="span1">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01 white"></a>
		</div>
		<div class="span11">
			<h1><?php _e('collaborators', 'adt') ?></h1>
		</div>
	</div>
	
	<ul class="row clean_li margin_top_20 listado_colaboradores">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<li class="span3 margin_bottom_5">
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				<a href="<?php echo get_post_meta( get_the_ID(), 'adt_web_url', true ); ?>" title="<?php _e('web de '); ?><?php the_title(); ?>" target="_blank">
			<?php } ?>
			<?php the_title(); ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_facebook_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_facebook_url', true ).'" title="facebook" target="_blank"><i class="icon-facebook"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_twitter_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_twitter_url', true ).'" title="twitter" target="_blank"><i class="icon-twitter"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_google_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_google_url', true ).'" title="google plus" target="_blank"><i class="icon-google-plus"></i></a>';} ?>
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				</a>
			<?php } ?>
		</li>
		<?php endwhile; ?>
	</ul>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>