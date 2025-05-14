<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dual
 * @since 1.0.0
 */
if (is_page()) {
    $dual_ed_post_views = get_post_meta(get_the_ID(), 'dual_ed_post_views', true);
    $dual_ed_post_read_time = get_post_meta(get_the_ID(), 'dual_ed_post_read_time', true);
    $dual_ed_post_like_dislike = get_post_meta(get_the_ID(), 'dual_ed_post_like_dislike', true);
    $dual_ed_post_author_box = get_post_meta(get_the_ID(), 'dual_ed_post_author_box', true);
    $dual_ed_post_social_share = get_post_meta(get_the_ID(), 'dual_ed_post_social_share', true);
    $dual_ed_post_reaction = get_post_meta(get_the_ID(), 'dual_ed_post_reaction', true);


    dual_disable_post_views();
    dual_disable_post_like_dislike();

    if ($dual_ed_post_read_time) {

        dual_disable_post_read_time();
    }

    if ($dual_ed_post_author_box) {
        dual_disable_post_author_box();
    }

    if ($dual_ed_post_reaction) {
        dual_disable_post_reaction();
    }
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>

    <header class="entry-header">

        <h1 class="entry-title entry-title-large">

            <?php the_title(); ?>

        </h1>
    </header>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="post-content-wrap">

        <?php if (is_singular() && empty($dual_ed_post_social_share) && class_exists('Booster_Extension_Class') && 'post' === get_post_type()) { ?>

            <div class="post-content-share">
                <?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
            </div>

        <?php } ?>

        <div class="post-content">

            <div class="entry-content">

                <?php
                the_content(sprintf(
                /* translators: %s: Name of current post. */
                    wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'dual'), array('span' => array('class' => array()))),
                    the_title('<span class="screen-reader-text">"', '"</span>', false)
                ));

                if( !class_exists('Booster_Extension_Class') || is_page() ):

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'dual'),
                        'after' => '</div>',
                    ));

                endif; ?>

            </div>

            <?php
            if (is_singular() && 'post' === get_post_type()) { ?>

                <div class="entry-footer">

                    <div class="entry-meta">
                        <?php dual_post_like_dislike(); ?>
                    </div>

                    <div class="entry-meta">
                        <?php dual_entry_footer($cats = false, $tags = true, $edits = true); ?>
                    </div>

                </div>

            <?php } ?>

        </div>

    </div>
    
</article>