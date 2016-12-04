<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments">
	<div id="content">
		<section class="comments-area">
			<?php	comment_form(); ?>

			<?php if ( have_comments() ) : ?>
				<h2>Comments</h2>
				
				<div class="comment-list">
					<?php
						wp_list_comments( array(
							'style'       => 'div',
							'short_ping'  => true,
							'avatar_size' => 42,
						) );
					?>
				</div><!-- .comment-list -->

				<?php the_comments_navigation(); ?>

			<?php endif; // Check for have_comments(). ?>

			<?php	// If comments are closed and there are comments, let's leave a little note, shall we?
				if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
				<p class="no-comments"><?php _e( 'Comments are closed.', 'twentysixteen' ); ?></p>
			<?php endif; ?>
		</article>
	</div>
</div><!-- .comments-area -->
