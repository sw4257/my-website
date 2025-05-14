<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dual
 * @since 1.0.0
 */

/**
 * Footer Toogle Contents
 * @hooked dual_header_toggle_search - 10
 * @hooked dual_content_offcanvas - 30
 */

do_action('dual_before_footer_content_action'); ?>
<footer id="site-footer" role="contentinfo">

<?php
/**
 * Footer Content
 */

do_action('dual_footer_content_info_action'); ?>

</footer>
</div>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>