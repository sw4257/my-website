<?php
/*
 * Load the parent style.css and rtl.css file
 */
function chique_photography_enqueue_styles() {
    // Include parent theme CSS.
    wp_enqueue_style( 'chique-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );
   
    // Include child theme CSS.
    wp_enqueue_style( 'chique-photography-style', get_stylesheet_directory_uri() . '/style.css', array( 'chique-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

    // Load the stylesheet
    if ( is_rtl() ) {
        wp_enqueue_style( 'chique-rtl', get_template_directory_uri() . '/rtl.css', array( 'chique-style' ), filemtime( get_stylesheet_directory() . '/rtl.css' ) );
    }

    // Enqueue child block styles after parent block style.
    wp_enqueue_style( 'chique-photography-block-style', get_stylesheet_directory_uri() . '/assets/css/child-blocks.css', array( 'chique-block-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-blocks.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'chique_photography_enqueue_styles' );

/**
 * Add child theme editor styles
 */
function chique_photography_editor_style() {
    add_editor_style( array(
            'assets/css/child-editor-style.css',
            chique_fonts_url(),
            get_theme_file_uri( 'assets/css/font-awesome/css/font-awesome.css' ),
        )
    );
}
add_action( 'after_setup_theme', 'chique_photography_editor_style', 11 );

/**
 * Enqueue editor styles for Gutenberg
 */
function chique_photography_block_editor_styles() {
    // Enqueue child block editor style after parent editor block css.
    wp_enqueue_style( 'chique-photography-block-editor-style', get_stylesheet_directory_uri() . '/assets/css/child-editor-blocks.css', array( 'chique-block-editor-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-editor-blocks.css' ) ) );
}
add_action( 'enqueue_block_editor_assets', 'chique_photography_block_editor_styles', 11 );

/**
 * Display Sections on header and footer with respect to the section option set in chique_sections_sort
 */
function chique_sections( $selector = 'header' ) {
    get_template_part( 'template-parts/header/header', 'media' );
    get_template_part( 'template-parts/slider/display', 'slider' );
    get_template_part( 'template-parts/hero-content/content','hero' );
    get_template_part( 'template-parts/portfolio/display', 'portfolio' );
    get_template_part( 'template-parts/team/display', 'team' );
    get_template_part( 'template-parts/services/display', 'services' );
    get_template_part( 'template-parts/testimonials/display', 'testimonial' );
    get_template_part( 'template-parts/featured-content/display', 'featured' );
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function chique_photography_body_classes( $classes ) {
    // Added color scheme to body class.
    $classes['color-scheme'] = 'color-scheme-photography';

    return $classes;
}
add_filter( 'body_class', 'chique_photography_body_classes', 11 );

/**
 * Change default background color
 */
function chique_photography_background_default_color( $args ) {
    $args['default-color'] = '#000000';

    return $args;
}
add_filter( 'chique_custom_background_args', 'chique_photography_background_default_color' );

/**
 * Change default header text color
 */
function chique_photography_header_default_color( $args ) {
	$args['default-image'] =  get_theme_file_uri( 'assets/images/header-image.jpg' );
	$args['default-text-color'] = '#ffffff';

	return $args;
}
add_filter( 'chique_custom_header_args', 'chique_photography_header_default_color' );

/**
 * Load Customizer Options for Team
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/team.php';
