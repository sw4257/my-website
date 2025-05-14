<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Dual
 */

get_header();
?>
    <div class="singular-main-block">
        <div class="theme-block error-block error-block-heading">
            <div class="wrapper">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'dual'); ?></h1>
                </header><!-- .page-header -->
            </div>
        </div>


        <div class="theme-block error-block error-block-top">
            <div class="wrapper">
                <div class="theme-row">
                    <div class="column column-12">
                        <h2><?php esc_html_e('Maybe it’s out there, somewhere...', 'dual'); ?></h2>
                        <p><?php esc_html_e('You can always find insightful stories on our', 'dual'); ?>
                            <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e('Homepage','dual'); ?></a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="theme-block error-block error-block-middle theme-block-nobottom">
            <div class="wrapper">
                <div class="theme-row">
                    <div class="column column-12">
                        <h2><?php esc_html_e('Still feeling lost? You’re not alone.', 'dual'); ?></h2>
                        <p><?php esc_html_e('Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'dual'); ?></p>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php
get_footer();
