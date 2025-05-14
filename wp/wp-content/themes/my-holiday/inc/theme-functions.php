<?php if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Functions and definitions
 */

/*******************************
Basic
********************************/

if ( ! function_exists( 'my_holiday_setup' ) ) :

function my_holiday_setup() {

	load_theme_textdomain( 'my-holiday', MY_HOLIDAY_THEME_URI . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );			
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'my-holiday' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'my_holiday_custom_background_args', array(
		'default-image' => MY_HOLIDAY_THEME_URI.'/framework/images/back.png',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'my_holiday_setup' );

/*******************************
$content_width
********************************/

function my_holiday_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'my_holiday_content_width', 640 );
}
add_action( 'after_setup_theme', 'my_holiday_content_width', 0 );


/*******************************
* Register widget area.
********************************/


	function my_holiday_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'my-holiday' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'my-holiday' ),
			'before_widget' => '<section id="%1$s" class="widget sidebar-animation %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
}
add_action( 'widgets_init', 'my_holiday_widgets_init' );


	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	
/*******************************
* Enqueue scripts and styles.
********************************/
 
 
function my_holiday_scripts() {
		wp_enqueue_script( 'jquery');
		wp_enqueue_style( 'my-holiday-style', get_stylesheet_uri());
		wp_enqueue_style( 'my-holiday-animate', MY_HOLIDAY_THEME_URI . '/framework/css/animate.css');
		wp_enqueue_style( 'my-holiday-fontawesome', MY_HOLIDAY_THEME_URI . '/framework/css/font-awesome.css' );	
		wp_enqueue_style( 'my-holiday-genericons', MY_HOLIDAY_THEME_URI . '/framework/genericons/genericons.css', array(), '3.4.1' );	
		wp_enqueue_style( 'my-holiday-woocommerce', MY_HOLIDAY_THEME_URI . '/woocommerce/woo-css.css' );
		wp_enqueue_style( 'my-holiday-font-Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );

		if(get_theme_mod('sidebar_position') == "2") {
		wp_enqueue_style( 'my-holiday-sidebar-menu-rigfht', MY_HOLIDAY_THEME_URI . '/framework/css/sidebar-menu-rigfht.css' );
		}
		wp_enqueue_style( 'seos_scroll_css', MY_HOLIDAY_THEME_URI . '/inc/css/scroll-effect.css');		
		wp_enqueue_style( 'seos_animate', MY_HOLIDAY_THEME_URI . '/css/animate.css');		
		
		wp_enqueue_style( 'my-holiday-camera-css', MY_HOLIDAY_THEME_URI . '/slider/camera.css' );
		wp_enqueue_script( 'my-holiday-camera-js', MY_HOLIDAY_THEME_URI . '/slider/camera.js');
		wp_enqueue_script( 'my-holiday-jquery.easing.1.3-js', MY_HOLIDAY_THEME_URI . '/slider/jquery.easing.1.3.js');
	
	    wp_enqueue_script('jquery');
		wp_enqueue_script( 'my-holiday-navigation', MY_HOLIDAY_THEME_URI . '/framework/js/navigation.js', array(), '20120206', true );
		wp_enqueue_script( 'my-holiday-skip-link-focus-fix', MY_HOLIDAY_THEME_URI . '/framework/js/skip-link-focus-fix.js', array(), '20130115', true );
		wp_enqueue_script( 'my-holiday-aniview', MY_HOLIDAY_THEME_URI . '/framework/js/jquery.aniview.js' );
		
		wp_enqueue_script( 'my-holiday-viewportchecker', MY_HOLIDAY_THEME_URI . '/js/viewportchecker.js' );

		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( 'my-holiday-keyboard-image-navigation', MY_HOLIDAY_THEME_SCRIPTS_URI . '/keyboard-image-navigation.js', array( 'jquery' ), '20151104' );
		}
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
}

add_action( 'wp_enqueue_scripts', 'my_holiday_scripts' );


function my_holiday_admin_scripts() {
	
		wp_enqueue_style( 'my-holiday-admin', MY_HOLIDAY_THEME_URI . '/inc/css/admin.css');
}		
add_action( 'admin_enqueue_scripts', 'my_holiday_admin_scripts' );

/*******************************
* Includes.
*******************************/
	require MY_HOLIDAY_THEME . '/inc/template-tags.php';
	require MY_HOLIDAY_THEME . '/inc/extras.php';
	require MY_HOLIDAY_THEME . '/inc/customizer.php';
	require MY_HOLIDAY_THEME . '/inc/jetpack.php';
	require MY_HOLIDAY_THEME . '/inc/custom-header.php';
	require MY_HOLIDAY_THEME . '/slider/camera.php';
	require MY_HOLIDAY_THEME . '/kirki/kirki.php';
	require MY_HOLIDAY_THEME . '/inc/customize-kirki.php';
	require MY_HOLIDAY_THEME . '/woocommerce/woo-functions.php';
	require MY_HOLIDAY_THEME . '/js/viewportchecker.php';	
	require MY_HOLIDAY_THEME . '/css/animation-speed.php';
	if( class_exists( 'WooCommerce' ) ) {
		require MY_HOLIDAY_THEME . '/inc/plugins/class-tgm-plugin-activation.php';
		require MY_HOLIDAY_THEME . '/inc/plugins/tgm-plugin-activation.php';	
	}
/*********************************************************************************************************
*  	Sticky Post First in Category
**********************************************************************************************************/
function my_holiday_sticky_posts()
{
    // First check if we are on a category page, if not, return false
    if ( !is_category() )
        return false;

    // Secondly, check if we have stickies, return false on failure
    $stickies = get_option( 'sticky_posts' );

    if ( !$stickies )
        return false;

    // OK, we have stickies and we are on a category page, continue to execute. Get current object (category) ID
    $current_object = get_queried_object_id();

    // Create the query to get category specific stickies, just get post ID's though
    $args = array (
        'nopaging' => true,
        'post__in' => $stickies,
        'cat' => $current_object,
        'ignore_sticky_posts' => 1,
        'fields' => 'ids'
    );
    $q = get_posts( $args );

    return $q;
}

function my_holiday_temp ($q) {
    if ( !is_admin() // IMPORTANT, make sure to target front end only
         && $q->is_main_query() // IMPORTANT, make sure we only target the main query
         && $q->is_category() // Only target category archives
    ) {
        // Check if our function to get term related stickies exists to avoid fatal errors
        if ( function_exists( 'my_holiday_sticky_posts' ) ) {
            // check if we have stickies
            $stickies = my_holiday_sticky_posts();

            if ( $stickies ) {
                // Remove stickies from the main query to avoid duplicates
                $q->set( 'post__not_in', $stickies );

                // Check that we add stickies on the first page only, remove this check if you need stickies on all paged pages
                if ( !$q->is_paged() ) {

                    // Add stickies via the the_posts filter
                    add_filter( 'the_posts', function ( $posts ) use ( $stickies )
                    {   
                        $term_stickies = get_posts( array('post__in' => $stickies, 'nopaging' => true) );

                        $posts = array_merge( $term_stickies, $posts );

                        return $posts;
                    }, 10, 1 );
                }
            }
        }
    }
}
add_action( 'pre_get_posts', 'my_holiday_temp');


