<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Buildcon Lite
 */
 
/**
 * Returns true if a blog has more than 1 category
 */


if ( ! function_exists( 'buildcon_lite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 */
function buildcon_lite_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

if ( ! function_exists( 'buildcon_lite_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function buildcon_lite_comment( $comment, $args, $depth ) {
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'buildcon-lite' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html( 'Edit', 'buildcon-lite' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	<?php else : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, 34 ); ?>
				</div><!-- .comment-author -->
				<div class="comment-metadata">
					<?php printf( '<cite class="fn">%s</cite> on', get_comment_author_link() ); ?>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( '%1$s | %2$s', esc_attr(get_comment_date()), esc_attr(get_comment_time()) ); ?>
						</time>
					</a>
					<?php edit_comment_link( esc_html( 'Edit', 'buildcon-lite' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'buildcon-lite' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->
			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->
	<?php     
	endif;
}
endif; // ends check for buildcon_lite_comment()

if ( ! function_exists( 'buildcon_lite_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function buildcon_lite_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'buildcon_lite_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) ); wp_reset_postdata();
	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}
		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );
		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}
	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;
if ( ! function_exists( 'buildcon_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function buildcon_lite_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);
	printf( // WPCS: XSS OK
                '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
                wp_kses_post( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'buildcon-lite' ) ),
                esc_url( get_permalink() ),
                esc_html($time_string)
            );
}
endif;