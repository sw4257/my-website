<?php

/**
 * Custom Functions.
 *
 * @package Dual
 */

if (!function_exists('dual_iframe_escape')) :

    /** Escape Iframe **/
    function dual_iframe_escape($input)
    {

        $all_tags = array(
            'iframe' => array(
                'width' => array(),
                'height' => array(),
                'src' => array(),
                'frameborder' => array(),
                'allow' => array(),
                'allowfullscreen' => array(),
            ),
            'video' => array(
                'width' => array(),
                'height' => array(),
                'src' => array(),
                'style' => array(),
                'controls' => array(),
            )
        );

        return wp_kses($input, $all_tags);
    }

endif;

if (!function_exists('dual_fonts_url')) :

    //Google Fonts URL
    function dual_fonts_url()
    {

        $font_families = array(
            'Cardo:wght@400;700',
            'Quattrocento+Sans:wght@400;700'

        );

        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');

        return esc_url_raw($fonts_url);
    }

endif;

if (!function_exists('dual_page_lists')) :

    // Page List.
    function dual_page_lists()
    {

        $page_lists = array();
        $page_lists[''] = esc_html__('Select Page', 'dual');

        $pages = get_pages(
            array(
                'parent' => 0, // replaces 'depth' => 1,
            )
        );

        foreach ($pages as $page) {

            $page_lists[$page->ID] = $page->post_title;
        }

        return $page_lists;
    }

endif;


if (!function_exists('dual_post_category_list')) :

    // Post Category List.
    function dual_post_category_list($select_cat = true)
    {

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if ($select_cat) {

            $post_cat_cat_array[''] = esc_html__('-- Select Category --', 'dual');
        }

        foreach ($post_cat_lists as $post_cat_list) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;
        }

        return $post_cat_cat_array;
    }

endif;

if (!function_exists('dual_sanitize_post_layout_option_meta')) :

    // Sidebar Option Sanitize.

    function dual_sanitize_post_layout_option_meta($input)
    {

        $metabox_options = array('global-layout', 'layout-1', 'layout-2');

        if (in_array($input, $metabox_options)) {

            return $input;
        } else {

            return '';
        }
    }

endif;

if (!function_exists('dual_the_theme_svg')) :

    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Dual_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function dual_the_theme_svg($svg_name, $return = false)
    {

        if ($return) {

            return dual_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in dual_get_theme_svg();.

        } else {

            echo dual_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in dual_get_theme_svg();.

        }
    }

endif;

if (!function_exists('dual_get_theme_svg')) :

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */

    function dual_get_theme_svg($svg_name)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = dual_svg_escape(Dual_SVG_Icons::get_svg($svg_name));

        if (!$svg) {

            return false;
        }

        return $svg;
    }

endif;

if (!function_exists('dual_svg_escape')) :

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function dual_svg_escape($input)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if (!$svg) {
            return false;
        }

        return $svg;
    }

endif;

if (!function_exists('dual_social_menu_icon')) :

    function dual_social_menu_icon($item_output, $item, $depth, $args)
    {

        // Add Icon
        if (isset($args->theme_location) && 'dual-social-menu' === $args->theme_location) {

            $svg = Dual_SVG_Icons::get_theme_svg_name($item->url);

            if (empty($svg)) {
                $svg = dual_the_theme_svg('link', $return = true);
            }

            $item_output = str_replace($args->link_after, '</span>' . $svg, $item_output);
        }

        return $item_output;
    }

endif;

add_filter('walker_nav_menu_start_el', 'dual_social_menu_icon', 10, 4);

if (!function_exists('dual_sub_menu_toggle_button')) :

    function dual_sub_menu_toggle_button($args, $item, $depth)
    {

        // Add sub menu toggles to the main menu with toggles
        if ($args->theme_location == 'dual-primary-menu' && isset($args->show_toggles)) {

            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after = '';

            // Add a toggle to items with children
            if (in_array('menu-item-has-children', $item->classes)) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $args->after .= '<button type="button" class="submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __('Show sub menu', 'dual') . '</span>' . dual_get_theme_svg('chevron-down') . '</span></button>';
            }
            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        } elseif ($args->theme_location == 'dual-primary-menu') {

            if (in_array('menu-item-has-children', $item->classes)) {

                $args->before = '<div class="link-icon-wrapper">';
                $args->after = dual_get_theme_svg('chevron-down') . '</div>';
            } else {

                $args->before = '';
                $args->after = '';
            }
        }

        return $args;
    }

