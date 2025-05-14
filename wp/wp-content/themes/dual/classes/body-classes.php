<?php
/**
* Body Classes.
*
* @package Dual
*/
 
 if (!function_exists('dual_body_classes')) :

    function dual_body_classes($classes) {

        $dual_default = dual_get_default_theme_options();
        global $post;
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }
        
        if( is_archive() || is_home() ){

            $dual_archive_layout = get_theme_mod( 'dual_archive_layout', $dual_default['dual_archive_layout'] );
            if( $dual_archive_layout == 'metro' ){
                $classes[] = 'page-template-template-aside-metro';
            }

        }

        if( is_singular('post') ){

            $dual_ed_post_reaction = get_post_meta( $post->ID, 'dual_ed_post_reaction', true );
            if( $dual_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }
        
        $classes[] = 'site-layout-default';

        return $classes;
    }

endif;

add_filter('body_class', 'dual_body_classes');