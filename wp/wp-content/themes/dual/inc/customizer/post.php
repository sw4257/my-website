<?php
/**
* Posts Settings.
*
* @package Dual
*/

$dual_default = dual_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Posts Settings', 'dual' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('dual_post_author',
    array(
        'default' => $dual_default['dual_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('dual_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'dual'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('dual_post_date',
    array(
        'default' => $dual_default['dual_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('dual_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'dual'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('dual_post_category',
    array(
        'default' => $dual_default['dual_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('dual_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'dual'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('dual_post_tags',
    array(
        'default' => $dual_default['dual_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('dual_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'dual'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);
// Enable Disable Post.
$wp_customize->add_setting('post_video_aspect_ration',
    array(
        'default' => $dual_default['post_video_aspect_ration'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_select',
    )
);
$wp_customize->add_control('post_video_aspect_ration',
    array(
        'label' => esc_html__('Global Video Aspect Ratio', 'dual'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'default' => esc_html__( 'Default', 'dual' ),
            'square' => esc_html__( 'Square', 'dual' ),
            'portrait' => esc_html__( 'Portrait', 'dual' ),
            'landscape' => esc_html__( 'Landscape', 'dual' ),
            ),
        )
);