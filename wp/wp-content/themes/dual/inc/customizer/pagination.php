<?php
/**
 * Pagination Settings
 *
 * @package Dual
 */

$dual_default = dual_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'dual_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'dual' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'dual_pagination_layout',
	array(
	'default'           => $dual_default['dual_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'dual_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'dual' ),
	'section'     => 'dual_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','dual'),
		'numeric' => esc_html__('Numeric Method','dual'),
		'load-more' => esc_html__('Ajax Load More Button','dual'),
		'auto-load' => esc_html__('Ajax Auto Load','dual'),
	),
	)
);