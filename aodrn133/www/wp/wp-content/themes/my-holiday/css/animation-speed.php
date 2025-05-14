<?php if( ! defined( 'ABSPATH' ) ) exit;
function my_holiday_animation() { ?>
<style>

	.site-title {
		display: block;
		-webkit-animation-duration: <?php echo esc_html(get_theme_mod( 'site_title_animations_speed' )); ?>s !important;
		animation-duration: <?php echo esc_html(get_theme_mod( 'site_title_animations_speed' )); ?>s !important;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;
		-o-transition: all 0.1s ease-in-out;
		-ms-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
	}

	.sidebar-animation {
		display: block;
		-webkit-animation-duration: <?php echo esc_html(get_theme_mod( 'sidebar_animations_speed' )); ?>s !important;
		animation-duration: <?php echo esc_html(get_theme_mod( 'sidebar_animations_speed' )); ?>s !important;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;
		-o-transition: all 0.1s ease-in-out;
		-ms-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
	}

	article {
		display: block;
		-webkit-animation-duration: <?php echo esc_html(get_theme_mod( 'articles_animations_speed' )); ?>s !important;
		animation-duration: <?php echo esc_html(get_theme_mod( 'articles_animations_speed' )); ?>s !important;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;
		-o-transition: all 0.1s ease-in-out;
		-ms-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
	}

	.site-footer {
		display: block;
		-webkit-animation-duration: <?php echo esc_html(get_theme_mod( 'footer_animations_speed' )); ?>s !important;
		animation-duration: <?php echo esc_html(get_theme_mod( 'footer_animations_speed' )); ?>s !important;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;
		-o-transition: all 0.1s ease-in-out;
		-ms-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
	}

</style>
<?php }

add_action('wp_head', 'my_holiday_animation');