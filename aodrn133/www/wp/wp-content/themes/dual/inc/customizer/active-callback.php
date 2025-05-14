<?php
/**
 * Dual Customizer Active Callback Functions
 *
 * @package Dual
 */

function dual_custom_header_active_callback( $control ){

    $dual_header_banner_type = $control->manager->get_setting( 'dual_header_banner_type' )->value();
    if( $dual_header_banner_type == 'media' ){

        return true;
        
    }
    
    return false;

}


function dual_custom_header_category_active_callback( $control ){

    $dual_header_banner_type = $control->manager->get_setting( 'dual_header_banner_type' )->value();
    if( $dual_header_banner_type == 'slider' ){

        return true;
        
    }
    
    return false;

}

function dual_column_layout_active_callback( $control ){

    $dual_archive_layout = $control->manager->get_setting( 'dual_archive_layout' )->value();
    if( $dual_archive_layout == 'masonry' || $dual_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;

}