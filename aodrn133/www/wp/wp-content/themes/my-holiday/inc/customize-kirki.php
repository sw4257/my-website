<?php if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Update Kirki Path's
 *
 * @since 1.2.0
 */
function my_holidaykirki_configuration() {
    return array( 'url_path'     => get_stylesheet_directory_uri() . '/kirki/' );
}
add_filter( 'kirki/config', 'my_holidaykirki_configuration' );

/***********************************************
My Holiday Slider
************************************************/

Kirki::add_panel( 'my_holiday_slider', array(
    'priority'    => 1,
    'title'       => __( 'My Holiday Slider', 'my-holiday' ),
    'description' => __( 'My Holiday Slider', 'my-holiday' ),
) );

Kirki::add_section( 'slider_options', array(
    'title'          => __( 'Slider Options', 'my-holiday' ),
    'description'    => __( 'Slider Options', 'my-holiday' ),
    'panel'          => 'my_holiday_slider', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'activate_slider', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'activate_slider', array(
	'type'        => 'switch',
	'settings'    => 'activate_slider',
	'label'       => __( 'Activate the Slider on Home Page', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => '',
	'priority'    => 10,
	'choices'     => array(
		'on'  => esc_attr__( 'ON', 'my-holiday' ),
		'' => esc_attr__( 'OFF', 'my-holiday' ),
	),
) );

Kirki::add_config( 'slider_options_2', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_options_2', array(
	'type'        => 'radio',
	'settings'    => 'slider_options_2',
	'description'       => __( '<h3>Include with PHP code:</h3> Copy and paste the code below. <textarea onClick="this.select();" style="background: #999999; color: #fff; max-height: 28px; width: 220px; text-align: center;" readonly><?php my_holiday_slider (); ?></textarea>', 'my-holiday' ),
	'section'     => 'slider_options',
) ) ;

Kirki::add_config( 'slider_options_3', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_options_3', array(
	'type'        => 'slider',
	'settings'    => 'slider_options_3',
	'label'       => esc_attr__( 'Slider Height in %: ', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => 34,
	'choices'     => array(
		'min'  => '10',
		'max'  => '100',
		'step' => '1',
	),
) ) ;

Kirki::add_config( 'my_holiday_sidebar_time', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holiday_sidebar_time', array(
	'type'        => 'slider',
	'settings'    => 'my_holiday_sidebar_time',
	'label'       => esc_attr__( 'Slider Time in sec:', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => 1000,
	'choices'     => array(
		'min'  => '1000',
		'max'  => '20000',
		'step' => '1000',
	),
) );

Kirki::add_config( 'slider_loader_opacity', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_loader_opacity', array(
	'type'        => 'slider',
	'settings'    => 'slider_loader_opacity',
	'label'       => esc_attr__( 'Loader Opacity:', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => 0.8,
	'choices'     => array(
		'min'  => '0.1',
		'max'  => '1',
		'step' => '0.1',
	),
) );

Kirki::add_config( 'loader_position', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'loader_position', array(
	'type'        => 'select',
	'settings'    => 'loader_position',
	'label'       => __( 'Loader Position', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => 'rightTop',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'rightTop' => esc_attr__( 'rightTop', 'my-holiday' ),
		'leftTop' => esc_attr__( 'leftTop', 'my-holiday' ),
		'leftBottom' => esc_attr__( 'leftBottom', 'my-holiday' ),
		'rightBottom' => esc_attr__( 'rightBottom', 'my-holiday' ),
	),
) );

Kirki::add_config( 'slider_loader_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_loader_color', array(
	'type'        => 'color',
	'settings'    => 'slider_loader_color',
	'label'       => __( 'Loader Color', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => '#333333',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
) );


Kirki::add_config( 'my_holiday_sidebar_trans', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holiday_sidebar_trans', array(
	'type'        => 'slider',
	'settings'    => 'my_holiday_sidebar_trans',
	'label'       => esc_attr__( 'Slider Effect Period in sec:', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => 1000,
	'choices'     => array(
		'min'  => '100',
		'max'  => '10000',
		'step' => '100',
	),
) );

Kirki::add_config( 'pagination_slider', array(
	'capability'	=> 'edit_theme_options'
) );


Kirki::add_field( 'pagination_slider', array(
	'type'        => 'switch',
	'settings'    => 'pagination_slider',
	'label'       => __( 'Activate Pagination', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => '',
	'priority'    => 10,
	'choices'     => array(
		'on'  => esc_attr__( 'ON', 'my-holiday' ),
		'' => esc_attr__( 'OFF', 'my-holiday' ),
	),
) );

Kirki::add_config( 'buttons_background', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'buttons_background', array(
	'type'        => 'color',
	'settings'    => 'buttons_background',
	'label'       => __( 'Buttons Background', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => '#333333',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
) );

Kirki::add_config( 'slider_link_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_link_color', array(
	'type'        => 'color',
	'settings'    => 'slider_link_color',
	'label'       => __( 'Link Color', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => '#ffffff',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
) );

Kirki::add_config( 'slider_link_hover_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_link_hover_color', array(
	'type'        => 'color',
	'settings'    => 'slider_link_hover_color',
	'label'       => __( 'Link Hover Color', 'my-holiday' ),
	'section'     => 'slider_options',
	'default'     => '#eeeeee',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
	),
) );


/******************* Sliders **********************/

for($sl=1;$sl<=1;$sl++) {
	
Kirki::add_section( 'slider_'.$sl, array(
    'title'          => __( 'Slide '.$sl, 'my-holiday' ),
    'description'    => __( 'Slide '.$sl, 'my-holiday' ),
    'panel'          => 'my_holiday_slider', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'slider_image_'.$sl, array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_image_'.$sl, array(
	'type'        => 'image',
	'settings'    => 'slider_image_'.$sl,
	'label'       => __( 'Slide Image '.$sl, 'my-holiday' ),
	'description' => __( 'Slide Image '.$sl, 'my-holiday' ),
	'section'     => 'slider_'.$sl,
	'default'     => '',
	'priority'    => 10,
) );

Kirki::add_config( 'slider_text_'.$sl, array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_text_'.$sl, array(
	'type'        => 'text',
	'settings'    => 'slider_text_'.$sl,
	'label'       => esc_attr__( 'Slide Text '.$sl, 'my-holiday' ),
	'section'     => 'slider_'.$sl,
) ) ;


Kirki::add_config( 'slider_link_'.$sl, array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_link_'.$sl, array(
	'type'        => 'url',
	'settings'    => 'slider_link_'.$sl,
	'label'       => esc_attr__( 'Slide Link '.$sl, 'my-holiday' ),
	'section'     => 'slider_'.$sl,
) ) ;

}

/******************* Sliders **********************/

for($sl=2;$sl<=20;$sl++) {
	
Kirki::add_section( 'slider_'.$sl, array(
    'title'          => __( 'Slide '.$sl, 'my-holiday' ),

    'panel'          => 'my_holiday_slider', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'slider_text_'.$sl, array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'slider_text_'.$sl, array(
	'type'        => 'radio',
	'settings'    => 'slider_text_'.$sl,
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'slider_'.$sl,
) ) ;

}

/***********************************************
Premium Options
************************************************/

Kirki::add_panel( 'my_holiday_panel', array(
    'priority'    => 1,
    'title'       => __( 'Premium Options', 'my-holiday' ),
    'description' => __( 'Premium Options', 'my-holiday' ),
) );

/***********************************************
Header Options
************************************************/

Kirki::add_section( 'my_holiday_header', array(
    'title'          => __( 'Header Options', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidayad_logo', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holidayad_logo', array(
	'type'        => 'radio',
	'settings'    => 'my_holidayad_logo',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holiday_header',
	'default'     => '',
	'priority'    => 10,
) );


/***********************************************
Menu Options
************************************************/

Kirki::add_section( 'my_holidaykirki_section13', array(
    'title'          => __( 'Menu Options', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidaymenu_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holidaymenu_color', array(
	'type'        => 'radio',
	'settings'    => 'my_holidaymenu_color',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section13',
	'default'     => '',
	'priority'    => 10,
) );	

/***********************************************
Content Options
************************************************/

Kirki::add_section( 'my_holidaykirki_section9', array(
    'title'          => __( 'Content Options', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'main_background_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'main_background_color', array(
	'type'        => 'radio',
	'settings'    => 'main_background_color',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section9',
	'default'     => '',
	'priority'    => 10,
) );

/***********************************************
Sidebar Options
************************************************/

Kirki::add_section( 'my_holidaykirki_section10', array(
    'title'          => __( 'Sidebar Options', 'my-holiday' ),
    'description'    => __( 'Sidebar Options', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'sidebar_title_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_title_color', array(
	'type'        => 'color',
	'settings'    => 'sidebar_title_color',
	'label'       => __( 'Sidebar Title Color', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '#ffffff',
	'priority'    => 10,
) );

Kirki::add_config( 'sidebar_title_background_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_title_background_color', array(
	'type'        => 'color',
	'settings'    => 'sidebar_title_background_color',
	'label'       => __( 'Sidebar Title Background Color', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '#E20000',
	'priority'    => 10,
) );

Kirki::add_config( 'sidebar_menu_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_menu_color', array(
	'type'        => 'color',
	'settings'    => 'sidebar_menu_color',
	'label'       => __( 'Sidebar Menu Color', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '#ffffff',
	'priority'    => 10,
) );

Kirki::add_config( 'sidebar_menu_border_bottom', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_menu_border_bottom', array(
	'type'        => 'color',
	'settings'    => 'sidebar_menu_border_bottom',
	'label'       => __( 'Sidebar Menu Border Bottom Color', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '#350000',
	'priority'    => 10,
) );

Kirki::add_config( 'sidebar_menu_border_top', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_menu_border_top', array(
	'type'        => 'color',
	'settings'    => 'sidebar_menu_border_top',
	'label'       => __( 'Sidebar Menu Border Top Color', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '#E20000',
	'priority'    => 10,
) );

Kirki::add_config( 'sidebar_link_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_link_color', array(
	'type'        => 'color',
	'settings'    => 'sidebar_link_color',
	'label'       => __( 'Sidebar Link Color', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '#005796',
	'priority'    => 10,
) );

Kirki::add_config( 'sidebar_link_hover_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_link_hover_color', array(
	'type'        => 'color',
	'settings'    => 'sidebar_link_hover_color',
	'label'       => __( 'Sidebar Link Hover Color', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '#005796',
	'priority'    => 10,
) );

Kirki::add_config( 'sidebar_width', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_width', array(
	'type'        => 'slider',
	'settings'    => 'sidebar_width',
	'label'       => esc_attr__( 'Sidebar Width', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => 30,
	'choices'     => array(
		'min'  => '10',
		'max'  => '50',
		'step' => '1',
	),
) );

Kirki::add_config( 'sidebar_position', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_position', array(
	'type'        => 'radio-image',
	'settings'    => 'sidebar_position',
	'label'       => esc_html__( 'Sidebar Position', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section10',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => array(
		'1'   => get_template_directory_uri() . '/images/sidebar-left.png',
		'2' => get_template_directory_uri() . '/images/sidebar-right.png',
		'3'  => get_template_directory_uri() . '/images/no-sidebar.png',
	),
) );


/***********************************************
Footer Options
************************************************/

Kirki::add_section( 'my_holidaykirki_section11', array(
    'title'          => __( 'Footer Options', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );


Kirki::add_config( 'footer_title_color', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'footer_title_color', array(
	'type'        => 'radio',
	'settings'    => 'footer_title_color',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section11',
	'default'     => '#fff',
	'priority'    => 10,
) );


/***********************************************
WooCommerce Options
************************************************/

Kirki::add_section( 'my_holiday_section_animations_8', array(
    'title'          => __( 'WooCommerce Options', 'my-holiday' ),
    'priority'       => 1,
	'panel'          => 'my_holiday_panel', // Not typically needed.
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holiday_display_woo_cart', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holiday_display_woo_cart', array(
	'type'        => 'radio',
	'settings'    => 'my_holiday_display_woo_cart',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holiday_section_animations_8',
	'default'     => '',
	'priority'    => 10,
) );

/***********************************************
Social Icons
************************************************/

Kirki::add_section( 'my_holidaykirki_section15', array(
    'title'          => __( 'Social Icons', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holiday_socia_activate', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holiday_socia_activate', array(
	'type'        => 'radio',
	'settings'    => 'my_holiday_socia_activate',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section15',
	'default'     => '',
	'priority'    => 10,
) );


/***********************************************
Disable All Comments
************************************************/

Kirki::add_section( 'my_holidaykirki_section1', array(
    'title'          => __( 'Disable All Comments', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidaysetting1', array(
	'capability'	=> 'edit_theme_options'
) );
	
Kirki::add_field( 'my_holidaysetting1', array(
	'type'        => 'radio',
	'settings'    => 'my_holidaysetting1',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section1',
	'default'     => '',
	'priority'    => 2,
) );


/***********************************************
Hide All Page and Post Titles
************************************************/

Kirki::add_section( 'my_holidaykirki_section8', array(
    'title'          => __( 'Hide All Titles', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidayhide_titles', array(
	'capability'	=> 'edit_theme_options'
) );
	
Kirki::add_field( 'my_holidayhide_titles', array(
	'type'        => 'radio',
	'settings'    => 'my_holidayhide_titles',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section8',
	'default'     => '',
	'priority'    => 2,
) );


/***********************************************
Animations
************************************************/

Kirki::add_panel( 'animations', array(
    'priority'    => 1,
    'title'       => __( 'Animations', 'my-holiday' ),
    'description' => __( 'Animations', 'my-holiday' ),
) );


/****** Animation Site Title ******/

Kirki::add_section( 'animation_1', array(
    'title'          => __( 'Site Title Animation', 'my-holiday' ),
    'panel'          => 'animations', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'site_title_animations', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'site_title_animations', array(
	'type'        => 'select',
	'settings'    => 'site_title_animations',
	'label'       => __( 'Site Title Animation', 'my-holiday' ),
	'section'     => 'animation_1',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
	    '' => esc_attr__( 'None', 'my-holiday' ),
	    'fadeIn' => esc_attr__( 'fadeIn', 'my-holiday' ),
		'flipInX' => esc_attr__( 'flipInX', 'my-holiday' ),
		'bounce' => esc_attr__( 'bounce', 'my-holiday' ),
		'bounceIn' => esc_attr__( 'bounceIn', 'my-holiday' ),
		'bounceInDown' => esc_attr__( 'bounceInDown', 'my-holiday' ),
		'bounceInLeft' => esc_attr__( 'bounceInLeft', 'my-holiday' ),
		'bounceInRight' => esc_attr__( 'bounceInRight', 'my-holiday' ),
		'bounceInUp' => esc_attr__( 'bounceInUp', 'my-holiday' ),
		'fadeInDownBig' => esc_attr__( 'fadeInDownBig', 'my-holiday' ),
		'fadeInLeft' => esc_attr__( 'fadeInLeft', 'my-holiday' ),
		'fadeInLeftBig' => esc_attr__( 'fadeInLeftBig', 'my-holiday' ),
		'fadeInRight' => esc_attr__( 'fadeInRight', 'my-holiday' ),
		'fadeInRightBig' => esc_attr__( 'fadeInRightBig', 'my-holiday' ),
		'fadeInUp' => esc_attr__( 'fadeInUp', 'my-holiday' ),
		'fadeInUpBig' => esc_attr__( 'fadeInUpBig', 'my-holiday' ),
		'flash' => esc_attr__( 'flash', 'my-holiday' ),
		'flip' => esc_attr__( 'flip', 'my-holiday' ),
		'flipInY' => esc_attr__( 'flipInY', 'my-holiday' ),
		'headShake' => esc_attr__( 'headShake', 'my-holiday' ),
		'hinge' => esc_attr__( 'hinge', 'my-holiday' ),
		'jello' => esc_attr__( 'jello', 'my-holiday' ),
		'lightSpeedIn' => esc_attr__( 'lightSpeedIn', 'my-holiday' ),
		'pulse' => esc_attr__( 'pulse', 'my-holiday' ),
		'rollIn' => esc_attr__( 'rollIn', 'my-holiday' ),
		'rotateIn' => esc_attr__( 'rotateIn', 'my-holiday' ),
		'rotateInDownLeft' => esc_attr__( 'rotateInDownLeft', 'my-holiday' ),
		'rotateInDownRight' => esc_attr__( 'rotateInDownRight', 'my-holiday' ),
		'rotateInUpLeft' => esc_attr__( 'rotateInUpLeft', 'my-holiday' ),
		'rotateInUpRight' => esc_attr__( 'rotateInUpRight', 'my-holiday' ),
		'shake' => esc_attr__( 'shake', 'my-holiday' ),
		'slideInDown' => esc_attr__( 'slideInDown', 'my-holiday' ),
		'slideInLeft' => esc_attr__( 'slideInLeft', 'my-holiday' ),
		'slideInRight' => esc_attr__( 'slideInRight', 'my-holiday' ),
		'slideInUp' => esc_attr__( 'slideInUp', 'my-holiday' ),
		'swing' => esc_attr__( 'swing', 'my-holiday' ),
		'tada' => esc_attr__( 'tada', 'my-holiday' ),
		'wobble' => esc_attr__( 'wobble', 'my-holiday' ),
		'zoomIn' => esc_attr__( 'zoomIn', 'my-holiday' ),
		'zoomInDown' => esc_attr__( 'zoomInDown', 'my-holiday' ),
		'zoomInLeft' => esc_attr__( 'zoomInLeft', 'my-holiday' ),
		'zoomInRight' => esc_attr__( 'zoomInRight', 'my-holiday' ),
		'zoomInUp' => esc_attr__( 'zoomInUp', 'my-holiday' ),
	),
		'default'     => 'bounceInRight',
) );


Kirki::add_config( 'site_title_animations_speed', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'site_title_animations_speed', array(
	'type'        => 'slider',
	'settings'    => 'site_title_animations_speed',
	'label'       => __( 'Site Title Speed', 'my-holiday' ),
	'section'     => 'animation_1',
	'priority'    => 10,
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '0.1',
	),
		'default'     => '1',
) );


/****** Animation Menu ******/

Kirki::add_section( 'animation_2', array(
    'title'          => __( 'Sub Menu Animation', 'my-holiday' ),
    'panel'          => 'animations', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );


Kirki::add_config( 'menu_animations_speed', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'menu_animations_speed', array(
	'type'        => 'radio',
	'settings'    => 'menu_animations_speed',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'animation_2',
	'priority'    => 11,
) );


/****** Animation Header Title ******/

Kirki::add_section( 'animation_3', array(
    'title'          => __( 'Sidebar Animation', 'my-holiday' ),
    'panel'          => 'animations', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'sidebar_animations_speed', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'sidebar_animations_speed', array(
	'type'        => 'radio',
	'settings'    => 'sidebar_animations_speed',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'animation_3',
	'priority'    => 11,

) );

/****** Animation Articles ******/

Kirki::add_section( 'animation_5', array(
    'title'          => __( 'Articles Animation', 'my-holiday' ),
    'panel'          => 'animations', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'articles_animations_speed', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'articles_animations_speed', array(
	'type'        => 'radio',
	'settings'    => 'articles_animations_speed',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'animation_5',
	'priority'    => 11,
) );


/****** Animation Footer ******/

Kirki::add_section( 'animation_6', array(
    'title'          => __( 'Footer Animation', 'my-holiday' ),
    'panel'          => 'animations', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'footer_animations_speed', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'footer_animations_speed', array(
	'type'        => 'radio',
	'settings'    => 'footer_animations_speed',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'animation_6',
	'priority'    => 11,
) );


/***********************************************
All Google Fonts
************************************************/
Kirki::add_section( 'my_holidaykirki_section4', array(
    'title'          => __( 'All Google Fonts', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidaygoogle_font_h7', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holidaygoogle_font_h7', array(
	'type'     => 'radio',
	'settings' => 'my_holidaygoogle_font_h7',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'  => 'my_holidaykirki_section4',
	'default'  => '',  
	'priority' => 1,
) );

/***********************************************
Mobile Call Now
************************************************/

Kirki::add_section( 'my_holidaykirki_section5', array(
    'title'          => __( 'Mobile Call Now', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidayphone_number', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holidayphone_number', array(
	'type'     => 'radio',
	'settings' => 'my_holidayphone_number',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'  => 'my_holidaykirki_section5',
	'priority' => 10,
) );


/***********************************************
Read More Button Options
************************************************/

Kirki::add_section( 'my_holidaykirki_section6', array(
    'title'          => __( 'Read More Button', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidayread_more_activate', array(
	'capability'	=> 'edit_theme_options'
) );
	
Kirki::add_field( 'my_holidayread_more_activate', array(
	'type'        => 'radio',
	'settings'    => 'my_holidayread_more_activate',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section6',
	'default'     => '',
	'priority'    => 1,
) );

/***********************************************
Back To Top Button
************************************************/

Kirki::add_section( 'my_holiday_back_to_top_section', array(
    'title'          => __( 'Back To Top Button Options', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.	
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'back_to_top_activate', array(
	'capability'	=> 'edit_theme_options'
) );
	
Kirki::add_field( 'back_to_top_activate', array(
	'type'        => 'radio',
	'settings'    => 'back_to_top_activate',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holiday_back_to_top_section',
	'default'     => '',
	'priority'    => 9,
) );


/***********************************************
Banners
************************************************/

Kirki::add_section( 'my_holidaykirki_section16', array(
    'title'          => __( 'Banner', 'my-holiday' ),
    'panel'          => 'my_holiday_panel', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_config( 'my_holidayad_top', array(
	'capability'	=> 'edit_theme_options'
) );

Kirki::add_field( 'my_holidayad_top', array(
	'type'        => 'radio',
	'settings'    => 'my_holidayad_top',
	'description'       => __( '<a target="_blank" href="https://seosthemes.com/my-holiday/">Premium Theme with allot of features. </a>', 'my-holiday' ),
	'section'     => 'my_holidaykirki_section16',
	'default'     => '',
	'priority'    => 10,
) );


/***********************************************************
* Just hide all comments
***********************************************************/
	add_action('wp_head','disable_all_comments_1');
	function disable_all_comments_1 () {
	if (get_theme_mod('my_holidaysetting1')) {

			echo "<style> #comments { display: none !important; }</style>";
		}

	}
	
/***********************************************************
* Hide existing comments
***********************************************************/


	function disable_all_comments_hide_existing_comments($comments) {
			$comments = array();
			return $comments;
		}
	if (get_theme_mod( 'my_holidaysetting2',true )) {	
		add_filter('comments_array', 'disable_all_comments_hide_existing_comments', 10, 2);
	}	
/***********************************************************
* Remove comments page in menu
***********************************************************/

	add_action('admin_menu', 'disable_all_comments_admin_menu');
	
	function disable_all_comments_admin_menu() {
	if (get_theme_mod( 'my_holidaysetting3' )) {
		
			remove_menu_page('edit-comments.php');
		}

	}
	

/*********************************************************************************************************
* Excerpt
**********************************************************************************************************/
	
		function my_holidaymagazine_excerpt_more( $more ) {
				if (get_theme_mod('my_holidayread_more_activate') =="on") {
				return '<p class="link-more"><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . my_holidayreturn_read_more_text (). '</a></p>';
			}
		}
			add_filter( 'excerpt_more', 'my_holidaymagazine_excerpt_more' );

		function custom_excerpt_length( $length ) {
			if (get_theme_mod('my_holidayread_more_lenght') and get_theme_mod('my_holidayread_more_activate')) {
				return get_theme_mod('my_holidayread_more_lenght');
			}
			else return 42;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	
	function my_holidayreturn_read_more_text () {
		if (get_theme_mod('my_holidayread_more_text')) {	 
			return get_theme_mod('my_holidayread_more_text');
		} 
		return "Read More";
	}


	


/*****************************************************
Kirki Styles
*****************************************************/

function my_holidaykirki_styles () { ?>
	<style>
		<?php if(get_theme_mod('margin_top')) { ?> #page { margin-top: <?php echo esc_html(get_theme_mod('margin_top')); ?>px !important; } <?php } ?>
		<?php if(get_theme_mod('title_font_size')) { ?> header .site-branding .site-title { font-size: <?php echo esc_html(get_theme_mod('title_font_size')); ?>px !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidaymenu_color')) { ?> .main-navigation ul li a, .main-navigation li > a:after { color: <?php echo esc_html(get_theme_mod('my_holidaymenu_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidaymenu_hover_color')) { ?> .main-navigation ul li a:hover, .main-navigation li > a:hover:after { color: <?php echo esc_html(get_theme_mod('my_holidaymenu_hover_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidaymenu_background_color')) { ?> .main-navigation { background: <?php echo esc_html(get_theme_mod('my_holidaymenu_background_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidaysub_menu_background_color')) { ?> .main-navigation ul ul li a { background: <?php echo esc_html(get_theme_mod('my_holidaysub_menu_background_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidaymenu_background_hover_color')) { ?> .main-navigation ul ul li a:hover { background: <?php echo esc_html(get_theme_mod('my_holidaymenu_background_hover_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidaysub_menu_border_bottom')) { ?> .main-navigation ul ul li a { border-bottom: 1px solid <?php echo esc_html(get_theme_mod('my_holidaysub_menu_border_bottom')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidaysub_menu_border_top')) { ?> .main-navigation ul ul li a { border-top: 1px solid <?php echo esc_html(get_theme_mod('my_holidaysub_menu_border_top')); ?> !important; } <?php } ?>	
		<?php if(get_theme_mod('main_background_color')) { ?> #content { background: <?php echo esc_html(get_theme_mod('main_background_color')); ?> !important; } <?php } ?>	
		<?php if(get_theme_mod('link_color')) { ?> article a  { color: <?php echo esc_html(get_theme_mod('link_color')); ?> ; } <?php } ?>	
		<?php if(get_theme_mod('link_hover_color')) { ?> article a:hover { color: <?php echo esc_html(get_theme_mod('link_hover_color')); ?> !important; } <?php } ?>	
		<?php if(get_theme_mod('article_border_bottom_color')) { ?> #content article { border-bottom: 1px solid <?php echo esc_html(get_theme_mod('article_border_bottom_color')); ?> !important; } <?php } ?>	
		<?php if(get_theme_mod('article_border_top_color')) { ?> #content article { border-top: 1px solid <?php echo esc_html(get_theme_mod('article_border_top_color')); ?> !important; } <?php } ?>	
		<?php if(get_theme_mod('sticky_post_background')) { ?> .sticky { background: <?php echo esc_html(get_theme_mod('sticky_post_background')); ?> !important; } <?php } ?>	
		<?php if(get_theme_mod('content_font_size')) { ?>  article p { font-size: <?php echo esc_html(get_theme_mod('content_font_size')); ?>px !important; } <?php } ?>	
		<?php if(get_theme_mod('content_font_size')) { ?>  article p { line-height: <?php echo esc_html(get_theme_mod('content_font_size')); ?>px !important; } <?php } ?>
		<?php if(get_theme_mod('hide_date')) { ?>  .entry-meta .posted-on { display: none !important; } <?php } ?>
		<?php if(get_theme_mod('hide_author')) { ?>  .entry-meta .byline { display: none !important; } <?php } ?>
		<?php if(get_theme_mod('hide_posted_in')) { ?>  .cat-links, .entry-footer .fa-folder-open { display: none !important; } <?php } ?>
		<?php if(get_theme_mod('hide_tags')) { ?>  .tags-links, .entry-footer .fa-tags { display: none !important; } <?php } ?>
		<?php if(get_theme_mod('hide_comments')) { ?>  .comments-link, .entry-footer .fa-comment { display: none !important; } <?php } ?>
		<?php if(get_theme_mod('sidebar_title_background_color')) { ?> #content aside h2, #secondary .menu li { background: <?php echo esc_html(get_theme_mod('sidebar_title_background_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('sidebar_menu_color')) { ?> #secondary .menu li a, #secondary .menu li > a::after { color: <?php echo esc_html(get_theme_mod('sidebar_menu_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('sidebar_menu_border_bottom')) { ?> #secondary .menu li { border-bottom: 1px solid <?php echo esc_html(get_theme_mod('sidebar_menu_border_bottom')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('sidebar_menu_border_top')) { ?> #secondary .menu li { border-top: 1px solid <?php echo esc_html(get_theme_mod('sidebar_menu_border_top')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('sidebar_title_color')) { ?> #content aside h2 { color: <?php echo esc_html(get_theme_mod('sidebar_title_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('sidebar_link_color')) { ?> aside a { color: <?php echo esc_html(get_theme_mod('sidebar_link_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('sidebar_link_hover_color')) { ?> aside a:hover { color: <?php echo esc_html(get_theme_mod('sidebar_link_hover_color')); ?> !important; } <?php } ?>	
		<?php if(get_theme_mod('footer_title_color')) { ?> .site-footer h2 { color: <?php echo esc_html(get_theme_mod('footer_title_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('footer_link_color')) { ?> .footer-widgets ul li a, .site-footer .site-info a { color: <?php echo esc_html(get_theme_mod('footer_link_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('footer_link_hover_color')) { ?> .footer-widgets ul li a:hover, .site-footer .site-info a:hover { color: <?php echo esc_html(get_theme_mod('footer_link_hover_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('my_holidaywoo_cart_color')) { ?> .dark-cart a { color: <?php echo esc_html(get_theme_mod('my_holidaywoo_cart_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('my_holidaywoo_cart_hover_color')) { ?> .dark-cart a:hover { color: <?php echo esc_html(get_theme_mod('my_holidaywoo_cart_hover_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('my_holidaywoo_cart_background')) { ?> .dark-cart { background: <?php echo esc_html(get_theme_mod('my_holidaywoo_cart_background')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('my_holidaywoo_cart_background_hover')) { ?> .dark-cart:hover { background: <?php echo esc_html(get_theme_mod('my_holidaywoo_cart_background_hover')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('read_more_button_background_color')) { ?> .read-more { background: <?php echo esc_html(get_theme_mod('read_more_button_background_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('read_more_button_background_hover_color')) { ?> .read-more:hover { background: <?php echo esc_html(get_theme_mod('read_more_button_background_hover_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('read_more_button_color')) { ?> .read-more { color: <?php echo esc_html(get_theme_mod('read_more_button_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('read_more_button_hover_color')) { ?> .read-more:hover { color: <?php echo esc_html(get_theme_mod('read_more_button_hover_color')); ?> !important; } <?php } ?>		
		
		<?php if(get_theme_mod('my_holiday_back_to_top_color')) { ?> #smoothup { color: <?php echo esc_html(get_theme_mod('my_holiday_back_to_top_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('my_holiday_back_to_top_hover_color')) { ?> #smoothup:hover { color: <?php echo esc_html(get_theme_mod('my_holiday_back_to_top_hover_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('my_holiday_back_to_top_background_color')) { ?> #smoothup{ background: <?php echo esc_html(get_theme_mod('my_holiday_back_to_top_background_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('my_holiday_back_to_top_background_hover_color')) { ?> #smoothup:hover { background: <?php echo esc_html(get_theme_mod('my_holiday_back_to_top_background_hover_color')); ?> !important; } <?php } ?>		
		
		<?php if(get_theme_mod('my_holidayicons_color')) { ?>.social .fa-icons a, .social .fa-icons i { color: <?php echo esc_html(get_theme_mod('my_holidayicons_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holidayicons_hover_color')) { ?>.social .fa-icons a:hover, .social .fa-icons i:hover { color: <?php echo esc_html(get_theme_mod('my_holidayicons_hover_color')); ?> !important; } <?php } ?>
		
		<?php if(get_theme_mod('footer_background')) { ?> .site-footer { background-color: <?php echo esc_html(get_theme_mod('footer_background')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('footer_widget_border_top')) { ?> .border-footer { border-top: 1px solid <?php echo esc_html(get_theme_mod('footer_widget_border_top')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('footer_widget_border_bottom')) { ?> .border-footer { border-bottom: 1px solid <?php echo esc_html(get_theme_mod('footer_widget_border_bottom')); ?> !important; } <?php } ?>
		
		
		<?php if(get_theme_mod('buttons_background')) { ?> .camera_prevThumbs, .camera_nextThumbs, .camera_prev, .camera_next, .camera_commands, .camera_thumbs_cont { background: <?php echo esc_html(get_theme_mod('buttons_background')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('slider_link_color')) { ?> .camera_caption a { color: <?php echo esc_html(get_theme_mod('slider_link_color')); ?> !important; } <?php } ?>		
		<?php if(get_theme_mod('slider_link_hover_color')) { ?> .camera_caption a:hover { color: <?php echo esc_html(get_theme_mod('slider_link_hover_color')); ?> !important; } <?php } ?>		
		
		<?php if(get_theme_mod('my_holiday_woo_cart_color')) { ?> .my_holiday-cart a { color: <?php echo esc_html(get_theme_mod('my_holiday_woo_cart_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holiday_woo_cart_hover_color')) { ?> .my_holiday-cart a:hover { color: <?php echo esc_html(get_theme_mod('my_holiday_woo_cart_hover_color')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holiday_woo_cart_background')) { ?> .my_holiday-cart .seos-cart { background: <?php echo esc_html(get_theme_mod('my_holiday_woo_cart_background')); ?> !important; } <?php } ?>
		<?php if(get_theme_mod('my_holiday_woo_cart_background_hover')) { ?> .my_holiday-cart .seos-cart:hover { background: <?php echo esc_html(get_theme_mod('my_holiday_woo_cart_background_hover')); ?> !important; } <?php } ?>

		<?php if(get_theme_mod('my_holidayhide_titles')) { ?> .mh-post .entry-title, .mh-page .entry-title, .mh-page .page-title {display: none !important;} <?php } ?>
			
		<?php if(!get_theme_mod('custom_header_overlay')) { ?> .dotted { background-image: none; !important; } <?php } ?>

		<?php if(get_theme_mod('sidebar_position') == "2") { ?> #content aside {float: right !important; padding: 20px 40px 0 0 ;} #content main {float: left !important; padding: 0 0 0 40px;} <?php } ?>
		<?php if(get_theme_mod('sidebar_position') == "3") { ?> #content aside {display: none; !important;} #content main {float: none !important; width: 100% !important; padding: 0 40px 0 40px;} <?php } ?>
		
		<?php if(!get_theme_mod('pagination_slider')) { ?> .camera_thumbs {display: none; !important;} <?php } ?>
		<?php if(get_theme_mod('header_site_title_hover_color')) { ?> header .site-branding .site-title a:hover, header .header-img .site-title a:hover {color: <?php echo esc_html(get_theme_mod('header_site_title_hover_color')); ?> !important;} <?php } ?>

		
	</style>
<?php }
	add_action('wp_head','my_holidaykirki_styles');
	
/**************************************
Kirki Sidebar Options
**************************************/

if(get_theme_mod('sidebar_width')) {
	

	function my_holidaysidebar_width () { 
	$my_holidaycontent_width = 95;
	$my_holidaysidebar_width = esc_html(get_theme_mod('sidebar_width'));
	$my_holidaysidebar_sum = $my_holidaycontent_width - $my_holidaysidebar_width;

	?>
		<style>
			#content aside {width: <?php echo esc_html(get_theme_mod('sidebar_width')); ?>% !important;}
			#content main {width: <?php echo $my_holidaysidebar_sum; ?>%;}
		</style>
		
	<?php }

	add_action('wp_head','my_holidaysidebar_width');
	
}

	
	
function customize_styles_agama_support( $input ) { ?>
	<style type="text/css">

#customize-theme-controls   #accordion-section-slider_2 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_3 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_4 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_5 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_6 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_7 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_8 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_9 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_10 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_11 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_12 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_13 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_14 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_15 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_16 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_17 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_18 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_19 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_19 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-slider_20 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-animation_2 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-animation_3 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-animation_4 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-animation_5 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-animation_6 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section1 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section6 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holiday_header .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holiday_back_to_top_section .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section9 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holiday_section_animations_8 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section4 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section5 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section8 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section11 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section15 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section16 .accordion-section-title:after,
#customize-theme-controls   #accordion-section-my_holidaykirki_section13 .accordion-section-title:after {
			font-size: 13px;
			font-weight: bold;
			content: "Premium";
			float: right;
			right: 40px;
			position: relative;
			color: #FF0000;
		}

	</style>
<?php }
add_action( 'customize_controls_print_styles', 'customize_styles_agama_support');	