<?php
/**
 * Buildcon Lite Theme Customizer
 *
 * @package Buildcon Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function buildcon_lite_customize_register( $wp_customize ) {
	
function buildcon_lite_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
	
	$wp_customize->get_setting( 'blogname' )->photobook_lite         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->photobook_lite  = 'postMessage';
		
	$wp_customize->add_setting('color_scheme', array(
		'default' => '#ffbe00',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','buildcon-lite'),
			'description'	=> __('Select color from here.','buildcon-lite'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_setting('headerbg-color', array(
		'default' => '#000000',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'headerbg-color',array(
			'description'	=> __('Select background color for header.','buildcon-lite'),
			'section' => 'colors',
			'settings' => 'headerbg-color'
		))
	);

	$wp_customize->add_setting('headertxt-color', array(
		'default' => '#ffffff',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'headertxt-color',array(
			'description'	=> __('Select text color for top header and navigation menu.','buildcon-lite'),
			'section' => 'colors',
			'settings' => 'headertxt-color'
		))
	);
	
	$wp_customize->add_setting('footer-color', array(
		'default' => '#000000',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'footer-color',array(
			'description'	=> __('Select background color for footer.','buildcon-lite'),
			'section' => 'colors',
			'settings' => 'footer-color'
		))
	);

	// Top Header Start
	$wp_customize->add_section(
        'tophead_section',
        array(
            'title' => __('Top Header', 'buildcon-lite'),
            'priority' => null,
			'description'	=> __('Add top header info here.','buildcon-lite'),	
        )
    );

	$wp_customize->add_setting('call-txt',array(
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('call-txt',array(
			'type'	=> 'text',
			'label'	=> __('Add phone number here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));
	
	$wp_customize->add_setting('email-txt',array(
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('email-txt',array(
			'type'	=> 'text',
			'label'	=> __('Add email here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));

	$wp_customize->add_setting('wrkhrs-txt',array(
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('wrkhrs-txt',array(
			'type'	=> 'text',
			'label'	=> __('Add timing here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));
	
	$wp_customize->add_setting('facebook',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('facebook',array(
			'type'	=> 'url',
			'label'	=> __('Add facebook link here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));

	$wp_customize->add_setting('google-plus',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('google-plus',array(
			'type'	=> 'url',
			'label'	=> __('Add google plus link here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));
	
	$wp_customize->add_setting('twitter',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitter',array(
			'type'	=> 'url',
			'label'	=> __('Add twitter link here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));
	
	$wp_customize->add_setting('linkedin',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('linkedin',array(
			'type'	=> 'url',
			'label'	=> __('Add linkedin link here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));
	
	$wp_customize->add_setting('pinterest',array(
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('pinterest',array(
			'type'	=> 'url',
			'label'	=> __('Add pinterest link here.','buildcon-lite'),
			'section'	=> 'tophead_section'
	));
	
	$wp_customize->add_setting('hide_tophead',array(
			'default' => true,
			'sanitize_callback' => 'buildcon_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_tophead', array(
		   'settings' => 'hide_tophead',
    	   'section'   => 'tophead_section',
    	   'label'     => __('Check this to hide section.','buildcon-lite'),
    	   'type'      => 'checkbox'
     ));
	// Top Header End
	
	// Slider Section Start		
	$wp_customize->add_section(
        'slider_section',
        array(
            'title' => __('Slider Settings', 'buildcon-lite'),
            'priority' => null,
			'description'	=> __('Recommended image size (1420x567). Slider will work only when you select the static front page.','buildcon-lite'),	
        )
    );
	
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','buildcon-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','buildcon-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','buildcon-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('slide_text',array(
		'default'	=> __('Read More','buildcon-lite'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_text',array(
		'label'	=> __('Add slider link button text.','buildcon-lite'),
		'section'	=> 'slider_section',
		'setting'	=> 'slide_text',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('hide_slider',array(
		'default' => true,
		'sanitize_callback' => 'buildcon_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	)); 

	$wp_customize->add_control( 'hide_slider', array(
	   'settings' => 'hide_slider',
	   'section'   => 'slider_section',
	   'label'     => __('Check this to hide slider.','buildcon-lite'),
	   'type'      => 'checkbox'
    ));
	// Slider Section End

	// Welcome Section Start
	$wp_customize->add_section(
        'homepage_welcome_section',
        array(
            'title' => __('Welcome Section', 'buildcon-lite'),
            'priority' => null,
			'description'	=> __('Select pages for Welcome Section. This section will be displayed only when you select the static front page.','buildcon-lite'),	
        )
    );	
	
	$wp_customize->add_setting('wel-section-ttl',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('wel-section-ttl',array(
		'type'	=> 'text',
		'label'	=> __('Add Section Title Here','buildcon-lite'),
		'section'	=> 'homepage_welcome_section'
	));	
	
	$wp_customize->add_setting('wel-setting1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('wel-setting1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for first box','buildcon-lite'),
			'section'	=> 'homepage_welcome_section'
	));
	
	$wp_customize->add_setting('wel-setting2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('wel-setting2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for second box','buildcon-lite'),
			'section'	=> 'homepage_welcome_section'
	));
	
	$wp_customize->add_setting('wel-setting3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('wel-setting3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for third box','buildcon-lite'),
			'section'	=> 'homepage_welcome_section'
	));

	$wp_customize->add_setting('wel_more_text',array(
		'default'	=> __('Read More','buildcon-lite'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('wel_more_text',array(
		'label'	=> __('Add more link button text.','buildcon-lite'),
		'section'	=> 'homepage_welcome_section',
		'setting'	=> 'wel_more_text',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('hide_wel_section',array(
			'default' => true,
			'sanitize_callback' => 'buildcon_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_wel_section', array(
		   'settings' => 'hide_wel_section',
    	   'section'   => 'homepage_welcome_section',
    	   'label'     => __('Check this to hide section.','buildcon-lite'),
    	   'type'      => 'checkbox'
     ));
	// Welcome Section End

	// Service Sertion Start
	$wp_customize->add_section(
        'homepage_service_section',
        array(
            'title' => __('Services Section', 'buildcon-lite'),
            'priority' => null,
			'description'	=> __('Select pages for homepage services. This section will be displayed only when you select the static front page.','buildcon-lite'),	
        )
    );

    $wp_customize->add_setting('ser-section-ttl',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ser-section-ttl',array(
		'type'	=> 'text',
		'label'	=> __('Add Section Title Here','buildcon-lite'),
		'section'	=> 'homepage_service_section'
	));	
	
	$wp_customize->add_setting('ser-setting1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('ser-setting1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for first Service box','buildcon-lite'),
			'section'	=> 'homepage_service_section'
	));
	
	$wp_customize->add_setting('ser-setting2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('ser-setting2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for second Service box','buildcon-lite'),
			'section'	=> 'homepage_service_section'
	));
	
	$wp_customize->add_setting('ser-setting3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('ser-setting3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for third Service box','buildcon-lite'),
			'section'	=> 'homepage_service_section'
	));
	
	$wp_customize->add_setting('hide_ser_section',array(
			'default' => true,
			'sanitize_callback' => 'buildcon_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_ser_section', array(
		   'settings' => 'hide_ser_section',
    	   'section'   => 'homepage_service_section',
    	   'label'     => __('Check this to hide section.','buildcon-lite'),
    	   'type'      => 'checkbox'
     ));
	// Service Section End
	
}
add_action( 'customize_register', 'buildcon_lite_customize_register' );	

function buildcon_lite_css(){
		?>
        <style>
				a, 
				.tm_client strong,
				.postmeta a:hover,
				#sidebar ul li a:hover,
				.blog-post h3.entry-title,
				a.blog-more:hover,
				#commentform input#submit,
				input.search-submit,
				.nivo-controlNav a.active,
				.blog-date .date,
				a.read-more,
				.sitenav ul li a:hover,
				.header .logo p{
					color:<?php echo esc_attr(get_theme_mod('color_scheme','#ffbe00')); ?>;
				}
				h3.widget-title,
				.nav-links .current,
				.nav-links a:hover,
				p.form-submit input[type="submit"],
				.social a:hover, .welcome-box:before, .welcome-box:after, .welcome-box-inner:before, .welcome-box-inner:after{
					background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#ffbe00')); ?>;
				}
				h2.section_title:before, h2.section_title:after, .read-more{
					border-color:<?php echo esc_attr(get_theme_mod('color_scheme','#ffbe00')); ?>;
				}
				#header,
				.sitenav ul li.menu-item-has-children:hover > ul,
				.sitenav ul li.menu-item-has-children:focus > ul,
				.sitenav ul li.menu-item-has-children.focus > ul{
					background-color:<?php echo esc_attr(get_theme_mod('headerbg-color','#000000')); ?>;
				}
				.copyright-wrapper{
					background-color:<?php echo esc_attr(get_theme_mod('footer-color','#000000')); ?>;
				}
				#slider a.slide-button{
					background-color: <?php echo esc_attr(get_theme_mod('color_scheme','#ffbe00')); ?>;
				}
				#slider a.slide-button:hover{
					background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#000000')); ?>;
					color: #ffffff;
				}
				.top-header, .top-header a, .sitenav ul li a{
					color:<?php echo esc_attr(get_theme_mod('headertxt-color','#ffffff')); ?>;
				}
				
		</style>
	<?php }
add_action('wp_head','buildcon_lite_css');

function buildcon_lite_customize_preview_js() {
	wp_enqueue_script( 'buildcon-lite-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'buildcon_lite_customize_preview_js' );