<?php 
$techup_enable_testimonial_section = get_theme_mod( 'techup_enable_testimonial_section', false );
$techup_testimonial_title= get_theme_mod( 'techup_testimonial_title','');
$techup_testimonial_subtitle= get_theme_mod( 'techup_testimonial_subtitle');

if($techup_enable_testimonial_section == true ) {
	$techup_testimonials_no        = 6;
	$techup_testimonials_pages      = array();
	for( $i = 1; $i <= $techup_testimonials_no; $i++ ) {
		 $techup_testimonials_pages[] = get_theme_mod('techup_testimonial_page'.$i);
	}
	$techup_testimonials_args  = array(
	'post_type' => 'page',
	'post__in' => array_map( 'absint', $techup_testimonials_pages ),
	'posts_per_page' => absint($techup_testimonials_no),
	'orderby' => 'post__in'
	); 
	$techup_testimonials_query = new WP_Query( $techup_testimonials_args );
?>
 <!-- ======= Testimonials Section ======= -->
   <section id="testimonials" class="testimonials-5">
      <div class="container">
        <div class="section-heading text-center">
			<?php if($techup_testimonial_title) : ?>
        <h4 class="bg-color">
				  <span class="sm-title theme-gradient1"><?php echo esc_html($techup_testimonial_title); ?></span>
        </h4>
			<?php endif; ?>	
			<?php if($techup_testimonial_subtitle) : ?>
				<h3 class="bg-title"><?php echo esc_html($techup_testimonial_subtitle); ?></h3>
			<?php endif; ?>	
        </div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="testimonials-content owl-carousel text-center col-12">
            <?php
          $count = 0;
          while($techup_testimonials_query->have_posts() && $count <= 5 ) :
          $techup_testimonials_query->the_post();
        ?>
            <div class="testimonial">
                <div class="client-desc">
                  <?php the_post_thumbnail(); ?> 
                  <?php the_excerpt(); ?>
                </div>
                <div class="testimonial-profile">
                    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
            </div>
            <?php
        $count = $count + 1;
        endwhile;
        wp_reset_postdata();
          ?>
           </div>
          </div>
        </div>
      </div>
    </section>    

	
<?php } ?>