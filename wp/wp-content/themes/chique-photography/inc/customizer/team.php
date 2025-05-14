<?php
/**
 * Team options
 *
 * @package Chique Photography
 */

/**
 * Add team content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chique_team_options( $wp_customize ) {

	$wp_customize->add_section( 'chique_team', array(
			'title' => esc_html__( 'Team', 'chique-photography' ),
			'panel' => 'chique_theme_options',
		)
	);

	// Add color scheme setting and control.
	chique_register_option( $wp_customize, array(
			'name'              => 'chique_team_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'chique_sanitize_select',
			'choices'           => chique_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'chique-photography' ),
			'section'           => 'chique_team',
			'type'              => 'select',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_team_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_team_active',
			'label'             => esc_html__( 'Headline', 'chique-photography' ),
			'section'           => 'chique_team',
			'type'              => 'text',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_team_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'chique_is_team_active',
			'label'             => esc_html__( 'Sub headline', 'chique-photography' ),
			'section'           => 'chique_team',
			'type'              => 'textarea',
		)
	);

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_team_number',
			'default'           => 5,
			'sanitize_callback' => 'chique_sanitize_number_range',
			'active_callback'   => 'chique_is_team_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'chique-photography' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'chique-photography' ),
			'section'           => 'chique_team',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'chique_team_number', 5 );

	//loop for team post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		chique_register_option( $wp_customize, array(
			'name'              => 'chique_team_page_' . $i,
			'sanitize_callback' => 'chique_sanitize_post',
			'active_callback'   => 'chique_is_team_active',
			'label'             => esc_html__( 'Team Page', 'chique-photography' ) . ' ' . $i ,
			'section'           => 'chique_team',
			'type'              => 'dropdown-pages',
		)
	);
	} // End for().
}
add_action( 'customize_register', 'chique_team_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'chique_is_team_active' ) ) :
	/**
	* Return true if team content is active
	*
	* @since Solid Construction Pro 1.0
	*/
	function chique_is_team_active( $control ) {
		$enable = $control->manager->get_setting( 'chique_team_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( chique_check_section( $enable ) );
	}
endif;

