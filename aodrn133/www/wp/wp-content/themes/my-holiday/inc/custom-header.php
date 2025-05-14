<?php if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Sample implementation of the Custom Header feature.
 *
 */
function my_holiday_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'my_holiday_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/framework/images/header.jpg',	
		'default-text-color'     => 'fff',
		'width'                  => 1300,
		'height'                 => 800,
		'flex-height'            => true,
		'flex-width'            => true,
		'wp-head-callback'       => 'my_holiday_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'my_holiday_custom_header_setup' );

register_default_headers( array(
	'yourimg' => array(
	'url' => get_template_directory_uri() . '/framework/images/header.jpg',
	'thumbnail_url' => get_template_directory_uri() . '/framework/images/header.jpg',
	'description' => _x( 'Default Image', 'header image description', 'my-holiday' )),
));

if ( ! function_exists( 'my_holiday_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see my_holiday_custom_header_setup().
 */
function my_holiday_header_style() {
	$my_holiday_header_text_color = get_header_textcolor();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			.site-title,
			.site-description {
				display: none !important;
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			header .site-branding .site-title a, header .header-img .site-title a, header .header-img .site-description,
			header  .site-branding .site-description {
				color: #<?php echo esc_attr( $my_holiday_header_text_color ); ?>;
			}
		<?php endif; ?>
	</style>
	<?php
}
endif;

/**
 * Custom Header Options
 */

add_action( 'customize_register', 'my_holiday_customize_custom_header_meta' );

function my_holiday_customize_custom_header_meta($wp_customize ) {
	
    $wp_customize->add_setting(
        'custom_header_position',
        array(
            'default'    => 'default',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'my_holiday_sanitize_select',			
        )
    );

    $wp_customize->add_control(
        'custom_header_position',
        array(
            'settings' => 'custom_header_position',	
			'priority'    => 1,
            'label'    => __( 'Activate Header Image:', 'my-holiday' ),
            'section'  => 'header_image',
            'type'     => 'select',
            'choices'  => array(
                'deactivate' => __( 'Deactivate Header Image', 'my-holiday' ),
                'default' => __( 'Default Image', 'my-holiday' ),
                'all' => __( 'All Pages', 'my-holiday' ),
                'without' => __( 'All Pages Without Home Page', 'my-holiday' ),
                'home'  => __( 'Home Page', 'my-holiday' )
            ),
			'default'    => 'deactivate'
        )
    );

	$wp_customize->add_setting( 'header_height', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'header_height', array(
		'type' => 'number',
		'priority' => 1,
		'section' => 'header_image',
		'label' => __( 'Custom Height', 'my-holiday' ),
		'description' => __( 'Min-height 18vw. Max-height 100vw.', 'my-holiday' ),
		'input_attrs' => array(
			'min' => 18,
			'max' => 100,
			'step' => 1,
		),
	) );
	
}

function my_holiday_customize_css () { ?>
	<style>
		<?php if(get_theme_mod('header_height')) { ?> .header-img { height: <?php echo esc_attr(get_theme_mod('header_height')); ?>vw; } <?php } ?>
	</style>
<?php	
}

add_action('wp_head','my_holiday_customize_css');


function my_holiday_sanitize_select( $input ) {
	$valid = array(
                'deactivate' => __( 'Deactivate Header Image', 'my-holiday' ),
                'default' => __( 'Default Image', 'my-holiday' ),
                'all' => __( 'All Pages', 'my-holiday' ),
                'without' => __( 'All Pages Without Home Page', 'my-holiday' ),				
                'home'  => __( 'Home Page', 'my-holiday' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function my_holiday_sanitize_overlay( $input ) {
	$valid = array(
        'on' => __( 'Show Overlay', 'my-holiday' ),
        ''  => __( 'Hide Overlay', 'my-holiday' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}