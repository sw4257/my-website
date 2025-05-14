<?php
/**
* Single Post Options.
*
* @package Dual
*/

$dual_default = dual_get_default_theme_options();

$wp_customize->add_section( 'single_post_setting',
	array(
	'title'      => esc_html__( 'Single Post Settings', 'dual' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('dual_related_post',
    array(
        'default' => $dual_default['dual_related_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('dual_related_post',
    array(
        'label' => esc_html__('Enable Related Posts', 'dual'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'dual_related_section_title',
    array(
    'default'           => $dual_default['dual_related_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'dual_related_section_title',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'dual' ),
    'section'  => 'single_post_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('theme_navigation_type',
    array(
        'default' => $dual_default['theme_navigation_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_single_pagination_layout',
    )
);
$wp_customize->add_control('theme_navigation_type',
    array(
        'label' => esc_html__('Single Post Navigation Type', 'dual'),
        'section' => 'single_post_setting',
        'type' => 'select',
        'choices' => array(
                'no-navigation' => esc_html__('Disable Navigation','dual' ),
                'normal-navigation' => esc_html__('Next Previous Navigation','dual' ),
                'ajax-next-post-load' => esc_html__('Ajax Load Next 3 Posts Contents','dual' )
            ),
    )
);