<?php
/**
* Banner Section Settings.
*
* @package Dual
*/

$dual_default = dual_get_default_theme_options();
$dual_post_category_list = dual_post_category_list();

$wp_customize->add_section( 'homepage_slider_Section',
    array(
    'title'      => esc_html__( 'Slider Section Settings', 'dual' ),
    'capability' => 'edit_theme_options',
    'priority'   => 15,
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_slider_section',
    array(
        'default' => $dual_default['ed_slider_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_slider_section',
    array(
        'label' => esc_html__('Enable Slider Section', 'dual'),
        'section' => 'homepage_slider_Section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'dual_from_blog_section_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'dual_sanitize_select',
    )
);
$wp_customize->add_control( 'dual_from_blog_section_cat',
    array(
    'label'       => esc_html__( 'Select Category For Blog ', 'dual' ),
    'section'     => 'homepage_slider_Section',
    'type'        => 'select',
    'choices'     => $dual_post_category_list,
    )
);


$wp_customize->add_setting( 'number_of_slider',
    array(
        'default'           => $dual_default['number_of_slider'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_select',
    )
);
$wp_customize->add_control( 'number_of_slider',
    array(
        'label'    => esc_html__( 'Select no of slider', 'dual' ),
        'description'     => esc_html__( 'Please refresh to get actual no of page field below', 'dual' ),
        'section'  => 'homepage_slider_Section',
        'choices'               => array(
            '1' => esc_html__( '1', 'dual' ),
            '2' => esc_html__( '2', 'dual' ),
            '3' => esc_html__( '3', 'dual' ),
            '4' => esc_html__( '4', 'dual' ),
            '5' => esc_html__( '5', 'dual' ),
            '6' => esc_html__( '6', 'dual' ),
            ),
        'type'     => 'select',
    )
);


$wp_customize->add_setting( 'dual_slider_text_color',
    array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'dual_slider_text_color', 
    array(
        'label'      => esc_html__( 'Slider Text Color', 'dual' ),
        'section'    => 'homepage_slider_Section',
        'settings'   => 'dual_slider_text_color',
    ) ) 
);