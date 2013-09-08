<?php
/**
 * Template Name: test
 *
 */
get_header();
?>

<?php
	$upload_dir = wp_upload_dir();
	$upload_dir_path = $upload_dir['path'].'/';

	$video_in = $upload_dir_path.'MVI_6949.mov';
	$video_out = $upload_dir_path.'MVI_6949.webm';
	$image_out = $upload_dir_path.'MVI_6949.jpg';

	echo $video_in; 
	echo '<br />';
	echo $video_out; 
	echo '<br />';
	echo $_SERVER["DOCUMENT_ROOT"];

	//exec("/usr/bin/ffmpeg -i ".$file_loc." -acodec libfaac -vcodec libx264 ".$upload_dir_path."/tirar.webm");
	
	// from mov to flv
	//exec("/usr/bin/ffmpeg -i ".$video_in." -vcodec libx264 -vpre medium -crf 23 -acodec libfaac -aq 100 -ar 22050 ".$video_out);
	
	// from mov to webm
	exec("/usr/bin/ffmpeg -i ".$video_in." -vcodec libvpx -b 1M -acodec libvorbis ".$video_out);
	
	// create one image
	exec("/usr/bin/ffmpeg -y -ss 00:00:00.435 -i ".$video_in." -qscale 1 -f mjpeg -vframes 1 ".$image_out);
	//exec("/usr/bin/ffmpeg -i ".$video_in." -ab 56 -ar 44100 -b 200 -r 15 -s 320x240 -f flv ".$video_out." &");
	//exec("/usr/bin/ffmpeg -i ".$video_in." -c:v libx264 -preset ultrafast -qp 0 ".$video_out."");
//	exec("/usr/bin/ffmpeg -i /home/adtlantida/dev.adtlantida.tv/wp-content/uploads/2013/07/MVI_69492.mov -acodec libfaac -vcodec libx264 -vpre normal -refs 1 -coder 1 -level 31 -threads 8 -partitions parti4x4+parti8x8+partp4x4+partp8x8+partb8x8 -flags +mv4 -trellis 1 -cmp 256 -me_range 16 -sc_threshold 40 -i_qfactor 0.71 -bf 0 -g 250 /home/adtlantida/dev.adtlantida.tv/wp-content/uploads/2013/07/MVI_69492.mp4");
	
	
	// insert video into post
	$wp_filetype = wp_check_filetype(basename($video_out), null );
	$attachment = array(
		'guid' => $upload_dir['url'] . '/' . basename( $video_out ), 
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', basename($video_out)),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$attach_video_id = wp_insert_attachment( $attachment, $video_out, 281 );
	
	// insert image into post
	$wp_filetype = wp_check_filetype(basename($image_out), null );
	$attachment = array(
		'guid' => $upload_dir['url'] . '/' . basename( $image_out ), 
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', basename($image_out)),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$attach_id = wp_insert_attachment( $attachment, $image_out, 281 );
  
	// you must first include the image.php file
	// for the function wp_generate_attachment_metadata() to work
	//add_post_meta(263, '_thumbnail_id', $attach_id, true);
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attach_data = wp_generate_attachment_metadata( $attach_id, $image_out );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	set_post_thumbnail( 281, $attach_id );
	?>

<?php get_footer(); ?>