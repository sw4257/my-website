<?php
/**
 * Dual Theme Customizer
 *
 * @package Dual
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('dual_customize_register')) :

function dual_customize_register( $wp_customize ) {

	/** Active Callback Functions. **/
	require get_template_directory() . '/inc/customizer/active-callback.php';
	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/layout.php';
	require get_template_directory() . '/inc/customizer/preloader.php';
	require get_template_directory() . '/inc/customizer/banner-slider.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/footer.php';
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','dual');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';

	$dual_default = dual_get_default_theme_options();

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'dual_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'dual_customize_partial_blogdescription',
		) );
	}

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'dual' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'dual' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'dual' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);
	
	// Template Options
	$wp_customize->add_panel( 'theme_template_pannel',
		array(
			'title'      => esc_html__( 'Template Settings', 'dual' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);
	
	// Register custom section types.
	$wp_customize->register_section_type( 'Dual_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Dual_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Dual Pro', 'dual' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'dual' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/dual-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'dual_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('dual_customizer_scripts')) :

    function dual_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('dual-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    	wp_enqueue_style('dual-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('dual-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);
        wp_enqueue_script('dual-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

	    $dual_post_category_list = dual_post_category_list();

	    $cat_option = '';

	    if( $dual_post_category_list ){
		    foreach( $dual_post_category_list as $key => $cats ){
		    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
		    }
		}

	    wp_localize_script( 
	        'dual-repeater', 
	        'dual_repeater',
	        array(
	           	'categories'   => $cat_option,
	            'upload_image'   =>  esc_html__('Choose Image','dual'),
	            'use_image'   =>  esc_html__('Select','dual'),
	         )
	    );
        $ajax_nonce = wp_create_nonce('dual_ajax_nonce');
        wp_localize_script( 
		    'dual-customizer', 
		    'dual_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'dual_customizer_scripts');
add_action('customize_controls_init', 'dual_customizer_scripts');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('dual_customize_partial_blogname')) :

	function dual_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('dual_customize_partial_blogdescription')) :

	function dual_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;


add_action('wp_ajax_dual_customizer_font_weight', 'dual_customizer_font_weight_callback');
add_action('wp_ajax_nopriv_dual_customizer_font_weight', 'dual_customizer_font_weight_callback');

// Recommendec Post Ajax Call Function.
function dual_customizer_font_weight_callback() {

    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'dual_ajax_nonce' ) && isset( $_POST['currentfont'] ) && $_POST['currentfont']  ) {

       $currentfont = $_POST['currentfont'];
       $headings_fonts_property = Dual_Fonts::dual_get_fonts_property( $currentfont );

       foreach( $headings_fonts_property['weight'] as $key => $value ){
       		echo '<option value="'.esc_attr( $key ).'">'.esc_html( $value ).'</option>';
       }
    }
    wp_die();
}