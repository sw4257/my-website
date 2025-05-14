<?php
/*
 * This is the child theme for Scapeshot Modern theme.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
function scapeshot_modern_enqueue_styles() {
    // Include parent theme CSS.
    wp_enqueue_style( 'scapeshot-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );
    
    // Include child theme CSS.
    wp_enqueue_style( 'scapeshot-modern-style', get_stylesheet_directory_uri() . '/style.css', array( 'scapeshot-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

	// Load the rtl.
	if ( is_rtl() ) {
		wp_enqueue_style( 'scapeshot-rtl', get_template_directory_uri() . '/rtl.css', array( 'scapeshot-style' ), date( 'Ymd-Gis', filemtime( get_template_directory() . '/rtl.css' ) ) );
	}

	$enable_testimonial_slider = scapeshot_check_section( get_theme_mod( 'scapeshot_testimonial_option', 'disabled' ) );
	
    if ( $enable_testimonial_slider ) {
		wp_enqueue_script( 'scapeshot-modern-script', get_stylesheet_directory_uri() . '/assets/js/functions.js', array( 'scapeshot-script' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/js/functions.js' ) ), true );
    }
		
}
add_action( 'wp_enqueue_scripts', 'scapeshot_modern_enqueue_styles' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function scapeshot_modern_body_classes( $classes ) {
	// Added color scheme to body class.
	$classes['color-scheme'] = 'color-scheme-modern';

	return $classes;
}
add_filter( 'body_class', 'scapeshot_modern_body_classes', 100 );

/**
 * Change default header text color
 */
function scapeshot_modern_dark_header_default_color( $args ) {
	$args['default-image'] =  get_theme_file_uri( 'assets/images/header-image.jpg' );

	return $args;
}
add_filter( 'scapeshot_custom_header_args', 'scapeshot_modern_dark_header_default_color' );

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function scapeshot_modern_testimonial_options( $wp_customize ) {
	scapeshot_register_option( $wp_customize, array(
			'name'              => 'scapeshot_testimonial_bg_image',
			'sanitize_callback' => 'scapeshot_modern_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'scapeshot_is_testimonial_active',
			'label'             => esc_html__( 'Background Image', 'scapeshot' ),
			'section'           => 'scapeshot_testimonials',
		)
	);
}
add_action( 'customize_register', 'scapeshot_modern_testimonial_options', 100 );

/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function scapeshot_modern_sanitize_image( $image, $setting ) {
    /*
     * Array of valid image file types.
     *
     * The array includes image mime types that are included in wp_get_mime_types()
     */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
    // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
    // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : '' );
}

/**
 * Adds testimonial background CSS
 */
function scapeshot_modern_testimonail_bg_css() {
	$enable   = get_theme_mod( 'scapeshot_testimonial_option', 'disabled' );

	if ( ! scapeshot_check_section( $enable ) ) {
		// Bail if contact section is disabled.
		return;
	}

	$background = get_theme_mod( 'scapeshot_testimonial_bg_image' );

	$css = '';

	if ( $background ) {
		$css = '#testimonial-content-section { background-image: url("' . esc_url( $background ) . '"); }';
	}

	wp_add_inline_style( 'scapeshot-style', $css );
}
add_action( 'wp_enqueue_scripts', 'scapeshot_modern_testimonail_bg_css', 11 );
