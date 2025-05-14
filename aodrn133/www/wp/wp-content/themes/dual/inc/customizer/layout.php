<?php
/**
* Layouts Settings.
*
* @package Dual
*/

$dual_default = dual_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Archive Settings', 'dual' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'dual_archive_layout',
    array(
        'default' 			=> $dual_default['dual_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_archive_layout'
    )
);
$wp_customize->add_control(
    new Dual_Custom_Radio_Image_Control( 
        $wp_customize,
        'dual_archive_layout',
        array(
            'settings'      => 'dual_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Layout Setting', 'dual' ),
            'choices'       => array(
            	'default'  => get_template_directory_uri() . '/assets/images/archive-style-1.png',
                'lateral'  => get_template_directory_uri() . '/assets/images/archive-style-2.png',
                'metro'  => get_template_directory_uri() . '/assets/images/archive-style-3.png',
                'masonry'  => get_template_directory_uri() . '/assets/images/archive-style-4.png',
            )
        )
    )
);


// Pagination Layout Settings
$wp_customize->add_setting( 'dual_column_layout',
    array(
    'default'           => $dual_default['dual_column_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'dual_column_layout',
    array(
    'label'       => esc_html__( 'Number of Column', 'dual' ),
    'section'     => 'layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'masonry-layout-two' => esc_html__('Two Column Layout','dual'),
        'masonry-layout-three' => esc_html__('Three Column Layout','dual'),
    ),
    'active_callback' => 'dual_column_layout_active_callback',

    )
);