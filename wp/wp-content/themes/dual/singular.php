<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dual
 * @since 1.0.0
 */
get_header();

    $dual_default = dual_get_default_theme_options();
    $theme_navigation_type = get_post_meta( get_the_ID(), 'theme_disable_ajax_load_next_post', true );
  
    global $post;
    $single_layout_class = ' single-layout-default';

    if( $theme_navigation_type == '' || $theme_navigation_type == 'global-layout' ){
        $theme_navigation_type = get_theme_mod('theme_navigation_type', $dual_default['theme_navigation_type']);
    }
    $dual_ed_post_rating = get_post_meta( $post->ID, 'dual_ed_post_rating', true );?>

    <div class="singular-main-block">
        <div class="wrapper">
            <div class="theme-row">

                <div id="primary" class="content-area">
                    <main id="site-content" class="<?php if( $dual_ed_post_rating ){ echo 'dual-no-comment'; } ?>" role="main">

                        <?php

                        if( have_posts() ): ?>

                            <div class="article-wraper">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/

                                    if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                        <div class="comments-wrapper">
                                            <?php comments_template(); ?>
                                        </div><!-- .comments-wrapper -->

                                    <?php
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :
                            
                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         *
                         * @hooked dual_related_posts - 20  
                         * @hooked dual_single_post_navigation - 30  
                        */
                        if ('post' === get_post_type()) {
                            do_action('dual_navigation_action');
                        } ?>

                    </main><!-- #main -->
                </div>

            </div>
        </div>
    </div>

<?php
get_footer();
