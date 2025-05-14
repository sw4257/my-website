<?php
/**
* Sidebar Metabox.
*
* @package Dual
*/
 
add_action( 'add_meta_boxes', 'dual_metabox' );

if( ! function_exists( 'dual_metabox' ) ):


    function  dual_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'dual' ),
            'dual_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'dual' ),
            'dual_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;
/**
 * Callback function for post option.
*/
if( ! function_exists( 'dual_post_metafield_callback' ) ):
    
    function dual_post_metafield_callback() {
        global $post;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'dual_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-appearance" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'dual'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'dual'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="theme-tab-content">

                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <?php if( $post_type == 'post' ): ?>

                         <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','dual'); ?></h3>

                            <?php $theme_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'theme_disable_ajax_load_next_post', true) ); ?>
                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <label><b><?php esc_html_e( 'Navigation Type','dual' ); ?></b></label>

                                <select name="theme_disable_ajax_load_next_post">

                                    <option <?php if( $theme_disable_ajax_load_next_post == '' || $theme_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','dual'); ?></option>
                                    <option <?php if( $theme_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','dual'); ?></option>
                                    <option <?php if( $theme_disable_ajax_load_next_post == 'normal-navigation' ){ echo 'selected'; } ?> value="normal-navigation"><?php esc_html_e('Next Previous Navigation','dual'); ?></option>
                                    <option <?php if( $theme_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','dual'); ?></option>

                                </select>

                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Video Aspect Ration Setting','dual'); ?></h3>

                        <?php $twp_aspect_ratio = esc_attr( get_post_meta($post->ID, 'twp_aspect_ratio', true) ); ?>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Video Aspect Ratio','dual' ); ?></b></label>

                            <select name="twp_aspect_ratio">

                                <option <?php if( $twp_aspect_ratio == '' || $twp_aspect_ratio == 'global' ){ echo 'selected'; } ?> value="global"><?php esc_html_e('Global','dual'); ?></option>

                                <option <?php if( $twp_aspect_ratio == '' || $twp_aspect_ratio == 'default' ){ echo 'selected'; } ?> value="default"><?php esc_html_e('Default','dual'); ?></option>

                                <option <?php if( $twp_aspect_ratio == 'square' ){ echo 'selected'; } ?> value="square"><?php esc_html_e('Square','dual'); ?></option>

                                <option <?php if( $twp_aspect_ratio == 'portrait' ){ echo 'selected'; } ?> value="portrait"><?php esc_html_e('Portrait','dual'); ?></option>

                                <option <?php if( $twp_aspect_ratio == 'landscape' ){ echo 'selected'; } ?> value="landscape"><?php esc_html_e('Landscape','dual'); ?></option>

                            </select>

                        </div>

                    </div>

                </div>

                
                
                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $dual_ed_post_views = get_post_meta( $post->ID, 'dual_ed_post_views', true );
                    $dual_ed_post_read_time = get_post_meta( $post->ID, 'dual_ed_post_read_time', true );
                    $dual_ed_post_like_dislike = get_post_meta( $post->ID, 'dual_ed_post_like_dislike', true );
                    $dual_ed_post_author_box = get_post_meta( $post->ID, 'dual_ed_post_author_box', true );
                    $dual_ed_post_social_share = get_post_meta( $post->ID, 'dual_ed_post_social_share', true );
                    $dual_ed_post_reaction = get_post_meta( $post->ID, 'dual_ed_post_reaction', true );
                    $dual_ed_post_rating = get_post_meta( $post->ID, 'dual_ed_post_rating', true );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','dual'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="dual-ed-post-views" name="dual_ed_post_views" value="1" <?php if( $dual_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="dual-ed-post-views"><?php esc_html_e( 'Disable Post Views','dual' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="dual-ed-post-read-time" name="dual_ed_post_read_time" value="1" <?php if( $dual_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="dual-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','dual' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="dual-ed-post-like-dislike" name="dual_ed_post_like_dislike" value="1" <?php if( $dual_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="dual-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','dual' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="dual-ed-post-author-box" name="dual_ed_post_author_box" value="1" <?php if( $dual_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="dual-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','dual' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="dual-ed-post-social-share" name="dual_ed_post_social_share" value="1" <?php if( $dual_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="dual-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','dual' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="dual-ed-post-reaction" name="dual_ed_post_reaction" value="1" <?php if( $dual_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="dual-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','dual' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="dual-ed-post-rating" name="dual_ed_post_rating" value="1" <?php if( $dual_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="dual-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','dual' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'dual_save_post_meta' );

if( ! function_exists( 'dual_save_post_meta' ) ):

    function dual_save_post_meta( $post_id ) {

        global $post;

        if ( !isset( $_POST[ 'dual_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dual_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }

        $theme_disable_ajax_load_next_post_old = sanitize_text_field( get_post_meta( $post_id, 'theme_disable_ajax_load_next_post', true ) );
        $theme_disable_ajax_load_next_post_new = dual_sanitize_meta_pagination( wp_unslash( $_POST['theme_disable_ajax_load_next_post'] ) );
        if( $theme_disable_ajax_load_next_post_new && $theme_disable_ajax_load_next_post_new != $theme_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'theme_disable_ajax_load_next_post', $theme_disable_ajax_load_next_post_new );

        }elseif( '' == $theme_disable_ajax_load_next_post_new && $theme_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'theme_disable_ajax_load_next_post', $theme_disable_ajax_load_next_post_old );

        }

        $dual_ed_post_views_old = absint( get_post_meta( $post_id, 'dual_ed_post_views', true ) ); 
        $dual_ed_post_views_new = absint( wp_unslash( $_POST['dual_ed_post_views'] ) );

        if ( $dual_ed_post_views_new && $dual_ed_post_views_new != $dual_ed_post_views_old ){

            update_post_meta ( $post_id, 'dual_ed_post_views', $dual_ed_post_views_new );

        }elseif( '' == $dual_ed_post_views_new && $dual_ed_post_views_old ) {

            delete_post_meta( $post_id,'dual_ed_post_views', $dual_ed_post_views_old );

        }

        $dual_ed_post_read_time_old = absint( get_post_meta( $post_id, 'dual_ed_post_read_time', true ) ); 
        $dual_ed_post_read_time_new = absint( wp_unslash( $_POST['dual_ed_post_read_time'] ) );

        if ( $dual_ed_post_read_time_new && $dual_ed_post_read_time_new != $dual_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'dual_ed_post_read_time', $dual_ed_post_read_time_new );

        }elseif( '' == $dual_ed_post_read_time_new && $dual_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'dual_ed_post_read_time', $dual_ed_post_read_time_old );

        }

        $dual_ed_post_like_dislike_old = absint( get_post_meta( $post_id, 'dual_ed_post_like_dislike', true ) ); 
        $dual_ed_post_like_dislike_new = absint( wp_unslash( $_POST['dual_ed_post_like_dislike'] ) );

        if ( $dual_ed_post_like_dislike_new && $dual_ed_post_like_dislike_new != $dual_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'dual_ed_post_like_dislike', $dual_ed_post_like_dislike_new );

        }elseif( '' == $dual_ed_post_like_dislike_new && $dual_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'dual_ed_post_like_dislike', $dual_ed_post_like_dislike_old );

        }

        $dual_dual_post_author_box_old = absint( get_post_meta( $post_id, 'dual_dual_post_author_box', true ) );
        $dual_dual_post_author_box_new = absint( wp_unslash( $_POST['dual_dual_post_author_box'] ) );

        if ( $dual_dual_post_author_box_new && $dual_dual_post_author_box_new != $dual_dual_post_author_box_old ){

            update_post_meta ( $post_id, 'dual_dual_post_author_box', $dual_dual_post_author_box_new );

        }elseif( '' == $dual_dual_post_author_box_new && $dual_dual_post_author_box_old ) {

            delete_post_meta( $post_id,'dual_dual_post_author_box', $dual_dual_post_author_box_old );

        }

        $dual_ed_post_social_share_old = absint( get_post_meta( $post_id, 'dual_ed_post_social_share', true ) ); 
        $dual_ed_post_social_share_new = absint( wp_unslash( $_POST['dual_ed_post_social_share'] ) );

        if ( $dual_ed_post_social_share_new && $dual_ed_post_social_share_new != $dual_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'dual_ed_post_social_share', $dual_ed_post_social_share_new );

        }elseif( '' == $dual_ed_post_social_share_new && $dual_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'dual_ed_post_social_share', $dual_ed_post_social_share_old );

        }

        $dual_ed_post_reaction_old = absint( get_post_meta( $post_id, 'dual_ed_post_reaction', true ) ); 
        $dual_ed_post_reaction_new = absint( wp_unslash( $_POST['dual_ed_post_reaction'] ) );

        if ( $dual_ed_post_reaction_new && $dual_ed_post_reaction_new != $dual_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'dual_ed_post_reaction', $dual_ed_post_reaction_new );

        }elseif( '' == $dual_ed_post_reaction_new && $dual_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'dual_ed_post_reaction', $dual_ed_post_reaction_old );

        }

        $dual_ed_post_author_box_old = absint( get_post_meta( $post_id, 'dual_ed_post_author_box', true ) ); 
        $dual_ed_post_author_box_new = absint( wp_unslash( $_POST['dual_ed_post_author_box'] ) );

        if ( $dual_ed_post_author_box_new && $dual_ed_post_author_box_new != $dual_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'dual_ed_post_author_box', $dual_ed_post_author_box_new );

        }elseif( '' == $dual_ed_post_author_box_new && $dual_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'dual_ed_post_author_box', $dual_ed_post_author_box_old );

        }

        $dual_ed_post_rating_old = absint( get_post_meta( $post_id, 'dual_ed_post_rating', true ) ); 
        $dual_ed_post_rating_new = absint( wp_unslash( $_POST['dual_ed_post_rating'] ) );

        if ( $dual_ed_post_rating_new && $dual_ed_post_rating_new != $dual_ed_post_rating_old ){

            update_post_meta ( $post_id, 'dual_ed_post_rating', $dual_ed_post_rating_new );

        }elseif( '' == $dual_ed_post_rating_new && $dual_ed_post_rating_old ) {

            delete_post_meta( $post_id,'dual_ed_post_rating', $dual_ed_post_rating_old );

        }

        $twp_aspect_ratio_old = esc_attr( get_post_meta( $post_id, 'twp_aspect_ratio', true ) );

        $twp_aspect_ratio_new = '';
        if( isset( $_POST['twp_aspect_ratio'] ) ){

            $twp_aspect_ratio_new = isset( $_POST['twp_aspect_ratio'] ) ? sanitize_text_field( wp_unslash( $_POST['twp_aspect_ratio'] ) ) : '';

        }

        if( $twp_aspect_ratio_new && $twp_aspect_ratio_new != $twp_aspect_ratio_old ){

            update_post_meta ( $post_id, 'twp_aspect_ratio', $twp_aspect_ratio_new );

        }elseif( '' == $twp_aspect_ratio_new && $twp_aspect_ratio_old ) {

            delete_post_meta( $post_id,'twp_aspect_ratio', $twp_aspect_ratio_old );

        }
        
    }

endif;   