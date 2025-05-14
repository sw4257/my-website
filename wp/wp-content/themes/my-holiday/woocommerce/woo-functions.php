<?php if( ! defined( 'ABSPATH' ) ) exit;


/*******************************
* WooCommerce Pagination
********************************/

remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);

function woocommerce_pagination() { ?>

			<div class="nextpage">
			
				<div class="pagination">
				
					<?php echo paginate_links(); ?>
					
				</div> 
				
			</div>   

  <?php  }

add_action( 'woocommerce_pagination', 'seos_pagination', 10);	