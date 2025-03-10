<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

?>
<footer id="colophon" class="site-footer">

    <?php get_template_part("template-parts/footers/footer"); ?>
    <?php get_template_part("template-parts/footers/site-info"); ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>