<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dual
 * @since 1.0.0
 */
get_header();

    $dual_default = dual_get_default_theme_options();
    $dual_archive_layout = get_theme_mod( 'dual_archive_layout', $dual_default['dual_archive_layout'] );
    $dual_column_layout = get_theme_mod( 'dual_column_layout', $dual_default['dual_column_layout'] );

    if( $dual_archive_layout == 'metro' ){ ?>
            <?php dual_aside_latest_metro_post(); ?>
    <?php
    }else{ ?>

        <div class="archive-main-block">
            <div id="primary" class="content-area">
                <main id="site-content" role="main">
                    <?php
                    if( have_posts() ): ?>
                        
                        <div class="article-wraper <?php echo 'archive-layout-' . esc_attr( $dual_archive_layout ); ?> <?php echo esc_attr($dual_column_layout);?>">
                            <?php while (have_posts()) :
                                the_post();

                                get_template_part( 'template-parts/content', get_post_format() );

                            endwhile; ?>
                        </div>

                        <?php do_action('dual_archive_pagination');

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif; ?>
                </main>
            </div>
        </div>

    <?php } ?>

<?php get_footer();
