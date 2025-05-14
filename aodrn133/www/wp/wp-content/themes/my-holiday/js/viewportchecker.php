<?php if( ! defined( 'ABSPATH' ) ) exit;

function my_holiday_animation_classes () { ?>
	<script type="text/javascript">


	<?php if ( get_theme_mod('site_title_animations')) { ?>
		jQuery(document).ready(function() {
				jQuery('.site-title').addClass("hidden").viewportChecker({
					classToAdd: 'animated <?php echo esc_html(get_theme_mod('site_title_animations')); ?>', // Class to add to the elements when they are visible
					offset: 1    
				   }); 
		});  
	<?php } ?>
	
	<?php if ( get_theme_mod('sidebar_animations')) { ?>
		jQuery(document).ready(function() {
				jQuery('.sidebar-animation').addClass("hidden").viewportChecker({
					classToAdd: 'animated <?php echo esc_html(get_theme_mod('sidebar_animations')); ?>', // Class to add to the elements when they are visible
					offset: 1    
				   }); 
		});  
	<?php } ?>
		
	<?php if ( get_theme_mod('articles_animations')) { ?>
		jQuery(document).ready(function() {
				jQuery('article').addClass("hidden").viewportChecker({
					classToAdd: 'animated <?php echo esc_html(get_theme_mod('articles_animations')); ?>', // Class to add to the elements when they are visible
					offset: 1    
				   }); 
		});  
	<?php } ?>
			
	<?php if ( get_theme_mod('footer_animations')) { ?>
		jQuery(document).ready(function() {
				jQuery('.site-footer').addClass("hidden").viewportChecker({
					classToAdd: 'animated <?php echo esc_html(get_theme_mod('footer_animations')); ?>', // Class to add to the elements when they are visible
					offset: 1    
				   }); 
		});  
	<?php } ?>
				
		
	</script>
<?php } 

add_action('wp_footer', 'my_holiday_animation_classes');				   
				   
		
		