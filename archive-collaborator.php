<?php get_header(); ?>

	<div class="row margin_top_30">
		<div class="span1">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_01 white"></a>
		</div>
		<div class="span11">
			<h1><?php _e('Adtlantida.tv staff', 'adt') ?></h1>
		</div>
	</div>

<?php 
$query = new WP_Query(array( 
				'post_type' => 'collaborator',
				'posts_per_page' => '-1', 
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'categories',
						'field' => 'slug',
						'terms' => 'cofinanciadorxs'
					)
				)
			) );

	if ( $query->have_posts() ) : ?>
	<div class="row">
	<h2 class="offset1"><?php _e('Cofinancing', 'adt'); ?></h2>
	<div class="offset1 margin_bottom_30"><?php _e('Cofinancing description', 'adt'); ?></div>
	<ul class="clean_ul margin_top_20 listado_colaboradores">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<li class="span3 margin_bottom_5">
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				<a href="<?php echo get_post_meta( get_the_ID(), 'adt_web_url', true ); ?>" title="<?php _e('personal website of '); ?><?php the_title(); ?>" target="_blank">
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
	</div>
<?php endif; ?>

<?php 
$query = new WP_Query(array( 
				'post_type' => 'collaborator',
				'posts_per_page' => '-1', 
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'categories',
						'field' => 'slug',
						'terms' => 'traductorxs'
					)
				)
			) );

	if ( $query->have_posts() ) : ?>
	<div class="row">
	<h2 class="offset1 margin_top_30"><?php _e('Translators', 'adt'); ?></h2>
	<div class="offset1 margin_bottom_30"><?php _e('Translators description', 'adt'); ?></div>
	<ul class="clean_ul margin_top_20 listado_colaboradores">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<li class="span3 margin_bottom_5">
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				<a href="<?php echo get_post_meta( get_the_ID(), 'adt_web_url', true ); ?>" title="<?php _e('personal website of '); ?><?php the_title(); ?>" target="_blank">
			<?php } ?>
			<?php the_title(); ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_facebook_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_facebook_url', true ).'" title="facebook" target="_blank"><i class="icon-facebook"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_twitter_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_twitter_url', true ).'" title="twitter" target="_blank"><i class="icon-twitter"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_google_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_google_url', true ).'" title="google plus" target="_blank"><i class="icon-google-plus"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_traduccion', true )){echo '<i>' . get_post_meta( get_the_ID(), 'adt_traduccion', true ).'</i>';} ?>
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				</a>
			<?php } ?>
		</li>
		<?php endwhile; ?>
	</ul>
	</div>
<?php endif; ?>

<?php 
$query = new WP_Query(array( 
				'post_type' => 'collaborator',
				'posts_per_page' => '-1', 
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'categories',
						'field' => 'slug',
						'terms' => 'coordinadorxs'
					)
				)
			) );

	if ( $query->have_posts() ) : ?>
	<div class="row">
	<h2 class="offset1 margin_top_30"><?php _e('Coordinators', 'adt'); ?></h2>
	<div class="offset1 margin_bottom_30"><?php _e('Coordinators of the project:', 'adt'); ?></div>
	<ul class="clean_ul margin_top_20 listado_colaboradores">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<li class="span3 margin_bottom_5">
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				<a href="<?php echo get_post_meta( get_the_ID(), 'adt_web_url', true ); ?>" title="<?php _e('personal website of '); ?><?php the_title(); ?>" target="_blank">
			<?php } ?>
			<?php the_title(); ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_facebook_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_facebook_url', true ).'" title="facebook" target="_blank"><i class="icon-facebook"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_twitter_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_twitter_url', true ).'" title="twitter" target="_blank"><i class="icon-twitter"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_google_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_google_url', true ).'" title="google plus" target="_blank"><i class="icon-google-plus"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_traduccion', true )){echo '<i>' . get_post_meta( get_the_ID(), 'adt_traduccion', true ).'</i>';} ?>
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				</a>
			<?php } ?>
		</li>
		<?php endwhile; ?>
	</ul>
	</div>
<?php endif; ?>

<?php 
$query = new WP_Query(array( 
				'post_type' => 'collaborator',
				'posts_per_page' => '-1', 
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'categories',
						'field' => 'slug',
						'terms' => 'soporte'
					)
				)
			) );

	if ( $query->have_posts() ) : ?>
	<div class="row">
	<h2 class="offset1 margin_top_30"><?php _e('Supported by', 'adt'); ?></h2>
	<ul class="clean_ul margin_top_20 listado_colaboradores">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<li class="span3 margin_bottom_5">
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				<a href="<?php echo get_post_meta( get_the_ID(), 'adt_web_url', true ); ?>" title="<?php _e('personal website of '); ?><?php the_title(); ?>" target="_blank">
			<?php } ?>
			<?php the_title(); ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_facebook_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_facebook_url', true ).'" title="facebook" target="_blank"><i class="icon-facebook"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_twitter_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_twitter_url', true ).'" title="twitter" target="_blank"><i class="icon-twitter"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_google_url', true )){echo '<a href="'.get_post_meta( get_the_ID(), 'adt_google_url', true ).'" title="google plus" target="_blank"><i class="icon-google-plus"></i></a>';} ?>
			<?php if(get_post_meta( get_the_ID(), 'adt_traduccion', true )){echo '<i>' . get_post_meta( get_the_ID(), 'adt_traduccion', true ).'</i>';} ?>
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				</a>
			<?php } ?>
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				<a href="<?php echo get_post_meta( get_the_ID(), 'adt_web_url', true ); ?>" title="<?php _e('personal website of '); ?><?php the_title(); ?>" target="_blank">
			<?php } ?>
				<?php the_post_thumbnail('zpan3_false'); ?>
			<?php if( get_post_meta( get_the_ID(), 'adt_web_url', true ) ){ ?>
				</a>
			<?php } ?>
			
		</li>
		<?php endwhile; ?>
	</ul>
	</div>
<?php endif; ?>

<?php get_footer(); ?>