<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to buildcon_lite_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package Buildcon Lite
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment! 
		if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( 
					/* translators: 1: number of comments, 2: post title */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'buildcon-lite' ) ),
					esc_attr(number_format_i18n( get_comments_number() )),
					'<span>' . esc_html(get_the_title()) . '</span>'
				);
			?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'buildcon-lite' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'buildcon-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'buildcon-lite' ) ); ?></div>
		</nav><!-- #comment-nav-above --><div class="clear"></div>
		<?php endif; // check for comment navigation ?>
		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use buildcon_lite_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define buildcon_lite_comment() and that will be used instead.
				 * See buildcon_lite_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'buildcon_lite_comment' ) );
			?>
		</ol><!-- .comment-list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'buildcon-lite' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'buildcon-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'buildcon-lite' ) ); ?></div>
		</nav><!-- #comment-nav-below --><div class="clear"></div>
		<?php endif; // check for comment navigation 
			  endif; // have_comments() 

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'buildcon-lite' ); ?></p>
	<?php endif; 
		  comment_form(); ?>
</div><!-- #comments -->