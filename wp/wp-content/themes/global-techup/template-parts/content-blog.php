<?php
$techup_enable_blog_section = get_theme_mod( 'techup_enable_blog_section', true );
$techup_blog_cat 		= get_theme_mod( 'techup_blog_cat', 'uncategorized' );
if($techup_enable_blog_section == true) 
{
	$techup_blog_title 	= get_theme_mod( 'techup_blog_title', esc_html__( 'Blog','global-techup'));
	$techup_blog_subtitle 	= get_theme_mod( 'techup_blog_subtitle' );
	$techup_rm_button_label 	= get_theme_mod( 'techup_rm_button_label', esc_html__( 'Read More','global-techup'));
	$techup_blog_count 	 = apply_filters( 'techup_blog_count', 3 );
?>
<!-- blog start-->
    <section class="blog-sec">
        <div class="container">
          <div class="section-heading text-center">
			<?php if($techup_blog_title) : ?>
				<h4 class="bg-color">
					<span class="sm-title theme-gradient1"><?php echo esc_html( $techup_blog_title ); ?></span>
				</h4>
			<?php endif; ?>	
			<?php if($techup_blog_subtitle) : ?>	
            <h3 class="bg-title"><?php echo esc_html( $techup_blog_subtitle ); ?></h3>
            <?php endif; ?> 
          </div>
            <div class="row">
				<?php 
				if( !empty( $techup_blog_cat ) ) 
					{
					$blog_args = array(
						'post_type' 	 => 'post',
						'category_name'	 => esc_attr( $techup_blog_cat ),
						'posts_per_page' => absint( $techup_blog_count ),
					);

					$blog_query = new WP_Query( $blog_args );
					if( $blog_query->have_posts() ) 
					{
						while( $blog_query->have_posts() ) 
						{
							$blog_query->the_post();
							?>
                  <div class="blogs-post-item col-12 col-sm-6 col-lg-4">
                    <article class="blogs-post-item-inner">
                        <div class="blog-thumbnail-wrap layout-2">
                            <?php the_post_thumbnail(); ?>
                            <h5 class="blogs_post_cat"><?php the_category();?></h5>
                        </div>
                        <div class="content">
                            <h2 class="blogs_post_title">
                                <a class="heading" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php the_excerpt(); ?>
                             <?php if ($techup_rm_button_label !=""){ ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-wraper1"><?php echo esc_html($techup_rm_button_label); ?></a>
                          <?php } ?>
                        </div>
                    </article>
                  </div>
                <?php
				}
			}
			wp_reset_postdata();
		}
		 ?>      
                     
            </div>
        </div>
    </section>
    <!-- blog end-->


<?php } ?>