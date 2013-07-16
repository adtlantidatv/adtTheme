<?php
if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

		// Proceed with normal comments.
		global $post;
	?>
		<article id="comment-<?php comment_ID(); ?>" class="row margin_bottom_30">
			<div class="span1">
				<?php  
					$html = get_avatar( $comment->user_id, apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') );
					$src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($html))->xpath("//img/@src"));
				?>
				<a href="<?php echo esc_url( get_author_posts_url( $comment->user_id ) ); ?>" rel="author" class="author_link" style="background-image:url(<?php echo $src; ?>)">
					<?php echo get_avatar( $comment->user_id, apply_filters( 'twentytwelve_author_bio_avatar_size', 70 ), null, __('author avatar', 'adt') ); ?>
				</a>
				
				<?php  
					printf( '<time datetime="%1$s">%2$s</time>',
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						get_comment_date('d.m.Y')
					);					
				?>				
			</div>
			
			<div class="span7">
				<div class="text">
					<?php comment_text(); ?>
					
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
					<?php endif; ?>
					
					<?php if ( current_user_can('edit_post', $comment->comment_post_ID) ) {
					$url = clean_url(wp_nonce_url( "/wp-admin/comment.php?action=deletecomment&p=$comment->comment_post_ID&c=$comment->comment_ID", "delete-comment_$comment->comment_ID" ));
					echo "<a href='$url' class='delete:the-comment-list:comment-$comment->comment_ID delete'>" . __('Delete') . "</a> ";
					} ?>				
					
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'add_below' => 'section.row' ) ) ); ?>

				</div>
			</div>

		</article><!-- #comment-## -->
	<?php
}
endif;
