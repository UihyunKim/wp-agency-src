<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area border-top w-100">

	<?php if ( have_comments() ) : ?>
		<h3 class="mb-4 comments-title text-uppercase font-weight-bold my-4">
			<?php
				$comments_number = get_comments_number();
				
				echo $comments_number . " comment";
				if ( '1' !== $comments_number ) {
					echo "s";
				}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php 
				wp_list_comments("type=comment&avatar_size=70&callback=format_comment");
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'wp-agency' ); ?></p>
	<?php endif; ?>

	<?php
		$fields_author =  '<div class="comment-form-author form-group">' . 
												'<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' . 
												'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" class="form-control"' . $aria_req . $html_req . ' />' .
											'</div>';
		$fields_email = 	'<div class="comment-form-email form-group">' .
												'<label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
												'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" class="form-control" aria-describedby="email-notes"' . $aria_req . $html_req  . '/>' . 
											'</div>';
		$fields_url = 		'<div class="comment-form-url form-group">' . 
												'<label for="url">' . __( 'Website' ) . '</label>' . 
												'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" class="form-control" />' . 
											'</div>';
		$comment_field = '<div class="comment-form-comment form-group">
												<textarea id="comment" name="comment" aria-required="true" class="form-control"></textarea>
											</div>';
		$submit_field = '<div class="form-submit form-group my-5">%1$s %2$s</div>';
		$submit_button = '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-outline-primary btn-block text-uppercase" value="%4$s" />';

		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title text-uppercase font-weight-bold mt-5">',
			'title_reply' => 'add comment',
			'title_reply_after'  => '</h2>',
			'comment_notes_before' => '',
			'comment_field' => $comment_field,
			'fields' => array(
				'author' => $fields_author,
				'email' => $fields_email,
				'url' => $fields_url,
			),
			'submit_button' => $submit_button,
			'submit_field' => $submit_field,
		) );
	?>

</div><!-- .comments-area -->