endif;

add_filter('nav_menu_item_args', 'dual_sub_menu_toggle_button', 10, 3);

if (!function_exists('dual_post_category_list')) :

    // Post Category List.
    function dual_post_category_list($select_cat = true)
    {

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
            )
        );

        $post_cat_cat_array = array();
        if ($select_cat) {
            $post_cat_cat_array[''] = esc_html__('Select Category', 'dual');
        }

        foreach ($post_cat_lists as $post_cat_list) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;
        }

        return $post_cat_cat_array;
    }

endif;

if (!function_exists('dual_sanitize_meta_pagination')) :

    /** Sanitize Enable Disable Checkbox **/
    function dual_sanitize_meta_pagination($input)
    {

        $valid_keys = array('global-layout', 'no-navigation', 'normal-navigation', 'ajax-next-post-load');

        if (in_array($input, $valid_keys)) {
            return $input;
        }

        return '';
    }

endif;

if (!function_exists('dual_single_post_navigation')) :

    function dual_single_post_navigation()
    {

        $dual_default = dual_get_default_theme_options();
        $theme_navigation_type = get_post_meta(get_the_ID(), 'theme_disable_ajax_load_next_post', true);
        $dual_archive_layout = get_theme_mod('dual_archive_layout', $dual_default['dual_archive_layout']);
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;

        if ($theme_navigation_type == '' || $theme_navigation_type == 'global-layout') {
            $theme_navigation_type = get_theme_mod('theme_navigation_type', $dual_default['theme_navigation_type']);
        }

        if ($theme_navigation_type != 'no-navigation' && 'post' === get_post_type()) {

            if ($theme_navigation_type == 'normal-navigation') { ?>

                <div class="navigation-wrapper">

                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . dual_the_theme_svg('arrow-left', $return = true) . '</span><span class="screen-reader-text">' . __('Previous post:', 'dual') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . dual_the_theme_svg('arrow-right', $return = true) . '</span><span class="screen-reader-text">' . __('Next post:', 'dual') . '</span><span class="post-title">%title</span>',
                    )); ?>

                </div>

            <?php
            } else {

                $next_post = get_next_post();
                if (isset($next_post->ID)) {
                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint($next_post_id) . '" class="twp-single-infinity"></div>';
                }
            }
        }
    }

endif;

add_action('dual_navigation_action', 'dual_single_post_navigation', 30);

if (!function_exists('dual_header_toggle_search')) :

    /**
     * Header Search
     **/
    function dual_header_toggle_search()
    {
        $dual_default = dual_get_default_theme_options();
        $dual_header_search = get_theme_mod('dual_header_search', $dual_default['dual_header_search']);
        $ed_header_search_top_category = get_theme_mod('ed_header_search_top_category', $dual_default['ed_header_search_top_category']);
        $ed_header_search_recent_posts = absint(get_theme_mod('ed_header_search_recent_posts', $dual_default['ed_header_search_recent_posts']));

        if ($dual_header_search) { ?>
            <div class="header-searchbar">
                <div class="searchbar-wrapper">
                    <div class="close-searchbar">
                        <a class="skip-link-search-top" href="javascript:void(0)"></a>
                        <div class="search-close theme-close-controller">
                            <button type="button" id="search-closer" class="button-style button-transparent close-popup">
                                <?php dual_the_theme_svg('cross'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="header-searchbar-area">
                        <?php get_search_form(); ?>
                    </div>

                    <?php if ($ed_header_search_recent_posts || $ed_header_search_top_category) { ?>

                        <div class="search-content-area">

                            <?php if ($ed_header_search_recent_posts) { ?>

                                <div class="search-recent-posts">
                                    <?php dual_recent_posts_search(); ?>
                                </div>

                            <?php } ?>

                            <?php if ($ed_header_search_top_category) { ?>

                                <div class="search-popular-categories">
                                    <?php dual_header_search_top_cat_content(); ?>
                                </div>

                            <?php } ?>

                        </div>

                    <?php } ?>

                    <a class="skip-link-search-bottom-1" href="javascript:void(0)"></a>
                    <a class="skip-link-search-bottom-2" href="javascript:void(0)"></a>

                </div>
            </div>
        <?php
        }
    }

endif;

add_action('dual_before_footer_content_action', 'dual_header_toggle_search', 10);

if (!function_exists('dual_recent_posts_search')) :

    // Single Posts Related Posts.
    function dual_recent_posts_search()
    {

        $dual_default = dual_get_default_theme_options();
        $related_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts")));

        if ($related_posts_query->have_posts()) : ?>

            <div class="theme-block related-search-posts">

                <div class="theme-block-heading">
                    <?php
                    $recent_post_title_search = esc_html(get_theme_mod('recent_post_title_search', $dual_default['recent_post_title_search']));

                    if ($recent_post_title_search) { ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html($recent_post_title_search); ?>

                        </h2>
                    <?php } ?>
                </div>

                <div class="theme-list-group recent-list-group">

                    <?php
                    while ($related_posts_query->have_posts()) :
                        $related_posts_query->the_post();

                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium'); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-list-article'); ?>>
                            <header class="entry-header">
                                <h3 class="entry-title entry-title-medium">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </header>
                        </article>

                    <?php
                    endwhile; ?>

                </div>

            </div>

        <?php
            wp_reset_postdata();

        endif;
    }

