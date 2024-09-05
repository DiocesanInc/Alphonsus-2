<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package alphonsus
 */

get_header();
?>

<main id="primary" class="site-main content-area">

    <section class="error-404 not-found">

        <?php get_template_part("/template-parts/content", "none"); ?>

    </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
