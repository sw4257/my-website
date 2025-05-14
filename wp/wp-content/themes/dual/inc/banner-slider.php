<?php
/**
 * Banner Slider Section.
 *
 * @package Dual
 */
if (!function_exists('dual_banner_section')) :

    function dual_banner_section()
    {

        $dual_default = dual_get_default_theme_options();
        $ed_slider_section = get_theme_mod('ed_slider_section', $dual_default['ed_slider_section']);
        $number_of_slider = get_theme_mod('number_of_slider', $dual_default['number_of_slider']);
        $dual_from_blog_section_cat = get_theme_mod('dual_from_blog_section_cat');
        if (!$ed_slider_section) {
            return;
        }

        $rtl = '';
        if (is_rtl()) {
            $rtl = 'dir="rtl"';
        }

        $slider_section_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($number_of_slider), 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($dual_from_blog_section_cat)));

        if ($slider_section_query->have_posts()): ?>

            <div class="theme-main-slider">
                <div class="wrapper">
                    <div class="theme-row">
                        <div class="column column-12">
                            <div class="main-slider-content">

                                <?php
                                while ($slider_section_query->have_posts()):
                                    $slider_section_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';  ?>
                                    <div class="slider-item">
                                        <article class="theme-news-article">
                                            <div class="theme-row-ghost">
                                                <div class="column column-8 column-sm-12">
                                                    <div class="data-bg data-bg-big" data-background='<?php echo esc_url($featured_image); ?>'></div>
                                                </div>

                                                <div class="column column-4 column-sm-12">
                                                    <div class="theme-article-detail">
                                                        <h2 class="entry-title entry-title-medium">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>

                                                        <div class="entry-meta entry-meta-bottom">
                                                            <div class="entry-meta">
                                                                <?php
                                                                dual_posted_by();
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php endwhile; ?>


                            </div>

                            <div class="main-slider-btns">
                                <button class="prev">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path fill="currentColor" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        </path>
                                    </svg>
                                </button>

                                <button class='next'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path fill="currentColor" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            wp_reset_postdata();
        endif;
    }

endif;

