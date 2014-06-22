<?php
/**
 * Template Name: Audioleaks
 *
 */
 $url='';
 $user_id=get_current_user_id();
 $query = new WP_Query( array('author' => $user_id, 'post_type' => 'audioleaks' ));
 if ( $query->have_posts() ) :
 	while ( $query->have_posts() ) : $query->the_post();
 	$url = get_permalink();
 	endwhile;
 endif;
 ?>
<html>
<head>
	<?php if($url != ''){ ?>
	<meta http-equiv="refresh" content="0; url=<?php echo $url; ?>" />
	<?php } ?>
</head>
<body>
</body>
</html>