<?php
/**
 * The Header template
 */ 
 ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<?php endif; ?>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
        <?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } else { do_action( 'wp_body_open' ); } ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'my-holiday' ); ?></a>
	<div class="mh-top clear">
		<?php if (get_theme_mod('my_holiday_socia_activate')) { echo my_holiday_social_section (); } ?>
		<?php if (get_theme_mod('my_holiday_display_woo_cart') and function_exists( 'woocommerce_get_page_id' ) ) { echo my_holiday_woo_cart(); } ?>
	</div>	
	<header id="masthead" class="site-header" role="banner">

	
			<div class="nav-center">

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'my-holiday' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->

			</div>
	
<!---------------- Deactivate Header Image ---------------->	
		
		<?php if (get_theme_mod('custom_header_position') != "deactivate" and has_header_image() !="") { ?>
		
<!---------------- All Pages Header Image ---------------->		
	
		<?php if ( get_theme_mod('custom_header_position') == "all" ) : ?>
		
		<div class="header-img" style="background-image: url('<?php header_image(); ?>');">	
		
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				<div class="dotted">
			<?php } ?>
				
			<div class="site-branding">
			
				<?php if ( get_theme_mod ('my_holidayad_logo') ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></h1>
						<?php else : ?>
							<p class="site-title"><p class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></p></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
				
				
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				</div>
			<?php } ?>
			
		</div>
		
		<?php endif;  ?>

<!---------------- All Pages Without Home Page ---------------->		
	
		<?php if (( !is_front_page() or !is_home()) and get_theme_mod('custom_header_position') == "without" ) : ?>
		
		<div class="header-img" style="background-image: url('<?php header_image(); ?>');">	
		
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				<div class="dotted">
			<?php } ?>
				
			<div class="site-branding">
			
				<?php if ( get_theme_mod ('my_holidayad_logo') ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></h1>
						<?php else : ?>
							<p class="site-title"><p class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></p></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
				
				
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				</div>
			<?php } ?>
			
		</div>
		
		<?php endif;  ?>
		
<!---------------- Home Page Header Image ---------------->
		
		<?php if ( ( is_front_page() || is_home() ) and get_theme_mod('custom_header_position') == "home" ) { ?>

		<div class="header-img" style="background-image: url('<?php header_image(); ?>');">	

			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				<div class="dotted">
			<?php } ?>					

			<div class="site-branding">
			
				<?php if ( get_theme_mod ('my_holidayad_logo') ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></h1>
						<?php else : ?>
							<p class="site-title"><p class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></p></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
						
				
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				</div>
			<?php } ?>					
		</div>
		
	<?php } 

	} ?> 

<!---------------- Default Header Image ---------------->

		<?php if ( get_theme_mod('custom_header_position') != "deactivate" and has_header_image() !="") { ?>
		
		<?php if ( get_theme_mod('custom_header_position') != "all" ) { ?>

		<?php if ( ( is_front_page() or is_home() ) and get_theme_mod('custom_header_position') != "home" ) { ?>
		<?php if ( ( is_front_page() or is_home() ) and get_theme_mod('custom_header_position') != "without" ) { ?>

		<div class="header-img" style="background-image: url('<?php echo esc_url(get_template_directory_uri()). "/framework/images/header.jpg"; ?>');">	

			<div class="dotted">
			
			<div class="site-branding">
			
				<?php if ( get_theme_mod ('my_holidayad_logo') ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></h1>
						<?php else : ?>
							<p class="site-title"><p class="site-title"><img src="<?php echo esc_url(get_theme_mod ('my_holidayad_logo')); ?>" alt="logo" /></p></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$mh_description = get_bloginfo( 'description', 'display' );
						if ( $mh_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $mh_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
				
			</div>
							
		</div>
		
		<?php } } } } ?>
		
		<?php if ( (is_front_page() or is_home()) and get_theme_mod('activate_slider')) { echo my_holiday_slider (); } ?>	
	
	</header><!-- #masthead -->
		
	<div class="clear"></div>
	
		<?php if(get_theme_mod('my_holidayad_top')) { ?>
			<div class="ads-header">
				<a href="<?php echo esc_url(get_theme_mod('my_holidayad_top_url')); ?>">
					<img src="<?php echo esc_url(get_theme_mod('my_holidayad_top')); ?>" alt="banner-top">
				</a>
			</div>
		<?php } ?>	<!-- .ads header -->
			
	<div id="content" class="site-content">