endif;

if (!function_exists('dual_header_search_top_cat_content')) :

    function dual_header_search_top_cat_content()
    {

        $top_category = 3;

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $slug_counts = array();

        foreach ($post_cat_lists as $post_cat_list) {

            if ($post_cat_list->count >= 1) {

                $slug_counts[] = array(
                    'count'         => $post_cat_list->count,
                    'slug'          => $post_cat_list->slug,
                    'name'          => $post_cat_list->name,
                    'cat_ID'        => $post_cat_list->cat_ID,
                    'description'   => $post_cat_list->category_description,
                );
            }
        }

        if ($slug_counts) { ?>

            <div class="theme-block popular-search-categories">

                <div class="theme-block-heading">
                    <?php
                    $dual_default = dual_get_default_theme_options();
                    $top_category_title_search = esc_html(get_theme_mod('top_category_title_search', $dual_default['top_category_title_search']));

                    if ($top_category_title_search) { ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html($top_category_title_search); ?>

                        </h2>
                    <?php } ?>
                </div>

                <?php
                arsort($slug_counts); ?>

                <div class="theme-list-group categories-list-group">
                    <div class="theme-row">

                        <?php
                        $i = 1;
                        foreach ($slug_counts as $key => $slug_count) {

                            if ($i > $top_category) {
                                break;
                            }

                            $cat_link           = get_category_link($slug_count['cat_ID']);
                            $cat_name           = $slug_count['name'];
                            $cat_slug           = $slug_count['slug'];
                            $cat_count          = $slug_count['count'];
                            $twp_term_image = get_term_meta($slug_count['cat_ID'], 'twp-term-featured-image', true); ?>

                            <div class="column column-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-category-article'); ?>>
                                    <div class="entry-thumbnail">
                                        <a href="<?php echo esc_url($cat_link); ?>" class="data-bg data-bg-small" data-background="<?php echo esc_url($twp_term_image); ?>"></a>
                                    </div>
                                    <div class="entry-details">
                                        <header class="entry-header">
                                            <h3 class="entry-title">
                                                <a href="<?php echo esc_url($cat_link); ?>">
                                                    <?php echo esc_html($cat_name); ?>
                                                </a>
                                            </h3>
                                        </header>
                                    </div>
                                </article>
                            </div>
                        <?php
                            $i++;
                        } ?>

                    </div>
                </div>

            </div>
        <?php
        }
    }

endif;

if (!function_exists('dual_content_offcanvas')) :

    // Offcanvas Contents
    function dual_content_offcanvas()
    { ?>
        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">

                    <a class="skip-link-off-canvas" href="javascript:void(0)"></a>

                    <div class="offcanvas-close theme-close-controller">
                        <button type="button" class="button-offcanvas-close">
                            <span class="navbar-control-trigger" tabindex="-1">
                                <?php dual_the_theme_svg('cross'); ?>
                            </span>
                        </button>
                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'dual-primary-menu',
                        'container' => 'div',
                        'container_class' => 'offcanvas-navigation-area',
                        'show_toggles' => true,
                    )); ?>
                </div>

                <?php if (has_nav_menu('dual-social-menu')) { ?>
                    <div class="theme-social-navigation">
                        <div class="social-navigation-label"><?php esc_html_e('Connect with Us:', 'dual'); ?></div>
                        <div id="social-nav" class="social-navigation">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'dual-social-menu',
                                'link_before' => '<span class="screen-reader-text">',
                                'link_after' => '</span>',
                                'container' => 'div',
                                'container_class' => 'social-menu',
                                'depth' => 1,
                            )); ?>
                        </div>
                    </div>
                <?php } ?>

                <a class="skip-link-offcanvas screen-reader-text" href="javascript:void(0)"></a>
            </div>
        </div>
        <?php
    }

