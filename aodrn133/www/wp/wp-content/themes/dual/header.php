<?php

/**
 * Header file for the Dual WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dual
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }

    $dual_default = dual_get_default_theme_options();
    $ed_preloader = get_theme_mod('ed_preloader', $dual_default['ed_preloader']);

    if ($ed_preloader) { ?>

        <div class="preloader hide-no-js <?php if (isset($_COOKIE['DualNightDayMode']) && $_COOKIE['DualNightDayMode'] == 'true') {
                                                echo 'preloader-night-mode';
                                            } ?>">
            <div class="preloader-style preloader-style-1"></div>
        </div>

    <?php } ?>
    <?php
    $ed_cursor_option = get_theme_mod('ed_cursor_option', $dual_default['ed_cursor_option']);

    if ($ed_cursor_option) { ?>
        <div class="theme-custom-cursor theme-cursor-primary"></div>
        <div class="theme-custom-cursor theme-cursor-secondary"></div>
    <?php } ?>
    <div id="page" class="page-wrapper">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'dual'); ?></a>

        <div id="aside-content" class="site-aside-content">
            <div class="aside-content-navbar">
                <div class="navbar-controls hide-no-js">

                    <button type="button" class="navbar-control navbar-control-offcanvas">
                        <span class="navbar-control-trigger" tabindex="-1">
                            <?php dual_the_theme_svg('menu'); ?>
                        </span>
                    </button>

                    <?php if (has_nav_menu('dual-social-menu')) { ?>
                        <div class="theme-social-navigation">
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

                    <div class="aside-navbar-btns">
                        <?php
                        $dual_default = dual_get_default_theme_options();
                        $dual_header_search = get_theme_mod('dual_header_search', $dual_default['dual_header_search']);
                        $ed_day_night_mode_switch = get_theme_mod('ed_day_night_mode_switch', $dual_default['ed_day_night_mode_switch']);

                        if ($ed_day_night_mode_switch) { ?>

                            <button type="button" class="navbar-control navbar-day-night navbar-day-on">
                                <span class="navbar-control-trigger day-night-toggle-icon" tabindex="-1">
                                    <span class="moon-toggle-icon">
                                        <i class="moon-icon">
                                            <?php dual_the_theme_svg('moon'); ?>
                                        </i>
                                    </span>
                                    <span class="sun-toggle-icon">
                                        <i class="sun-icon">
                                            <?php dual_the_theme_svg('sun'); ?>
                                        </i>
                                    </span>
                                </span>
                            </button>

                        <?php }


                        if ($dual_header_search) { ?>
                            <button type="button" class="navbar-control navbar-control-search">
                                <span class="navbar-control-trigger" tabindex="-1">
                                    <?php dual_the_theme_svg('search'); ?>
                                </span>
                            </button>
                        <?php } ?>

                        <?php if ( class_exists( 'WooCommerce' ) ): ?>
                            <div class="dual-minicart">
                                <?php dual_woocommerce_header_cart(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="theme-aside-wrapper">
                <?php dual_aside_left_content_banner(); ?>

                <div class="theme-aside-content">
                    <?php get_template_part('template-parts/header', 'content');
                    dual_aside_left_content(); ?>
                </div>

            </div>
        </div>

        <div id="content" class="site-content">
            <?php if (is_front_page() && is_home() && !is_paged()) {
                dual_banner_section();
            }
