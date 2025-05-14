<?php
/**
 * The template for displaying the footer
 */

?>

	</div><!-- #content -->
	<?php if(get_theme_mod('back_to_top_activate')) { ?>
		<a href="#top" id="smoothup" title="Back to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
	<?php } ?>
	
	<footer id="colophon"  class="site-footer" role="contentinfo">
		
		<div class="site-info">
		
			<?php if (get_theme_mod('footer_copyright')) { echo esc_html(get_theme_mod('footer_copyright')); } else { ?>

					<?php esc_html_e('All rights reserved', 'my-holiday'); ?>  &copy; <?php bloginfo('name'); ?>
								
					<a title="Seos Themes" href="<?php echo esc_url(__('https://seosthemes.com/', 'my-holiday')); ?>" target="_blank"><?php esc_html_e('Theme by Seos Themes', 'my-holiday'); ?></a>
			
			<?php } ?>
		
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
	
		<?php if(get_theme_mod('my_holidayad_bottom')) { ?>
			<div class="ads-footer">
				<a href="<?php echo esc_url(get_theme_mod('my_holidayad_bottom_url')); ?>">
					<img src="<?php echo esc_url(get_theme_mod('my_holidayad_bottom')); ?>" alt="banner-top">
				</a>
			</div>
		<?php } ?>	<!-- .ads header -->	
		
</div><!-- #page -->
<?php if (get_theme_mod( 'my_holidayphone_number' )) { ?>
			<div class="mcn-footer">
				<a href="tel:[<?php echo esc_url(get_theme_mod('my_holidayphone_number')); ?>]">
					<img alt="phone" src="<?php echo esc_url(get_template_directory_uri()) . '/images/phone9.png'; ?>">
				</a>
			</div>
<?php } ?>	
<?php wp_footer(); ?>

</body>
</html>