endif;

add_action('dual_before_footer_content_action', 'dual_content_offcanvas', 30);

if (!function_exists('dual_footer_content_widget')) :

    function dual_footer_content_widget()
    {

        if (
            is_active_sidebar('dual-footer-1') ||
            is_active_sidebar('dual-footer-2')
        ) : ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="theme-row">

                        <?php if (is_active_sidebar('dual-footer-1')) : ?>
                            <div class="column column-6 column-sm-12">
                                <?php dynamic_sidebar('dual-footer-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('dual-footer-2')) : ?>
                            <div class="column column-6 column-sm-12">
                                <?php dynamic_sidebar('dual-footer-2'); ?>
                            </div>
                        <?php endif; ?>


                    </div>
                </div>
            </div>

        <?php
        endif;
    }

endif;

add_action('dual_footer_content_info_action', 'dual_footer_content_widget', 10);

if (!function_exists('dual_footer_content_info')) :

    /**
     * Footer Copyright Area
     **/
    function dual_footer_content_info()
    { ?>

        <div class="site-info">
            <div class="wrapper">
                <div class="theme-row">

                    <?php
                    $dual_default = dual_get_default_theme_options(); ?>
                    <div class="column column-9">
                        <div class="footer-credits">
                            <div class="footer-copyright">
                                <?php
                                $dual_copyright_text = wp_kses_post(get_theme_mod('dual_copyright_text', $dual_default['dual_copyright_text']));
                                echo esc_html__('Copyright ', 'dual') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html(get_bloginfo('name', 'display')) . '. </span></a> ' . esc_html($dual_copyright_text);

                                echo '<br>';
                                echo esc_html__('Theme: ', 'dual') . 'Dual ' . esc_html__('By ', 'dual') . '<a href="' . esc_url('https://www.themeinwp.com/theme/dual') . '"  title="' . esc_attr__('ThemeInWP', 'dual') . '" target="_blank" rel="author"><span>' . esc_html__('ThemeInWP. ', 'dual') . '</span></a>';
                                echo esc_html__('Powered by ', 'dual') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'dual') . '" target="_blank"><span>' . esc_html__('WordPress.', 'dual') . '</span></a>';

                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $dual_default = dual_get_default_theme_options();
                    $dual_ed_footer_scroll_top_button = get_theme_mod('dual_ed_footer_scroll_top_button', $dual_default['dual_ed_footer_scroll_top_button']);

                    if ($dual_ed_footer_scroll_top_button) { ?>

                        <div class="column column-3 hide-no-js">
                            <a class="to-the-top" href="#site-header">
                                <span class="to-the-top-long">
                                    <?php printf(esc_html__('To the Top %s', 'dual'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
                                </span>
                                <span class="to-the-top-short">
                                    <?php printf(esc_html__('Up %s', 'dual'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
                                </span>
                            </a>
                        </div>

                    <?php } ?>

                </div>

                <div class="theme-row">
                    <?php
                    if (has_nav_menu('dual-footer-menu')) { ?>

                        <div class="column column-12">
                            <div class="footer-navigation">

                                <?php wp_nav_menu(array(
                                    'theme_location' => 'dual-footer-menu',
                                    'container' => 'div',
                                    'depth' => 1,
                                    'container_class' => 'footer-navigation-area'
                                )); ?>

                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>

        <?php
    }

endif;

add_action('dual_footer_content_info_action', 'dual_footer_content_info', 20);
if (!function_exists('dual_aside_latest_metro_post')) :

    function dual_aside_latest_metro_post()
    {

        if (have_posts()) : ?>

            <div class="archive-main-block">
                <div id="primary" class="content-area">
                    <main id="site-content" role="main">
                        <div class="article-wraper archive-layout-metro">

                            <?php
                            $metrocount = 1;
                            while (have_posts()) :
                                the_post();

                                if ($metrocount == '2' || $metrocount == '3') {

                                    $metro_item = 'article-item-2';
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $data_bg_class = 'data-bg-big';
                                    $title_class = 'entry-title-medium';
                                } else {

                                    $metro_item = 'article-item-1';
                                    $data_bg_class = 'data-bg-large';
                                    $title_class = 'entry-title-big';
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                }
                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article ' . $metro_item); ?>>

                                    <div class="post-thumbnail">

                                        <div class="post-thumbnail-effects">
                                            <a href="<?php the_permalink(); ?>">
                                                <span class="data-bg <?php echo $data_bg_class; ?>" data-background="<?php echo esc_url($featured_image); ?>"></span>
                                            </a>

                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = dual_post_format_icon($format);

                                            if (!empty($icon)) { ?>

                                                <div class="post-format-icon">
                                                    <?php echo dual_svg_escape($icon); ?>
                                                </div>

                                            <?php } ?>

                                        </div>

                                        <div class="post-thumbnail-overlay">
                                            <div class="entry-meta">
                                                <?php dual_entry_footer($cats = true, $tags = false, $edits = false, $icon = false, $text = false); ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="post-content">

                                        <header class="entry-header">
                                            <h3 class="entry-title <?php echo $title_class; ?>">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                        </header>

                                        <div class="entry-meta">
                                            <?php dual_posted_by(); ?>
                                        </div>

                                    </div>

                                </article>

                            <?php
                                $metrocount++;

                                if ($metrocount == '4') {
                                    $metrocount = 1;
                                }
                            endwhile; ?>

                        </div>
                    </main>
                </div>

                <?php do_action('dual_archive_pagination'); ?>

            </div>

        <?php
        endif;
    }

endif;

if (!function_exists('dual_disable_post_views')) :

    /** Disable Post Views **/
    function dual_disable_post_views()
    {

        add_filter('booster_extension_filter_views_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('dual_disable_post_read_time')) :

    /** Disable Read Time **/
    function dual_disable_post_read_time()
    {

        add_filter('booster_extension_filter_readtime_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('dual_disable_post_like_dislike')) :

    /** Disable Like Dislike **/
    function dual_disable_post_like_dislike()
    {

        add_filter('booster_extension_filter_like_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('dual_disable_post_author_box')) :

    /** Disable Author Box **/
    function dual_disable_post_author_box()
    {

        add_filter('booster_extension_filter_ab_ed', function () {
            return false;
        });
    }

endif;

add_filter('booster_extension_filter_ss_ed', function () {
    return false;
});

if (!function_exists('dual_disable_post_reaction')) :

    /** Disable Reaction **/
    function dual_disable_post_reaction()
    {

        add_filter('booster_extension_filter_reaction_ed', function () {
            return false;
        });
    }

endif;

if (!function_exists('dual_post_view_count')) :

    function dual_post_view_count()
    {

        $twp_be_settings = get_option('twp_be_options_settings');
        $twp_be_enable_post_visit_tracking = isset($twp_be_settings['twp_be_enable_post_visit_tracking']) ? esc_html($twp_be_settings['twp_be_enable_post_visit_tracking']) : '';

        if ($twp_be_enable_post_visit_tracking && class_exists('Booster_Extension_Class')) : ?>

            <div class="entry-meta-item entry-meta-views">
                <div class="entry-meta-wrapper">

                    <span class="entry-meta-icon views-icon">
                        <?php dual_the_theme_svg('viewer'); ?>
                    </span>

                    <a href="<?php the_permalink(); ?>">
                        <span class="post-view-count">
                            <?php
                            echo do_shortcode('[booster-extension-visit-count count_only="count" label="' . esc_html__('Views', 'dual') . '"]');
                            ?>
                        </span>
                    </a>

                </div>
            </div>

        <?php
        endif;
    }

endif;

if (!function_exists('dual_post_like_dislike')) :

    function dual_post_like_dislike()
    {

        $dual_ed_post_like_dislike = esc_html(get_post_meta(get_the_ID(), 'dual_ed_post_like_dislike', true));
        if (class_exists('Booster_Extension_Class') && !$dual_ed_post_like_dislike) : ?>

            <div class="entry-meta-item entry-meta-like-dislike">
                <div class="entry-meta-wrapper">
                    <?php echo do_shortcode('[booster-extension-like-dislike]'); ?>
                </div>
            </div>

        <?php
        endif;
    }

endif;

if (!function_exists('dual_post_format_icon')) :

    // Post Format Icon.
    function dual_post_format_icon($format)
    {

        if ($format == 'video') {
            $icon = dual_get_theme_svg('video');
        } elseif ($format == 'audio') {
            $icon = dual_get_theme_svg('audio');
        } elseif ($format == 'gallery') {
            $icon = dual_get_theme_svg('gallery');
        } elseif ($format == 'quote') {
            $icon = dual_get_theme_svg('quote');
        } elseif ($format == 'image') {
            $icon = dual_get_theme_svg('image');
        } else {
            $icon = '';
        }

        return $icon;
    }

endif;

if (class_exists('Booster_Extension_Class')) {

    add_filter('booster_extemsion_content_after_filter', 'dual_after_content_pagination');
}

if (!function_exists('dual_after_content_pagination')) :

    function dual_after_content_pagination($after_content)
    {

        $pagination_single = wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'dual'),
            'after' => '</div>',
            'echo' => false
        ));

        $after_content = $pagination_single . $after_content;

        return $after_content;
    }

endif;

function dual_aside_left_content_banner()
{

    $dual_default = dual_get_default_theme_options();

    if (is_archive() || is_author() || is_search()) { ?>

        <div class="theme-aside-background">

            <?php
            echo '<div class="entry-breadcrumb">';

            if (is_category()) {

                $obj = get_queried_object();
                if (isset($obj->term_id)) {

                    $archive_image = get_term_meta($obj->term_id, 'twp-term-featured-image', true);
                    if (empty($archive_image)) {

                        $archive_image = get_header_image();
                    }

                    if ($archive_image) { ?>

                        <div class="archive-thumbnail">
                            <img src="<?php echo esc_url($archive_image); ?>">
                        </div>

                    <?php
                    }
                }
            } else {

                $archive_image = get_header_image();
                if ($archive_image) { ?>

                    <div class="archive-thumbnail">
                        <img src="<?php echo esc_url($archive_image); ?>">
                    </div>

            <?php
                }
            }

            echo '</div>'; ?>

        </div>

    <?php
    } elseif (is_single()) {
        $dual_ed_post_views = get_post_meta(get_the_ID(), 'dual_ed_post_views', true);
        $dual_ed_post_read_time = get_post_meta(get_the_ID(), 'dual_ed_post_read_time', true);
        $dual_ed_post_like_dislike = get_post_meta(get_the_ID(), 'dual_ed_post_like_dislike', true);
        $dual_ed_post_author_box = get_post_meta(get_the_ID(), 'dual_ed_post_author_box', true);
        $dual_ed_post_social_share = get_post_meta(get_the_ID(), 'dual_ed_post_social_share', true);
        $dual_ed_post_reaction = get_post_meta(get_the_ID(), 'dual_ed_post_reaction', true);


        dual_disable_post_views();
        dual_disable_post_like_dislike();

        if ($dual_ed_post_read_time) {

            dual_disable_post_read_time();
        }

        if ($dual_ed_post_author_box) {
            dual_disable_post_author_box();
        }

        if ($dual_ed_post_reaction) {
            dual_disable_post_reaction();
        }
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
        <div class="theme-aside-background">

            <div id="wp-custom-header" class="wp-custom-header wp-custom-header-single">
                <?php if (isset($featured_image[0]) && $featured_image[0]) { ?>

                    <img src="<?php echo esc_url($featured_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">

                <?php } ?>
            </div>

        </div>

        <header class="entry-header">

            <?php
            if ('post' === get_post_type()) { ?>

                <div class="entry-meta">

                    <?php dual_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>

                </div>

            <?php } ?>

            <h1 class="entry-title entry-title-large">

                <?php the_title(); ?>

            </h1>

            <div class="entry-meta">

                <?php
                 // dual_posted_by();
                ?>

                <div class="entry-meta-left">
                <div class="entry-meta-item entry-meta-avatar"> 
                <?php 
                global $post;
                $user_id=$post->post_author;
                echo wp_kses_post( get_avatar( $user_id ) ); ?>
                </div>
                </div>

                <div class="entry-meta-right">

                <?php $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $user_id ) ) . '">' . esc_html(get_the_author_meta('display_name',$user_id)) . '</a></span>'; ?>

                <div class="entry-meta-item entry-meta-byline"> <?php echo $byline ?></div>

                <?php dual_posted_on(); ?>

                </div>

                <?php if (!$dual_ed_post_views) {
                    dual_post_view_count();
                }
                ?>

            </div>
        </header>

    <?php
    } elseif (is_page()) {
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';

        if (empty($featured_image)) {
            $featured_image = get_header_image();
        }
         ?>
        <div class="theme-aside-background">

            <div id="wp-custom-header" class="wp-custom-header wp-custom-header-single">
                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
            </div>

        </div>
        <?php } elseif (is_home() || is_front_page()) { ?>
        <div class="theme-aside-background">

            <?php
            $dual_header_banner_type = get_theme_mod('dual_header_banner_type', $dual_default['dual_header_banner_type']);

            if ($dual_header_banner_type != 'disable') {

                if ($dual_header_banner_type == 'media') { ?>

                    <?php the_custom_header_markup(); ?>

                    <?php
                } else {

                    $dual_header_banner_category = get_theme_mod('dual_header_banner_category');
                    $ed_banner_slider_autoplay = get_theme_mod('ed_banner_slider_autoplay', $dual_default['ed_banner_slider_autoplay']);

                    if (!$ed_banner_slider_autoplay) {
                        $autoplay = 'true';
                    } else {
                        $autoplay = 'false';
                    }

                    if (is_rtl()) {
                        $rtl = 'true';
                    } else {
                        $rtl = 'false';
                    }

                    $carousel_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 8, 'post__not_in' => get_option("sticky_posts"), 'category_name' => $dual_header_banner_category));

                    if ($carousel_posts_query->have_posts()) { ?>

                        <div class="theme-banner-slider" data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>

                            <?php while ($carousel_posts_query->have_posts()) {
                                $carousel_posts_query->the_post(); ?>

                                <div class="theme-banner-slider-item">

                                    <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article theme-article-slider'); ?>>

                                        <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <span class="data-bg data-bg-full" data-background="<?php echo esc_url($featured_image); ?>"></span>
                                            </a>
                                        </div>

                                    </article>

                                </div>

                            <?php } ?>

                        </div>

            <?php
                        wp_reset_postdata();
                    }
                }
            } ?>

        </div>
    <?php
    }
}

function dual_aside_left_content()
{

    $dual_default = dual_get_default_theme_options();

    if (is_archive() || is_author() || is_search()) { ?>

        <div class="theme-header-content">

            <?php
            echo '<div class="entry-breadcrumb">';

            if (is_search()) { ?>
                <div class="twp-banner-details">
                    <header class="page-header">
                        <h1 class="page-title entry-title entry-title-large">
                            <?php
                            /* translators: %s: search query. */
                            printf(esc_html__('Search Results for: %s', 'dual'), '<span>' . get_search_query() . '</span>');
                            ?>
                        </h1>
                    </header><!-- .page-header -->
                </div>
            <?php }

            if (is_archive() && !is_author()) { ?>

                <div class="twp-banner-details">
                    <header class="page-header">
                        <?php
                        the_archive_title('<h1 class="page-title entry-title entry-title-large">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->
                </div>

            <?php }

            if (is_author()) { ?>
                <div class="twp-banner-details">
                    <header class="page-header">

                        <?php
                        $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
                        $author_img = get_avatar(absint($curauth->ID), 200, '', '', array('class' => 'avatar-img')); ?>

                        <div class="author-image">
                            <?php echo wp_kses_post($author_img); ?>
                        </div>

                        <div class="author-title-desc">
                            <h1 class="page-title entry-title entry-title-large"><?php echo esc_html($curauth->nickname); ?></h1>
                            <div class="archive-description"><?php echo esc_html(get_the_author_meta('description', absint($curauth->ID))); ?></div>
                        </div>

                    </header><!-- .page-header -->
                </div>
            <?php }

            echo '</div>'; ?>

        </div>

        <?php
    } elseif (is_home() || is_front_page()) {

        $dual_header_banner_category = get_theme_mod('dual_header_banner_category');
        $ed_banner_slider_autoplay = get_theme_mod('ed_banner_slider_autoplay', $dual_default['ed_banner_slider_autoplay']);
        $ed_banner_slider_pagination = get_theme_mod('ed_banner_slider_pagination', $dual_default['ed_banner_slider_pagination']);
        $ed_banner_slider_navigation = get_theme_mod('ed_banner_slider_navigation', $dual_default['ed_banner_slider_navigation']);

        if ($ed_banner_slider_autoplay) {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }
        if ($ed_banner_slider_pagination) {
            $dots = 'true';
        } else {
            $dots = 'false';
        }
        if ($ed_banner_slider_navigation) {
            $arrows = 'true';
        } else {
            $arrows = 'false';
        }
        if (is_rtl()) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        $dual_header_banner_type = get_theme_mod('dual_header_banner_type', $dual_default['dual_header_banner_type']);

        if ($dual_header_banner_type != 'disable') {

            if ($dual_header_banner_type == 'media') {
                $header_text = get_theme_mod('header_text', $dual_default['header_text']);
                $header_button_label = get_theme_mod('header_button_label', $dual_default['header_button_label']);
                $header_button_link = get_theme_mod('header_button_link');
                $header_description = get_theme_mod('header_description');
        ?>

                <?php
                if ($header_text || $header_button_link) { ?>

                    <div class="theme-header-content">
                        <div class="theme-section-heading">
                            <?php if ($header_text) { ?>

                                <header class="entry-header">
                                    <h2 class="entry-title entry-title-big">
                                        <?php echo esc_html($header_text); ?>
                                    </h2>
                                </header>

                            <?php } ?>

                            <?php if ($header_description) { ?>

                                <p class="theme-section-description">
                                    <?php echo esc_html($header_description); ?>
                                </p>

                            <?php } ?>

                            <?php if ($header_button_label) { ?>

                                <a href="<?php echo esc_url($header_button_link); ?>" class="theme-button theme-button-filled">
                                    <?php echo esc_html($header_button_label); ?>
                                </a>

                            <?php } ?>

                        </div>
                    </div>

                <?php
                }
            } else {



                $carousel_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 8, 'post__not_in' => get_option("sticky_posts"), 'category_name' => $dual_header_banner_category));

                if ($carousel_posts_query->have_posts()) { ?>
                    <div class="theme-header-content">
                        <div class="theme-banner-slider-content" data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>

                            <?php
                            $i = 1;
                            while ($carousel_posts_query->have_posts()) {
                                $carousel_posts_query->the_post(); ?>

                                <div class="theme-banner-slider-item">

                                    <?php
                                    $dual_archive_layout = get_theme_mod('dual_archive_layout', $dual_default['dual_archive_layout']);
                                    if ($dual_archive_layout == 'default' || $dual_archive_layout == 'lateral' || $dual_archive_layout == 'masonry') {
                                        $image_size = 'medimu_large';
                                    } else {
                                        $image_size = 'full';
                                    }

                                    ?>
                                    <article <?php post_class('theme-article theme-article-slider'); ?>>

                                        <div class="post-content">

                                            <?php
                                            if ('post' === get_post_type()) { ?>

                                                <div class="entry-meta">
                                                    <?php dual_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>

                                            <?php } ?>

                                            <header class="entry-header">
                                                <h2 class="entry-title entry-title-big">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                                </h2>
                                            </header>

                                            <?php
                                            if ($dual_archive_layout != 'masonry' && $dual_archive_layout != 'metro') { ?>

                                                <div class="entry-excerpt hidden-xs-screen hidden-xxs-screen">
                                                    <?php
                                                    if (has_excerpt()) {

                                                        the_excerpt();
                                                    } else {

                                                        echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                    }

                                                    ?>

                                                </div>

                                            <?php } ?>

                                            <div class="entry-meta">
                                                <?php dual_posted_by(); ?>
                                            </div>

                                        </div>

                                    </article>

                                </div>

                            <?php $i++;
                            }
                            wp_reset_postdata(); ?>

                        </div>

                        <?php if ($arrows) { ?>

                            <div class="slidernav">


                                <div class="theme-slide-controls slide-prev-1">
                                    <?php dual_the_theme_svg('chevron-left'); ?>
                                </div>

                                <div class="theme-slide-controls slide-count-wrap">
                                    <span class="current"><?php esc_html_e('1', 'dual'); ?></span>
                                    <?php echo esc_html__('/', 'dual') ?>
                                    <span class="total"><?php echo $i - 1; ?></span>
                                </div>

                                <div class="theme-slide-controls slide-next-1">
                                    <?php dual_the_theme_svg('chevron-right'); ?>
                                </div>

                            </div>

                        <?php } ?>

                    </div>
<?php


                }
            }
        }
    }
}
