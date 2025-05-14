<?php

/**
 * Related Posts Functions.
 *
 * @package Dual
 */
if (!function_exists('dual_related_posts')) :

    // Single Posts Related Posts.
    function dual_related_posts()
    {

        $dual_default = dual_get_default_theme_options();
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;

        $cats = get_the_category($post->ID);
        $category = array();
        if ($cats) {
            foreach ($cats as $cat) {
                $category[] = absint($cat->term_id);
            }
        }

        $related_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => array(absint($post->ID)), 'category__in' => $category));
        $dual_related_post = get_theme_mod('dual_related_post', $dual_default['dual_related_post']);

        if ($dual_related_post && $related_posts_query->have_posts()) : ?>

            <div class="theme-block related-posts-area">

                <?php $dual_related_section_title = get_theme_mod('dual_related_section_title', $dual_default['dual_related_section_title']);
                if ($dual_related_section_title) { ?>

                    <div class="theme-block-headline">
                        <h2 class="theme-block-title entry-title-big">
                            <?php echo esc_html($dual_related_section_title); ?>
                        </h2>
                    </div>

                <?php } ?>

                <div class="related-posts">

                    <?php while ($related_posts_query->have_posts()) :
                        $related_posts_query->the_post();

                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

                        <div class="related-post-item">
                            <div class="post-thumbnail">
                                <div class="post-thumbnail-effects">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <span class="data-bg data-bg-small" data-background="<?php echo esc_url($featured_image); ?>"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="post-content">

                                <header class="entry-header">
                                    <h3 class="entry-title entry-title-small">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </header>

                                <div class="entry-excerpt entry-excerpt-muted">
                                    <?php
                                    if (has_excerpt()) {
                                        the_excerpt();
                                    } else {
                                        echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                    } ?>
                                </div>

                                <div class="entry-meta">
                                    <?php
                                    dual_posted_by();
                                    ?>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>

                </div>

            </div>

<?php
            wp_reset_postdata();
        endif;
    }

endif;
add_action('dual_navigation_action', 'dual_related_posts', 20);
