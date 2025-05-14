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

$dual_default = dual_get_default_theme_options();
$dual_archive_layout = get_theme_mod('dual_archive_layout', $dual_default['dual_archive_layout']);
if ($dual_archive_layout == 'default' || $dual_archive_layout == 'lateral' || $dual_archive_layout == 'masonry') {
    $image_size = 'medium_large';
} else {
    $image_size = 'full';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('theme-article twp-archive-items'); ?>>

    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <span class="data-bg data-bg-archive" data-background="<?php echo esc_url($featured_image); ?>"></span>
        </a>

        <?php
        $format = get_post_format(get_the_ID()) ?: 'standard';
        $icon = dual_post_format_icon($format);

        if (!empty($icon)) { ?>
            <div class="post-format-icon"><?php echo dual_svg_escape($icon); ?></div>
        <?php } ?>

        <div class="image-overlay-content">
            <?php if (class_exists('Booster_Extension_Class') && 'post' === get_post_type()) {
                dual_post_view_count();
                echo do_shortcode('[booster-extension-read-time]');
            } ?>
        </div>
    </div>

    <div class="post-content">

        <?php
        if ('post' === get_post_type()) { ?>
            <div class="entry-meta entry-meta-top">
                <?php dual_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
            </div>
        <?php } ?>

        <header class="entry-header">

            <h2 class="entry-title entry-title-medium">

                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>

            </h2>

        </header>

        <?php
        if ($dual_archive_layout == 'default' || $dual_archive_layout == 'lateral') { ?>

            <div class="entry-excerpt entry-excerpt-muted">
                <?php
                if (has_excerpt()) {

                    the_excerpt();
                } else {

                    echo '<p>' . esc_html(wp_trim_words(get_the_content(), 15, '...')) . '</p>';
                }

                ?>

            </div>

        <?php } ?>

        <div class="entry-footer">
            <div class="entry-meta">
                <?php
                dual_posted_by();
                ?>
            </div>

            <?php if (class_exists('Booster_Extension_Class') && 'post' === get_post_type()) { ?>
                <div class="post-content-share">
                    <?php echo do_shortcode('[booster-extension-ss layout="layout-2" status="enable"]'); ?>
                </div>
            <?php } ?>
            <?php if ($dual_archive_layout = 'masonry' && $dual_archive_layout != 'metro') { ?>
                <div class="entry-read-more"><a href="<?php the_permalink(); ?>" class="theme-button theme-button-border theme-button-small"><?php esc_html_e('Read More', 'dual'); ?></a></div>
            <?php } ?>

        </div>

    </div>

</article>