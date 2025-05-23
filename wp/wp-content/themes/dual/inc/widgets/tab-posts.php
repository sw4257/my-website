<?php
/**
 * Tab Posts Widgets.
 *
 * @package Dual
 */

if ( !function_exists('dual_tab_posts_widgets') ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function dual_tab_posts_widgets(){
        // Tab Post widget.
        register_widget('Dual_Tab_Posts_Widget');

    }
endif;
add_action('widgets_init', 'dual_tab_posts_widgets');

/* Tabed widget */
if ( !class_exists('Dual_Tab_Posts_Widget') ):

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Dual_Tab_Posts_Widget extends Dual_Widget_Base {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct() {

            $opts = array(
                'classname'   => 'dual_widget_tabbed',
                'description' => esc_html__('Tabbed widget.', 'dual'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label'          => esc_html__('Popular', 'dual'),
                    'type'           => 'heading',
                ),
                'popular_post_title' => array(
                    'label'         => esc_html__('Popular Posts Title', 'dual'),
                    'type'          => 'text',
                    'default'          => esc_html__('Popular', 'dual'),
                ),
                'popular_number' => array(
                    'label'         => esc_html__('No. of Posts:', 'dual'),
                    'type'          => 'number',
                    'css'           => 'max-width:60px;',
                    'default'       => 5,
                    'min'           => 1,
                    'max'           => 10,
                ),
                'select_image_size' => array(
                    'label' => esc_html__('Select Image Size Featured Post:', 'dual'),
                    'type' => 'select',
                    'default' => 'medium',
                    'options' => array(
                        'thumbnail' => esc_html__('Thumbnail', 'dual'),
                        'medium' => esc_html__( 'Medium', 'dual' ),
                        'large' => esc_html__( 'Large', 'dual' ),
                        'full' => esc_html__( 'Full', 'dual' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label'         => esc_html__('Excerpt Length:', 'dual'),
                    'description'   => esc_html__('Number of words', 'dual'),
                    'default'       => 10,
                    'css'           => 'max-width:60px;',
                    'min'           => 0,
                    'max'           => 200,
                ),
                'recent_heading' => array(
                    'label'         => esc_html__('Recent', 'dual'),
                    'type'          => 'heading',
                ),
                'recent_post_title' => array(
                    'label'         => esc_html__('Recent Posts Title', 'dual'),
                    'type'          => 'text',
                    'default'          => esc_html__('Recent', 'dual'),
                ),
                'recent_number' => array(
                    'label'        => esc_html__('No. of Posts:', 'dual'),
                    'type'         => 'number',
                    'css'          => 'max-width:60px;',
                    'default'      => 5,
                    'min'          => 1,
                    'max'          => 10,
                ),
                'comments_heading' => array(
                    'label'           => esc_html__('Comments', 'dual'),
                    'type'            => 'heading',
                ),
                'comments_post_title' => array(
                    'label'         => esc_html__('Comments Posts Title', 'dual'),
                    'type'          => 'text',
                    'default'          => esc_html__('Comments', 'dual'),
                ),
                'comments_number' => array(
                    'label'          => esc_html__('No. of Comments:', 'dual'),
                    'type'           => 'number',
                    'css'            => 'max-width:60px;',
                    'default'        => 5,
                    'min'            => 1,
                    'max'            => 10,
                ),
            );

            parent::__construct( 'dual-tabbed', esc_html__( 'Dual: Tab Posts Widget', 'dual' ), $opts, array(), $fields );

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance ) {

            $params = $this->get_params( $instance );
            $tab_id = 'tabbed-'.$this->number;

            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="tab-head">
                     <ul class="twp-nav-tabs clear">
                        <li tab-data="tab-popular" class="tab tab-popular active">
                            <a href="javascript:void(0)">
                                <span class="fire-icon tab-icon">
                                    <?php dual_the_theme_svg('popular'); ?>
                                </span>
                                <?php echo esc_html( $params['popular_post_title'] );?>
                            </a>
                        </li>
                        <li tab-data="tab-recent" class="tab tab-recent">
                            <a href="javascript:void(0)">
                                <span class="flash-icon tab-icon">
                                    <?php dual_the_theme_svg('flash'); ?>
                                </span>
                                <?php echo esc_html( $params['recent_post_title'] );?>
                            </a>
                        </li>
                        <li tab-data="tab-comments" class="tab tab-comments">
                            <a href="javascript:void(0)">
                                <span class="comment-icon tab-icon">
                                    <?php dual_the_theme_svg('comment'); ?>
                                </span>
                                <?php echo esc_html( $params['comments_post_title'] );?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane content-tab-popular active">
                        <?php $this->render_news( 'popular', $params );?>
                    </div>
                    <div class="tab-pane content-tab-recent">
                        <?php $this->render_news('recent', $params );?>
                    </div>
                    <div class="tab-pane content-tab-comments">
                        <?php $this->render_comments( $params );?>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params) {

            if ( !in_array( $type, array('popular', 'recent') ) ) {
                return;
            }

            switch ($type) {
                case 'popular':

                    $cat_slug = '';
                    if( isset( $params['tab_cat'] ) ){
                        $cat_slug = $params['tab_cat'];
                    }

                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows'  => true,
                        'orderby'        => 'comment_count',
                        'category_name'  => $cat_slug,
                    );

                    break;

                case 'recent':

                    $cat_slug = '';
                    if( isset( $params['tab_cat'] ) ){
                        $cat_slug = $params['tab_cat'];
                    }

                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows'  => true,
                        'category_name'  => $cat_slug,
                    );

                    break;

                default:
                    break;
            }

            $tab_posts_query = new WP_Query( $qargs );

            if ( $tab_posts_query->have_posts() ): ?>
                
                <div class="theme-widget-list recent-widget-list">
                    <?php
                    $i = 1;
                    while ( $tab_posts_query->have_posts() ):

                        $tab_posts_query->the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class('theme-widget-article'); ?>>

                                <div class="theme-row">
                                    <div class="column column-4">
                                        <div class="entry-thumbnail">
                                            <?php if (has_post_thumbnail()) {
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                                                $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                                <a href="<?php the_permalink(); ?>" class="data-bg data-bg-thumbnail" data-background="<?php echo esc_url($featured_image); ?>"></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="column column-8">
                                        <div class="entry-details">
                                            <div class="entry-meta">
                                                <span class="posted-on"><?php dual_posted_on(); ?></span>
                                            </div>
                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                            </article>

                        <?php
                        $i++;
                        if( $i == 5 ){
                            $i = 1;
                        }
                    endwhile;?>
                </div><!-- .news-list -->

                <?php wp_reset_postdata();?>

            <?php endif; 

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params) {

            $cat_slug = '';
            $post_array = array();
            if( !empty( $params['tab_cat'] ) ){

                $cat_slug = $params['tab_cat'];

                $qargs = array(
                    'no_found_rows'  => true,
                    'category_name'  => $cat_slug,
                );

                $tab_posts_query = new WP_Query( $qargs );

                if ( $tab_posts_query->have_posts() ){

                    while ( $tab_posts_query->have_posts() ){
                       $tab_posts_query->the_post();
                        $post_array[] = get_the_ID();
                    }
                }
            }

            $comment_args = array(
                'number'      => $params['comments_number'],
                'status'      => 'approve',
                'post_status' => 'publish',
                'post__in'  => $post_array,
            );

            $comments = get_comments( $comment_args );
            ?>
            <?php if ( !empty( $comments ) ):?>
                <div class="theme-widget-list comments-tabbed-list">
                    <?php foreach ($comments as $key => $comment): ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-widget-article'); ?>>

                            <div class="theme-row">
                                <div class="column column-4">
                                    <div class="entry-thumbnail">
                                        <?php $comment_author_url = esc_url(get_comment_author_url($comment)); ?>
                                        <?php if (!empty($comment_author_url)):

                                            $thumb = get_avatar_url($comment, array('size' => 100)); ?>

                                            <a href="<?php echo esc_url($comment_author_url); ?>" class="data-bg data-bg-thumbnail" data-background="<?php echo esc_url($thumb); ?>"></a>

                                        <?php else : ?>
                                            <?php echo wp_kses_post(get_avatar($comment, 130)); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="column column-8">
                                    <div class="entry-details">
                                        <div class="comments-content">
                                            <?php echo wp_kses_post(get_comment_author_link($comment)); ?>
                                        </div>
                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php echo esc_url(get_comment_link($comment)); ?>">
                                                <?php echo esc_html(get_the_title($comment->comment_post_ID)); ?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                        </article>

                    <?php endforeach; ?>
                </div>
            <?php endif;?>
            <?php
        }

    }
endif;
