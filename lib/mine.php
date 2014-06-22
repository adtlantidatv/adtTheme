<?php

function getFilesUrlByType($post_id){
	$files_url = array('webm'=>null, 'mp4'=>null, 'ogv'=>null, 'mp3'=>null, 'ogg'=>null);
	$webm_file = null;
	$post_attachments = get_children(array(
		'numberposts' => -1, 
		'post_parent' => $post_id, 
		'post_type' => 'attachment'));
	
	if ( $post_attachments ) {
		foreach ( $post_attachments as $attachment ) {
			switch(get_post_mime_type($attachment->ID)){
				case 'video/webm':
					$files_url['webm'] = wp_get_attachment_url($attachment->ID);
					break;
				case 'video/mp4':
					$files_url['mp4'] = wp_get_attachment_url($attachment->ID);
					break;
				case 'video/ogg':
					$files_url['ogv'] = wp_get_attachment_url($attachment->ID);
					break;
				case 'audio/mpeg':
					$files_url['mp3'] = wp_get_attachment_url($attachment->ID);
					break;
				case 'audio/ogg':
					$files_url['ogg'] = wp_get_attachment_url($attachment->ID);
					break;
			}
		}
	}					
	
	return $files_url;
}
	
if ( ! function_exists( 'adt_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function adt_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => '&larr;',
		'next_text' => '&rarr;',
	) );

	if ( $links ) :

	?>
	<nav class="paginacion" role="navigation">
		<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

?>