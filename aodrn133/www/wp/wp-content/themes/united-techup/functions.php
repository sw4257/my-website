<?php
/**
 * Child Theme functions and definitions.
 * This theme is a child theme for Deneb.
 *
 * @subpackage United techup
 * @author  wptexture http://testerwp.com/
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

/**
 * Theme functions and definitions.
 */
 
function united_techup_custom_excerpt_length( $length ) {
    if (is_admin()) {
            return $length;
        }
    return 20;
}

add_filter( 'excerpt_length', 'united_techup_custom_excerpt_length', 999 );

add_action( 'wp_enqueue_scripts', 'united_techup_child_css',25);
function united_techup_child_css() {
	wp_enqueue_style( 'united-techup-parent-theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'united-techup-child-style',get_stylesheet_directory_uri() . '/child-css/child.css');
	wp_enqueue_script( 'united-techup-custom-script', get_stylesheet_directory_uri() . '/child-js/custom-script.js');
 
}

/**
 * Custom Hooks defined 
 */
require( get_stylesheet_directory() . '/custom-footer/footer-hooks.php');