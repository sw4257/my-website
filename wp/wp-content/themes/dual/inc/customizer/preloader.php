<?php
/**
* Footer Settings.
*
* @package Dual
*/

$dual_default = dual_get_default_theme_options();


$wp_customize->add_section( 'preloader_section',
	array(
	'title'      => esc_html__( 'Preloader Setting', 'dual' ),
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	'priority'   => 5,
	)
);

$wp_customize->add_setting('ed_preloader',
    array(
        'default' => $dual_default['ed_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_preloader',
    array(
        'label' => esc_html__('Enable Preloader', 'dual'),
        'section' => 'preloader_section',
        'type' => 'checkbox',
    )
);


// Cursor Section.
$wp_customize->add_section('cursor_section',
    array(
        'title'      => esc_html__('Cursor Options', 'dual'),
        'priority'   => 10,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting ed_cursor_option.
$wp_customize->add_setting('ed_cursor_option',
    array(
        'default' => $dual_default['ed_cursor_option'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_cursor_option',
    array(
        'label' => esc_html__('Enable Custom Cursor', 'dual'),
        'section' => 'cursor_section',
        'type' => 'checkbox',
    )
);