<?php
/**
 * Woocommerce Compatibility.
 *
 * @link https://woocommerce.com/
 *
 * @package Dual
 */

if ( class_exists('WooCommerce') ) {

    remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

}

if( !function_exists('dual_woocommerce_setup') ):

    /**
     * Woocommerce support.
     */
    function dual_woocommerce_setup(){

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

    }

endif;

add_action('after_setup_theme', 'dual_woocommerce_setup');

if( !function_exists('dual_woocommerce_before_main_content') ):

    // Before Main Content woocommerce hook
    function dual_woocommerce_before_main_content(){

        echo '<div class="singular-main-block">';
        echo '<div class="wrapper">';
        echo '<div class="column-row">';

    }

endif;

if( class_exists('WooCommerce') ){

    add_action('woocommerce_before_main_content', 'dual_woocommerce_before_main_content', 5);

}

if( !function_exists('dual_woocommerce_after_main_content') ):

    // After Main Content woocommerce hook
    function dual_woocommerce_after_main_content(){
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

endif;

if ( ! function_exists( 'dual_woocommerce_cart_link_fragment' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function dual_woocommerce_cart_link_fragment( $fragments ) {
        ob_start();
        dual_woocommerce_cart_link();
        $fragments['.cart-total-item'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dual_woocommerce_cart_link_fragment' );


if ( ! function_exists( 'dual_woocommerce_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function dual_woocommerce_cart_link() {
        ?>
        <div <?php if( WC()->cart->get_cart_contents_count() <= 0 ){ ?>style="opacity: 0" <?php } ?> class="cart-total-item">
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'dual' ); ?>">
                <?php
                $item_count_text = sprintf(
                    /* translators: number of items in the mini cart. */
                    _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'dual' ),
                    WC()->cart->get_cart_contents_count()
                );
                ?>
                <span class="amount"><?php echo ( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
            </a>
        </div>
        <?php
    }
}


/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}


if ( ! function_exists( 'dual_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function dual_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>

        <button type="button" class="navbar-control navbar-control-cart">
             <span class="navbar-control-trigger" tabindex="-1">
               <?php dual_the_theme_svg('cart-2'); ?>
             </span>
            <?php dual_woocommerce_cart_link() ?>

        </button>

        <div class="dual-minicart-content">
            <ul class="dual-minicart-products dual-unstyled-list">
                <li class="<?php echo esc_attr( $class ); ?>">
                    <?php dual_woocommerce_cart_link(); ?>
                </li>
                <li>
                    <?php
                    $instance = array(
                        'title' => '',
                    );

                    the_widget( 'WC_Widget_Cart', $instance );
                    ?>
                </li>
            </ul>
        </div>

        <?php
    }
}

if( class_exists('WooCommerce') ){

    add_action('woocommerce_after_main_content', 'dual_woocommerce_after_main_content', 15);

}

if ( ! function_exists( 'dual_woocommerce_single_add_to_cart_text' ) ) {
    // Change add to cart text on single product page
    function dual_woocommerce_single_add_to_cart_text() {
        return __( 'Buy Now', 'dual' );
    }
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'dual_woocommerce_single_add_to_cart_text' );

if ( ! function_exists( 'dual_woocommerce_archive_product_add_to_cart_text' ) ) {
    // Change add to cart text on product archives(Collection) page
    function dual_woocommerce_archive_product_add_to_cart_text() {
        return __( 'Buy Now', 'dual' );
    }
}
add_filter( 'woocommerce_product_add_to_cart_text', 'dual_woocommerce_archive_product_add_to_cart_text' );

if ( ! function_exists( 'dual_change_view_cart_link' ) ) {
    // Change view cart text on ajax added to cart
    function dual_change_view_cart_link( $params, $handle ){
        switch ($handle) {
            case 'wc-add-to-cart':
                $params['i18n_view_cart'] = __('Go to cart', 'dual');
            break;
        }
        return $params;
    }
}
add_filter( 'woocommerce_get_script_data', 'dual_change_view_cart_link', 10, 2 );