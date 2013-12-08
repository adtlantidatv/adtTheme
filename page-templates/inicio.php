<?php
/**
 * Template Name: Inicio Template
 *
 */

get_header('home'); ?>

<div class="container_home<?php if ( is_user_logged_in() ) {echo ' centrar'; } ?>">
	<div class="container">
		<!--
		<div class="span1 offset4"><a href="#" class="btn_01 margin_top_50"><?php _e('info', 'adt'); ?></a></div>
		-->
		<div class="offset5 span2">
			<a href="#" id="adt_menu" title="<?php _e('Adtlantida.tv menu', 'adt'); ?>" class="btn_03"></a>
			<?php if ( !is_user_logged_in() ) {?> 
				<?php wp_login_form( array('label_username' => __( 'user' ), 'label_password' => __( 'pass' ), 'label_log_in' => __('bucea'), 'remember' => true, 'value_remember' => true) ); ?>
			<?php } ?>
		</div>
				<!--
		<div class="span1"><a href="#" class="btn_01 margin_top_50"><?php _e('login!', 'adt'); ?></a></div>
		-->
	</div>
	
</div>

<?php get_footer(); ?>