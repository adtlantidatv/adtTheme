<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<?php  
	if ( 'collaborator' == get_post_type() ){
		$style = 'black';
	}else{
		$style = 'white';
	}
?>

<body <?php body_class($style); ?>>
	<nav id="menu_principal" class="menu_left menu_black">
		<div class="container relative">
			<div class="row">
			
			<?php 
			if ( is_user_logged_in() ) {
				global $current_user;
				?>
				<div class="span6">
					<div class="margin_top_100">
						<h1><?php _e('Dashboard', 'adt'); ?></h1>
						<ul class="clean_ul">
							<li><a href="<?php echo get_author_posts_url($current_user->ID); ?>"><?php _e('My works', 'adt'); ?></a></li>
							<li><a href="/subir" title="<?php _e('Upload a work', 'adt'); ?>"><?php _e('Upload a work', 'adt'); ?></a></li>
							
							<?php if(current_user_can('edit_private_pages')){ ?>
							<li><a href="/stream" title="<?php _e('Add a stream', 'adt'); ?>"><?php _e('Add a stream', 'adt'); ?></a></li>
							<li><a href="/multistream" title="<?php _e('Add a multistream', 'adt'); ?>"><?php _e('Add a multistream', 'adt'); ?></a></li>
							<?php } ?>
							
							<li><a href="<?php echo wp_logout_url( home_url() ); ?>" title="<?php _e('Log out', 'adt'); ?>"><?php _e('Log out', 'adt'); ?></a></li>
						</ul>
					</div>
				</div>
			<?php } ?>			
			
				<div class="span6">
					<div class="margin_top_100">
						<h1><?php _e('Adtlantida.tv', 'adt'); ?></h1>
						<?php wp_nav_menu( array('theme_location' => 'footer', 'menu_class' => 'reset') ); ?>
			
						<a href="#" class="close_menu_black" title="cerrar menu"></a>
					</div>
				</div>
			</div>
		</div>
	</nav>
	
	<div class="container main_container">