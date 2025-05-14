<?php function my_holiday_slider () { ?>
		<script>
		jQuery(function(){
			jQuery('#camera_random').camera({ //here I declared some settings, the height and the presence of the thumbnails 
				height: <?php if (get_theme_mod('slider_options_3')) : echo "'".esc_html(get_theme_mod('slider_options_3')).'%'."'"; else : echo "'50%'"; endif; ?>,
				pagination: <?php if (get_theme_mod('pagination_slider')) : echo "true"; else : echo "false"; endif; ?>,
				time: <?php if (get_theme_mod('my_holiday_sidebar_time')) : echo esc_html(get_theme_mod('my_holiday_sidebar_time')); else : echo "2000"; endif; ?>,
				transPeriod: <?php if (get_theme_mod('my_holiday_sidebar_trans')) : echo esc_html(get_theme_mod('my_holiday_sidebar_trans')); else : echo "1000"; endif; ?>,
				loaderBgColor: <?php if (get_theme_mod('slider_loader_color')) : echo "'".esc_html(get_theme_mod('slider_loader_color'))."'"; else : echo "'#333333'"; endif; ?>,
				loaderOpacity: <?php if (get_theme_mod('slider_loader_opacity')) : echo esc_html(get_theme_mod('slider_loader_opacity')); else : echo "0.8"; endif; ?>,
				piePosition: <?php if (get_theme_mod('loader_position')) : echo "'".esc_html(get_theme_mod('loader_position'))."'"; else : echo "'rightTop'"; endif; ?>,
				playPause: false,
				thumbnails: true
			});
		});
	</script>

		<div class="sl_container">
		
			<div class="camera_wrap camera_white_skin  " id="camera_random">
			
			<?php for($i=1;$i<=20;$i++) { ?>
						<?php if(get_theme_mod('slider_image_'.$i)) { ?>
							<div data-thumb="<?php echo esc_url(get_theme_mod('slider_image_'.$i)); ?>" data-src="<?php echo esc_url(get_theme_mod('slider_image_'.$i)); ?>">
							<?php if (get_theme_mod('slider_text_'.$i)) { ?>
								<div class="camera_caption fadeFromBottom">
									<?php if(get_theme_mod('slider_link_'.$i)) { ?> <a target=" blank" href="<?php echo esc_url(get_theme_mod('slider_link_'.$i)); ?>"><?php } ?>
										<?php echo esc_html(get_theme_mod('slider_text_'.$i)); ?>
									<?php if(get_theme_mod('slider_link_'.$i)) { ?> </a><?php } ?>
								</div>
							<?php } ?>
							</div>',
			<?php } } ?>
							
			</div><!-- #camera_random -->

		</div>
		
		<div style="clear:both; display:block; height: 0;"></div>

<?php } 	


?>