<?php
/**
* Custom Functions.
*
* @package Dual
*/

if( !function_exists( 'dual_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function dual_sanitize_single_pagination_layout( $dual_input ){

        $dual_single_pagination = array( 'no-navigation','normal-navigation','ajax-next-post-load' );
        if( in_array( $dual_input,$dual_single_pagination ) ){

            return $dual_input;

        }

        return;

    }

endif;

if( !function_exists( 'dual_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function dual_sanitize_archive_layout( $dual_input ){

        $dual_archive_option = array( 'default','lateral','metro','masonry' );
        if( in_array( $dual_input,$dual_archive_option ) ){

            return $dual_input;

        }

        return;

    }

endif;

if( !function_exists( 'dual_sanitize_header_layout' ) ) :

    // Sidebar Option Sanitize.
    function dual_sanitize_header_layout( $dual_input ){

        $dual_header_options = array( 'layout-default','layout-1','layout-2','layout-3' );
        if( in_array( $dual_input,$dual_header_options ) ){

            return $dual_input;

        }

        return;

    }

endif;

if( !function_exists( 'dual_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function dual_sanitize_single_post_layout( $dual_input ){

        $dual_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $dual_input,$dual_single_layout ) ){

            return $dual_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'dual_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function dual_sanitize_checkbox( $dual_checked ) {

		return ( ( isset( $dual_checked ) && true === $dual_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'dual_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function dual_sanitize_select( $dual_input, $dual_setting ) {

        // Ensure input is a slug.
        $dual_input = sanitize_text_field( $dual_input );

        // Get list of choices from the control associated with the setting.
        $choices = $dual_setting->manager->get_control( $dual_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $dual_input, $choices ) ? $dual_input : $dual_setting->default );

    }

endif;


if ( ! function_exists( 'dual_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function dual_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;