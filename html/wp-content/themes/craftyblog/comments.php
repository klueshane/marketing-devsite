<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package enlighten
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

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">

			<?php
				printf( _nx( '1 Comments', '%1$s Comments',
						get_comments_number(), 'enlighten' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'enlighten' ); ?></h1>
			<?php
			$args = array(
				'prev_text' => '<span class="genericon genericon-previous"></span>',
				'next_text' => '<span class="genericon genericon-next"></span>',
			);
			paginate_comments_links( $args );
			?>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
			$args = array(
				'style'             => 'ol',
				'callback'          => null,
				'end-callback'      => null,
				'type'              => 'all',
				'reply_text'        => 'Reply',
				'page'              => '',
				'per_page'          => '',
				'avatar_size'       => 75,
				'reverse_top_level' => null,
				'reverse_children'  => '',
				'format'            => 'html5', //or xhtml if no HTML5 theme support
			);
				wp_list_comments($args);
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'enlighten' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'enlighten' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'enlighten' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'enlighten' ); ?></p>
	<?php endif; ?>
	<?php comment_form(); ?>

</div><!-- #comments -->
