<?php
/**
 * Dual About Page
 * @package Dual
 *
 */
if (!class_exists('Dual_About_page')):
    class Dual_About_page
    {
        function __construct()
        {
            add_action('admin_menu', array($this, 'dual_backend_menu'), 999);
        }
        // Add Backend Menu
        function dual_backend_menu()
        {
            add_theme_page(esc_html__('Dual', 'dual'), esc_html__('Dual', 'dual'), 'activate_plugins', 'dual-about', array($this, 'dual_main_page'), 1);
        }
        // Settings Form
        function dual_main_page()
        {
            require get_template_directory() . '/classes/about-render.php';
        }
    }
    new Dual_About_page();
endif;