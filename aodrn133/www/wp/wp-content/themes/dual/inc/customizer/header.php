<?php
/**
* Header Options.
*
* @package Dual
*/

$dual_default = dual_get_default_theme_options();
$dual_post_category_list = dual_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Aside-Bar Settings', 'dual' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_day_night_mode_switch',
    array(
        'default' => $dual_default['ed_day_night_mode_switch'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_day_night_mode_switch',
    array(
        'label' => esc_html__('Enable Dark and Night Mode', 'dual'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

// Enable Disable Search.
$wp_customize->add_setting('dual_header_search',
    array(
        'default' => $dual_default['dual_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);

$wp_customize->add_control('dual_header_search',
    array(
        'label' => esc_html__('Enable Search', 'dual'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_search_recent_posts',
    array(
        'default' => $dual_default['ed_header_search_recent_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_recent_posts',
    array(
        'label' => esc_html__('Enable Recent Posts on Search Area', 'dual'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'recent_post_title_search',
    array(
    'default'           => $dual_default['recent_post_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'recent_post_title_search',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'dual' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);
$wp_customize->add_setting('ed_header_search_top_category',
    array(
        'default' => $dual_default['ed_header_search_top_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_top_category',
    array(
        'label' => esc_html__('Enable Top Category on Search Area', 'dual'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'top_category_title_search',
    array(
    'default'           => $dual_default['top_category_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'top_category_title_search',
    array(
    'label'    => esc_html__( 'Top Category Section Title', 'dual' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'dual_header_banner_type',
    array(
    'default'           => $dual_default['dual_header_banner_type'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'dual_header_banner_type',
    array(
    'label'       => esc_html__( 'Header Media Type', 'dual' ),
    'section'     => 'header_image',
    'type'        => 'select',
    'priority'    => 1,
    'choices'               => array(
        'media' => esc_html__( 'Header Media Banner', 'dual' ),
        'slider' => esc_html__( 'Slider Banner', 'dual' ),
        ),
    )
);

$wp_customize->add_setting( 'header_text',
    array(
    'default'           => $dual_default['header_text'],
    'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'header_text',
    array(
    'label'    => esc_html__( 'Header Text', 'dual' ),
    'section'  => 'header_image',
    'type'     => 'text',
    'active_callback' => 'dual_custom_header_active_callback',
    )
);

$wp_customize->add_setting( 'header_description',
    array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'header_description',
    array(
    'label'    => esc_html__( 'Header Description', 'dual' ),
    'section'  => 'header_image',
    'type'     => 'textarea',
    'active_callback' => 'dual_custom_header_active_callback',
    )
);

$wp_customize->add_setting( 'header_button_label',
    array(
    'default'           => $dual_default['header_button_label'],
    'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'header_button_label',
    array(
    'label'    => esc_html__( 'Header Button label', 'dual' ),
    'section'  => 'header_image',
    'type'     => 'text',
    'active_callback' => 'dual_custom_header_active_callback',
    )
);

$wp_customize->add_setting( 'header_button_link',
    array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control( 'header_button_link',
    array(
    'label'    => esc_html__( 'Header Button Link', 'dual' ),
    'section'  => 'header_image',
    'type'     => 'text',
    'active_callback' => 'dual_custom_header_active_callback',
    )
);

$wp_customize->add_setting( 'dual_header_banner_category',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'dual_header_banner_category',
    array(
    'label'       => esc_html__( 'Banner Slider Category', 'dual' ),
    'section'     => 'header_image',
    'type'        => 'select',
    'choices'     => $dual_post_category_list,
    'active_callback' => 'dual_custom_header_category_active_callback',
    )
);

$wp_customize->add_setting('ed_banner_slider_autoplay',
    array(
        'default' => $dual_default['ed_banner_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_slider_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'dual'),
        'section' => 'header_image',
        'type' => 'checkbox',
        'active_callback' => 'dual_custom_header_category_active_callback',
    )
);

$wp_customize->add_setting('ed_banner_slider_pagination',
    array(
        'default' => $dual_default['ed_banner_slider_pagination'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_slider_pagination',
    array(
        'label' => esc_html__('Enable Pagination', 'dual'),
        'section' => 'header_image',
        'type' => 'checkbox',
        'active_callback' => 'dual_custom_header_category_active_callback',
    )
);

$wp_customize->add_setting('ed_banner_slider_navigation',
    array(
        'default' => $dual_default['ed_banner_slider_navigation'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_slider_navigation',
    array(
        'label' => esc_html__('Enable Navigation', 'dual'),
        'section' => 'header_image',
        'type' => 'checkbox',
        'active_callback' => 'dual_custom_header_category_active_callback',
    )
);