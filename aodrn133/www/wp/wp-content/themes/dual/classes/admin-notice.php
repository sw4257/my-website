<?php
if ( !class_exists('Dual_Dashboard_Notice') ):

    class Dual_Dashboard_Notice
    {
        function __construct()
        {	
            global $pagenow;

        	if( $this->dual_show_hide_notice() ){

	            add_action( 'admin_notices',array( $this,'dual_admin_notiece' ) );
                
	        }
	        add_action( 'wp_ajax_dual_notice_dismiss', array( $this, 'dual_notice_dismiss' ) );
			add_action( 'switch_theme', array( $this, 'dual_notice_clear_cache' ) );
        }
        
        public static function dual_show_hide_notice( $status = false ){

            if( $status ){

                if( (class_exists( 'Booster_Extension_Class' ) ) || get_option('twp_dual_admin_notice') ){

                    return false;

                }else{

                    return true;

                }

            }

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'dual-about'  ) {
                return false;
            }

        	// Hide if dismiss notice
        	if( get_option('twp_dual_admin_notice') ){
				return false;
			}
        	// Hide if all plugin active
        	if ( class_exists( 'Booster_Extension_Class' ) ) {
				return false;
			}
			// Hide On TGMPA pages
			if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
				return false;
			}
			// Hide if user can't access
        	if ( current_user_can( 'manage_options' ) ) {
				return true;
			}
			
        }

        // Define Global Value
        public static function dual_admin_notiece(){ ?>

            <div class="updated notice is-dismissible twp-dual-notice">

                <h3><?php esc_html_e('Quick Setup','dual'); ?></h3>

                <p><strong><?php esc_html_e('Dual is now installed and ready to use. Are you looking for a better experience to set up your site?','dual'); ?></strong></p>

                <small><?php esc_html_e("We've prepared a unique onboarding process through our",'dual'); ?> <a href="<?php echo esc_url( admin_url().'themes.php?page='.get_template().'-about') ?>"><?php esc_html_e('Getting started','dual'); ?></a> <?php esc_html_e("page. It helps you get started and configure your upcoming website with ease. Let's make it shine!",'dual'); ?></small>

                <p>
                    <a class="button button-primary twp-install-active" href="javascript:void(0)"><?php esc_html_e('Install and activate recommended plugins','dual'); ?></a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://live-demo.themeinwp.com/dual/' ); ?>"><?php esc_html_e('View Demo','dual'); ?></a>
                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/dual-pro/' ); ?>"><?php esc_html_e('Upgrade to Pro','dual'); ?></a>
                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','dual'); ?></a>

                </p>

            </div>

        <?php
        }

        public function dual_notice_dismiss(){

        	if ( isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'dual_ajax_nonce' ) ) {

	        	update_option('twp_dual_admin_notice','hide');

	        }

            die();

        }

        public function dual_notice_clear_cache(){

        	update_option('twp_dual_admin_notice','');

        }

    }

    new Dual_Dashboard_Notice();
    
endif;
