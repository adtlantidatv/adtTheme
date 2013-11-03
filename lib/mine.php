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
	
?>