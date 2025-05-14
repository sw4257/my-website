<?php
/**
 * The template for displaying team items
 *
 * @package Chique Photography
 */

$number = get_theme_mod( 'chique_team_number', 5 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

$args['post_type'] = 'page';

for ( $i = 1; $i <= $number; $i++ ) {
	$chique_post_id = '';

	$chique_post_id = get_theme_mod( 'chique_team_page_' . $i );

	if ( $chique_post_id && '' !== $chique_post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$chique_post_id = pll_get_post( $chique_post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $chique_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby'] = $post__in;

if ( 0 === $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;
$loop     = new WP_Query( $args );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();
		$number = get_theme_mod( 'chique_team_number_' . ( absint( $loop ->current_post ) + 1 ) );

		$position     = get_post_meta( get_the_ID(), 'ect_team_position', true );?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'chique-hero-content' );
						} else {
							echo '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-825x825.jpg"/>';
						}
						?>
					</a>
				</div>
				<div class="entry-container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

						<div class="entry-meta">
							<span class="job-label"><?php echo esc_html( $position ); ?></span>
						</div>
					</header>

					<?php
					$excerpt = get_the_excerpt();

					echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->'; ?>
				</div><!-- .entry-container -->
			</div> <!-- .hentry-inner -->
		</article> <!-- .article -->
	<?php
	endwhile;
	wp_reset_postdata();
endif;
