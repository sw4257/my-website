<?php
/**
 * Header Layout 1
 *
 * @package Dual
 */

?>

<header id="site-header" class="theme-site-header" role="banner">
    <div class="header-navbar">
        <div class="navbar-item navbar-item-left">
            <div class="header-titles">
                <?php
                dual_site_logo();
                dual_site_description();
                ?>
            </div>
        </div>
        <div class="navbar-item navbar-item-right">
            <div class="navbar-controls hide-no-js">
                <?php
                $dual_default = dual_get_default_theme_options();
                $dual_header_search = get_theme_mod( 'dual_header_search', $dual_default['dual_header_search'] );
                $ed_day_night_mode_switch = get_theme_mod( 'ed_day_night_mode_switch', $dual_default['ed_day_night_mode_switch'] );


                if( $ed_day_night_mode_switch ){ ?>

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

                if( $dual_header_search ){ ?>
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
                <button type="button" class="navbar-control navbar-control-offcanvas">
                    <span class="navbar-control-trigger" tabindex="-1">
                        <?php dual_the_theme_svg('menu'); ?>
                    </span>
                </button>
            </div>
        </div>
    </div>
</header>