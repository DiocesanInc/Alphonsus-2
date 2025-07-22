<?php

/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

?>

<div class="footer-content">
    <div class="footer-logo-wrapper has-text-decoration">
        <img src="<?php echo get_field("footer_logo", "options")["url"] ?? ''; ?>" class="footer-logo">
    </div>
    <?php the_field("footer_content", "options"); ?>
</div>