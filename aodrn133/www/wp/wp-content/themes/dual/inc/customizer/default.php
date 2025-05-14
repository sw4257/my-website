<?php
/**
 * Default Values.
 *
 * @package Dual
 */

if (!function_exists('dual_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function dual_get_default_theme_options()
    {

        $dual_defaults = array();

        // Options.
        $dual_defaults['dual_header_banner_type']                   = 'media';
        $dual_defaults['header_text']                               = esc_html__('Hello World!','dual');
        $dual_defaults['header_button_label']                       = esc_html__('Sign Up','dual');
        $dual_defaults['ed_banner_slider_autoplay']                 = 1;
        $dual_defaults['ed_banner_slider_pagination']               = 0;
        $dual_defaults['ed_banner_slider_navigation']               = 1;
        $dual_defaults['ed_slider_section']                         = 1;
        $dual_defaults['number_of_slider']                          = 4;
        $dual_defaults['dual_archive_layout']                       = 'masonry';
        $dual_defaults['dual_column_layout']                        = 'masonry-layout-two';
        $dual_defaults['dual_pagination_layout']                    = 'numeric';
        $dual_defaults['dual_copyright_text']                       = esc_html__('All rights reserved.', 'dual');
        $dual_defaults['dual_header_search']                        = 1;
        $dual_defaults['ed_day_night_mode_switch']                  = 1;
        $dual_defaults['dual_body_font']                            = 'Open Sans';
        $dual_defaults['dual_heading_font']                         = 'Open Sans';
        $dual_defaults['dual_heading_weight']                       = '400';
        $dual_defaults['dual_heading_case']                         = 'normal';
        $dual_defaults['dual_heading_language']                     = 'latin';
        $dual_defaults['dual_related_post']                         = 1;
        $dual_defaults['dual_related_section_title']                = esc_html__('Related Post', 'dual');
        $dual_defaults['theme_navigation_type']                     = 'normal-navigation';
        $dual_defaults['dual_post_author']                          = 1;
        $dual_defaults['dual_post_date']                            = 1;
        $dual_defaults['dual_post_category']                        = 1;
        $dual_defaults['dual_post_tags']                            = 1;
        $dual_defaults['ed_footer_copyright']                       = 1;
        $dual_defaults['ed_preloader']                              = 1;
        $dual_defaults['ed_cursor_option']                          = 1;
        $dual_defaults['dual_ed_footer_scroll_top_button']          = 1;
        $dual_defaults['ed_header_search_recent_posts']             = 1;
        $dual_defaults['post_video_aspect_ration']                  = 'default';
        $dual_defaults['ed_header_search_top_category']             = 1;
        $dual_defaults['recent_post_title_search']                  = esc_html__('Recent Post','dual');
        $dual_defaults['top_category_title_search']                 = esc_html__('Top Category','dual');

        // Pass through filter.
        $dual_defaults = apply_filters('dual_filter_default_theme_options', $dual_defaults);

        return $dual_defaults;

    }

endif;
