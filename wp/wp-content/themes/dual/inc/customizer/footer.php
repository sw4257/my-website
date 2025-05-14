<?php
/**
* Footer Settings.
*
* @package Dual
*/

$dual_default = dual_get_default_theme_options();


$wp_customize->add_section( 'dual_footer_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'dual' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting( 'dual_copyright_text',
	array(
	'default'           => $dual_default['dual_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'dual_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'dual' ),
	'section'  => 'dual_footer_area',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('dual_ed_footer_scroll_top_button',
    array(
        'default' => $dual_default['dual_ed_footer_scroll_top_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dual_sanitize_checkbox',
    )
);
$wp_customize->add_control('dual_ed_footer_scroll_top_button',
    array(
        'label' => esc_html__('Enable Scroll Top Button', 'dual'),
        'section' => 'dual_footer_area',
        'type' => 'checkbox',
    )
);