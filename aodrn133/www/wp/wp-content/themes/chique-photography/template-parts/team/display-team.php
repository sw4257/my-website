<?php
/**
 * The template for displaying team content
 *
 * @package Chique Photography
 */

$enable_content = get_theme_mod( 'chique_team_option', 'disabled' );

if ( ! chique_check_section( $enable_content ) ) {
	// Bail if team content is disabled.
	return;
}

$chique_title = get_theme_mod( 'chique_team_title' );
$sub_title    = get_theme_mod( 'chique_team_sub_title' );

$classes[] = 'team-section';
$classes[] = 'section';
$classes[] = 'text-aligned-center';

if ( ! $chique_title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="team-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="team-content-wrapper section-content-wrapper layout-three">

			<?php if ( $chique_title || $sub_title  ) : ?>
				<div class="section-heading-wrapper">
					<?php if ( $chique_title ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title"><?php echo wp_kses_post( $chique_title ); ?></h2>
						</div><!-- .page-title-wrapper -->
					<?php endif; ?>

					<?php if ( $sub_title ) : ?>
						<div class="section-description">
							<?php echo wp_kses_post( $sub_title ); ?>
						</div><!-- .section-description -->
					<?php endif; ?>
				</div><!-- .section-heading-wrapper -->
			<?php endif; ?>

			<?php get_template_part( 'template-parts/team/post-types-team' ); ?>
		</div><!-- .team-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #team-section -->
