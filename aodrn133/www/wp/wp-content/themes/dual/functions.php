<?php
/**
 * Dual functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dual
 */


if ( ! function_exists( 'dual_after_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function dual_after_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'dual_content_width', 1140 );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Posts Fordual.
		 *
		 * https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support( 'post-formats', array(
		    'video',
		    'audio',
		    'gallery',
		    'quote',
		    'image'
		) );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Dual, use a find and replace
		 * to change 'dual' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dual', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );

	}

endif;

add_action( 'after_setup_theme', 'dual_after_theme_support' );

function dual_widgets_init(){
    
    register_sidebar( array(
        'name' => esc_html__('Footer Widget One', 'dual'),
        'id' => 'dual-footer-1',
        'description' => esc_html__('Add widgets here.', 'dual'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar( array(
        'name' => esc_html__('Footer Widget Two', 'dual'),
        'id' => 'dual-footer-2',
        'description' => esc_html__('Add widgets here.', 'dual'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

}

add_action('widgets_init', 'dual_widgets_init');


/**
 * Register and Enqueue Styles.
 */
function dual_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );
	$fonts_url = dual_fonts_url();
    if( $fonts_url ){
    	
    	require_once get_theme_file_path( 'assets/lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'dual-google-fonts',
			wptt_get_webfont_url( $fonts_url ),
			array(),
			$theme_version
		);
    }

    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');
    wp_enqueue_style( 'dual-style', get_stylesheet_uri(), array(), $theme_version );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'dual-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'dual-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);

	$ajax_nonce = wp_create_nonce('dual_ajax_nonce');
	
    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $twp_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $twp_paged,
        );
        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;
        wp_reset_postdata();
    }else{
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $twp_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $dual_default = dual_get_default_theme_options();
    $dual_pagination_layout = get_theme_mod( 'dual_pagination_layout',$dual_default['dual_pagination_layout'] );

    // Pagination Data
    wp_localize_script( 
	    'dual-pagination', 
	    'dual_pagination',
	    array(
	        'paged'  => absint( $twp_paged ),
	        'maxpage'   => absint( $max ),
	        'nextLink'   => next_posts( $max, false ),
	        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	        'loadmore'   => esc_html__( 'Load More Posts', 'dual' ),
	        'nomore'     => esc_html__( 'No More Posts', 'dual' ),
	        'loading'    => esc_html__( 'Loading...', 'dual' ),
	        'pagination_layout'   => esc_html( $dual_pagination_layout ),
	        'ajax_nonce' => $ajax_nonce,
	     )
	);

    global $post;
    $single_post = 0;
    $dual_ed_post_reaction = '';
    if( isset( $post->ID ) && isset( $post->post_type ) && $post->post_type == 'post' ){

    	$dual_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'dual_ed_post_reaction', true ) );
    	$single_post = 1;

    }
	wp_localize_script(
	    'dual-custom', 
	    'dual_custom',
	    array(
	    	'single_post'	=> absint( $single_post ),
	        'dual_ed_post_reaction'  		=> esc_html( $dual_ed_post_reaction ),
	        'next_svg'   => dual_the_theme_svg('chevron-right',true),
            'prev_svg' => dual_the_theme_svg('chevron-left',true),
            'play' => dual_the_theme_svg( 'play', $return = true ),
            'pause' => dual_the_theme_svg( 'pause', $return = true ),
            'mute' => dual_the_theme_svg( 'mute', $return = true ),
            'unmute' => dual_the_theme_svg( 'unmute', $return = true ),
            'play_text' => esc_html__('Play','dual'),
            'pause_text' => esc_html__('Pause','dual'),
            'mute_text' => esc_html__('Mute','dual'),
            'unmute_text' => esc_html__('Unmute','dual'),
	     )
	);

}

add_action( 'wp_enqueue_scripts', 'dual_register_styles' );

/**
 * Admin enqueue script
 */
function dual_admin_scripts($hook){

	wp_enqueue_media();
    wp_enqueue_style('dual-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
    wp_enqueue_script('dual-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery'), '', 1);
    
    $ajax_nonce = wp_create_nonce('dual_ajax_nonce');
            
    wp_localize_script( 
        'dual-admin', 
        'dual_admin',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,
            'active' => esc_html__('Active','dual'),
            'deactivate' => esc_html__('Deactivate','dual'),
            'upload_image'   =>  esc_html__('Choose Image','dual'),
            'use_image'   =>  esc_html__('Select','dual'),
         )
    );

    $current_screen = get_current_screen();
    if( $current_screen->id === "widgets" ) {

        // Enqueue Script Only On Widget Page.
        wp_enqueue_media();
    	wp_enqueue_script('dual-widget', get_template_directory_uri() . '/assets/lib/custom/js/widget.js', array('jquery'), '', 1);
	}

}

add_action('admin_enqueue_scripts', 'dual_admin_scripts');

function dual_customize_preview_js() {
	wp_enqueue_script( 'dual-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'dual_customize_preview_js' );

if( !function_exists( 'dual_js_no_js_class' ) ) :

	// js no-js class toggle
	function dual_js_no_js_class() { ?>

		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	
	<?php
	}
	
endif;

add_action( 'wp_head', 'dual_js_no_js_class' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function dual_menus() {

	$locations = array(
		'dual-primary-menu'  => __( 'Primary Menu', 'dual' ),
		'dual-footer-menu'  => __( 'Footer Menu', 'dual' ),
		'dual-social-menu'  => __( 'Social Menu', 'dual' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'dual_menus' );



require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/single-related-posts.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/banner-slider.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/woocommerce/woocommerce-function.php';
require get_template_directory() . '/inc/term-meta.php';
require get_template_directory() . '/inc/widgets/widget-base-class.php';
require get_template_directory() . '/inc/widgets/recent-post.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/tab-posts.php';
require get_template_directory() . '/inc/widgets/category.php';
require get_template_directory() . '/classes/about.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/classes/plugins-classes.php';

add_filter('themeinwp_enable_demo_import_compatiblity','dual_demo_import_filter_apply');

if( !function_exists('dual_demo_import_filter_apply') ):

	function dual_demo_import_filter_apply(){

		return true;

	}

endif;