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
    $image_size = 'medimu_large';
} else {
    $image_size = 'full';
}
$ratio_value = get_post_meta(get_the_ID(), 'twp_aspect_ratio', true);

if ($ratio_value == '' || $ratio_value == 'global') {
    $ratio_value = get_theme_mod('post_video_aspect_ration', $dual_default['post_video_aspect_ration']);
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('theme-article twp-archive-items'); ?>>

    <?php
    add_filter('booster_extension_filter_like_ed', function () {
        return false;
    });
    $content = apply_filters('the_content', get_the_content());
    $video = false;

    // Only get video from the content if a playlist isn't present.
    if (false === strpos($content, 'wp-playlist-script')) {

        $video = get_media_embedded_in_content($content, array('video', 'object', 'embed', 'iframe'));
    }

    if (!empty($video)) { ?>

        <div class="post-thumbnail post-thumbnail-media">

            <div class="twp-content-video">

                <?php

                $video_autoplay = 'autoplay-enable';
                if ($video_autoplay == 'autoplay-enable') {
                    $autoplay_class = 'pause';
                    $play_pause_text = esc_html__('Pause', 'dual');
                } else {
                    $autoplay_class = 'play';
                    $play_pause_text = esc_html__('Play', 'dual');
                }

                $class3 = 'video-main-wraper';
                $class2 = 'video-id';

                foreach ($video as $video_html) { ?>

                    <div class="entry-video theme-ratio-<?php echo esc_attr($ratio_value); ?>">
                        <div class="theme-video-controllers hide-no-js">

                            <button attr-id="<?php echo esc_attr($class2); ?>-<?php echo absint(get_the_ID()); ?>" class="theme-video-control theme-action-control twp-pause-play <?php echo esc_attr($autoplay_class); ?>">
                                <span class="action-control-trigger">
                                    <span class="twp-video-control-action">
                                        <?php dual_the_theme_svg($autoplay_class); ?>
                                    </span>

                                    <span class="screen-reader-text">
                                        <?php echo $play_pause_text; ?>
                                    </span>
                                </span>
                            </button>

                            <button attr-id="<?php echo esc_attr($class2); ?>-<?php echo absint(get_the_ID()); ?>" class="theme-video-control theme-action-control twp-mute-unmute unmute">
                                <span class="action-control-trigger">
                                    <span class="twp-video-control-action">
                                        <?php dual_the_theme_svg('mute'); ?>
                                    </span>

                                    <span class="screen-reader-text">
                                        <?php esc_html_e('Unmute', 'dual'); ?>
                                    </span>
                                </span>
                            </button>

                        </div>

                        <div class="theme-video-panel <?php echo esc_attr($class3); ?>" data-autoplay="<?php echo esc_attr($video_autoplay); ?>" data-id="<?php echo esc_attr($class2); ?>-<?php echo absint(get_the_ID()); ?>">
                            <?php echo dual_iframe_escape($video_html); ?>
                        </div>

                    </div>

                <?php
                    break;
                } ?>

            </div>
        </div>

        <?php
    } else {

        if (has_post_thumbnail()) {

            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

            <div class="post-thumbnail">
                <div class="post-thumbnail-effects">

                    <a href="<?php the_permalink(); ?>">
                        <span class="data-bg data-bg-archive" data-background="<?php echo esc_url($featured_image); ?>"></span>
                    </a>

                    <?php
                    $format = get_post_format(get_the_ID()) ?: 'standard';
                    $icon = dual_post_format_icon($format);

                    if (!empty($icon)) { ?>
                        <div class="post-format-icon"><?php echo dual_svg_escape($icon); ?></div>
                    <?php } ?>

                </div>

            </div>

    <?php }
    } ?>

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

            <?php if ($dual_archive_layout = 'masonry' && $dual_archive_layout != 'metro') { ?>
                <div class="entry-read-more"><a href="<?php the_permalink(); ?>" class="theme-button theme-button-border theme-button-small"><?php esc_html_e('Read More', 'dual'); ?></a></div>
            <?php } ?>

        </div>

    </div>

</article>