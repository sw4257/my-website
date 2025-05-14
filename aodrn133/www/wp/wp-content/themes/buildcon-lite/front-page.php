<?php
/**
 *
 * @package Buildcon Lite
 *
 */

get_header(); 


if (!is_home() && is_front_page()) {
	$hideslide = get_theme_mod('hide_slider', '1');
	 if($hideslide == ''){   
$buildcon_lite_pages = array();
for($sld=7; $sld<10; $sld++) { 
	$mod = absint( get_theme_mod('page-setting'.$sld));
    if ( 'page-none-selected' != $mod ) {
      $buildcon_lite_pages[] = $mod;
    }	
} 
if( !empty($buildcon_lite_pages) ) :
$args = array(
      'posts_per_page' => 3,
      'post_type' => 'page',
      'post__in' => $buildcon_lite_pages,
      'orderby' => 'post__in'
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :	
	$sld = 7;
?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
		<?php
        $i = 0;
        while ( $query->have_posts() ) : $query->the_post();
          $i++;
          $buildcon_lite_slideno[] = $i;
          $buildcon_lite_slidetitle[] = get_the_title();
		  $buildcon_lite_slidedesc[] = get_the_excerpt();
          $buildcon_lite_slidelink[] = esc_url(get_permalink());
          ?>
          <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" />
          <?php
        $sld++;
        endwhile;
          ?>
    </div>
        <?php
        $k = 0;
        foreach( $buildcon_lite_slideno as $buildcon_lite_sln ){ ?>
    <div id="slidecaption<?php echo esc_attr( $buildcon_lite_sln ); ?>" class="nivo-html-caption">
        <h2><a href="<?php echo esc_url($buildcon_lite_slidelink[$k] ); ?>"><?php echo esc_html($buildcon_lite_slidetitle[$k] ); ?></a></h2>
        <p><?php echo esc_html($buildcon_lite_slidedesc[$k] ); ?></p>
        <div class="clear"></div>
        <a class="slide-button" href="<?php echo esc_url($buildcon_lite_slidelink[$k] ); ?>">
          <?php echo esc_html(get_theme_mod('slide_text',__('Read More','buildcon-lite')));?>
          </a>
    </div>
 	<?php $k++;
       wp_reset_postdata();
      } ?>
<?php endif; endif; ?>
  </div>
  <div class="clear"></div>
</section>
<?php } } 
?>

<div class="main-container">

<?php
  /**********
  * Homepage Welcome boxees Section
  **********/
  $hidewelcome = get_theme_mod('hide_wel_section','1');
  if( $hidewelcome == '' ){
    echo '<section id="welcome-boxes"><div class="container">';
      $welcomettl = get_theme_mod('wel-section-ttl',true);
      if( $welcomettl != '' ){
        echo '<div class="section_head"><h2 class="section_title">'.esc_html( get_theme_mod('wel-section-ttl',true )).'</h2></div>';
      }
      echo '<div class="flex">';
      for( $wel = 1; $wel<4; $wel++ ) {
        if( get_theme_mod( 'wel-setting'.$wel,true ) !='' ){
          $wel_query = new WP_Query(array('page_id' => get_theme_mod('wel-setting'.$wel)));
          while( $wel_query->have_posts() ) : $wel_query->the_post();
            echo '<div class="col-3"><div class="welcome-box">
              <div class="welcome-box-inner">
                <div class="welcome-box-icon">
                  '.get_the_post_thumbnail().'
                </div>
                <div class="welcome-box-content">
                  <h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
                  <p>'.get_the_excerpt().'</p><a class="read-more" href="'.get_the_permalink().'">'.esc_html(get_theme_mod('wel_more_text',__('Read More','buildcon-lite'))).'</a>
                </div>
              </div>
            </div></div>';
          endwhile;
        }
      }
    echo '</div></div></section>';
  }

  /**********
  * Homepage Service boxees Section
  **********/
  $hidewelcome = get_theme_mod('hide_ser_section','1');
  if( $hidewelcome == '' ){
    echo '<section id="service-boxes"><div class="container">';
      $servicettl = get_theme_mod('ser-section-ttl',true);
      if( $servicettl != '' ){
        echo '<div class="section_head"><h2 class="section_title">'.esc_html( get_theme_mod('ser-section-ttl',true )).'</h2></div>';
      }
      echo '<div class="flex">';
      for( $ser = 1; $ser<4; $ser++ ) {
        if( get_theme_mod( 'ser-setting'.$ser,true ) !='' ){
          $ser_query = new WP_Query(array('page_id' => get_theme_mod('ser-setting'.$ser)));
          while( $ser_query->have_posts() ) : $ser_query->the_post();
            echo '<div class="col-3"><div class="service-box">
              <div class="service-box-inner">
                <div class="service-box-icon">
                  '.get_the_post_thumbnail().'
                </div>
                <div class="service-box-content">
                  <h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
                  <p>'.get_the_excerpt().'</p><a class="read-more" href="'.get_the_permalink().'">'.esc_html(get_theme_mod('wel_more_text',__('Read More','buildcon-lite'))).'</a>
                </div>
              </div>
            </div></div>';
          endwhile;
        }
      }
    echo '</div></div></section>';
  }
?>

                                     
<div class="content-area">
  <div class="middle-align content_sidebar">
      <div class="site-main" id="sitemain">
        <?php
          if ( have_posts() ) :
            // Start the Loop.
            while ( have_posts() ) : the_post();
              /*
              * Include the post format-specific template for the content. If you want to
              * use this in a child theme, then include a file called called content-___.php
              * (where ___ is the post format) and that will be used instead.
              */
              get_template_part( 'content-page', get_post_format() );

            endwhile;
              // Previous/next post navigation.
              the_posts_pagination();
              wp_reset_postdata();

            else :
              // If no content, include the "No posts found" template.
              get_template_part( 'no-results' );

          endif;
        ?>
      </div>
      <?php get_sidebar();?>
      <div class="clear"></div>
  </div>
</div>
<?php get_footer(); ?>