<?php
/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * taken from twentytwelve theme
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function adt_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'adt' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'adt_wp_title', 10, 2 );

function redirect_login($redirect_to_calculated,$redirect_url_specified,$user){

/*if no redirect was specified,let us think ,user wants to be in wp-dashboard*/
if(empty($redirect_to_calculated))
    $redirect_to_calculated=admin_url();
 
    /*if the user is not site admin,redirect to his/her profile*/
    if(!is_admin($user->user_login))
        return get_author_posts_url($user->ID,$curauth->user_login);
    else
        return $redirect_to_calculated; /*if site admin or not logged in,do not do anything much*/
 
}

add_filter("login_redirect","redirect_login",100,3);

/* _____ New Mime Types __________________________________ */
function custom_mimes( $mimes ){
    $mimes['webm'] = 'video/webm';
    return $mimes;
}
add_filter( 'upload_mimes', 'custom_mimes' );

/* ******************************************************* */
/* _____ Custom login ____________________________________ */
/* _______________________________________________________ */

/* _____ Style ___________________________________________ */
function my_login_logo() { ?>
	<link rel='stylesheet' id='adt_login_css'  href='<?php echo get_bloginfo( 'template_directory' ) ?>/css/login.css' type='text/css' media='all' />

    <style type="text/css">
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/* _____ link ____________________________________________ */
function loginpage_custom_link() {
	return home_url();
}
add_filter('login_headerurl','loginpage_custom_link');

/* _____ rollover link ___________________________________ */
function change_title_on_logo() {
	return 'Adtlantida.tv';
}
add_filter('login_headertitle', 'change_title_on_logo');


/* ******************************************************* */
/* _____ Mail ____________________________________________ */
/* _______________________________________________________ */

/* _____ mail from name __________________________________ */
function adt_wp_mail_from_name( $email_from ){
	return 'Adtlantida.tv';
}
add_filter( 'wp_mail_from_name', 'adt_wp_mail_from_name' );

/* _____ mail from ______________________________________ */
function adt_wp_mail_from( $email_address ){
	return 'comunicacion@adtlantida.tv';
}
add_filter( 'wp_mail_from', 'adt_wp_mail_from' );


/* ******************************************************* */
/* _____ Chat ____________________________________________ */
/* _______________________________________________________ */

add_action( 'wp_enqueue_scripts', 'inputtitle_submit_scripts' );  
add_action( 'wp_ajax_ajax-inputtitleSubmit', 'myajax_inputtitleSubmit_func' );
add_action( 'wp_ajax_nopriv_ajax-inputtitleSubmit', 'myajax_inputtitleSubmit_func' );

function inputtitle_submit_scripts() {

    global $post_type;
	if($post_type == 'streams'){
	    wp_enqueue_script( 'inputtitle_submit', get_template_directory_uri() . '/lib/chat/save_chat.js', array( 'jquery' ), true);	
	    wp_localize_script( 'inputtitle_submit', 'PT_Ajax', array(
	        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
	        'nextNonce'     => wp_create_nonce( 'myajax-next-nonce' ))
	    );
	}
	
}
 
function myajax_inputtitleSubmit_func() {
	// check nonce
	$nonce = $_POST['nextNonce']; 	
	if ( ! wp_verify_nonce( $nonce, 'myajax-next-nonce' ) )
		die ( 'Busted!');

	update_post_meta($_POST['post'], 'adt_chat', $_POST['texto']);
 
	exit;
	
}

/* ******************************************************* */
/* _____ Pagination search bug ___________________________ */
/* _______________________________________________________ */

function custom_posts_per_page( $query ) {
 
    if ( $query->is_search() ) {
        set_query_var('posts_per_page', 1);
    }
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );