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