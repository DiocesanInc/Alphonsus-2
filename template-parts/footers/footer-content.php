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
    <div class="footer-logo-wrapper<?php echo get_field("footer_content", "options") ? " has-text-decoration" : ""; ?>">
        <?php if (get_field("footer_logo_link", "options")) : ?>
        <a href="<?php echo esc_url(get_field("footer_logo_link", "options")["url"]); ?>"
            target="<?php echo get_field("footer_logo_link", "options")["target"] ?? '_self'; ?>"
            title="<?php echo esc_attr(get_field("footer_logo_link", "options")["title"] ?? ''); ?>">
            <img src="<?php echo get_field("footer_logo", "options")["url"] ?? ''; ?>" class="footer-logo">
        </a>
        <?php else: ?>
        <img src="<?php echo get_field("footer_logo", "options")["url"] ?? ''; ?>" class="footer-logo">
        <?php endif; ?>
    </div>
    <?php the_field("footer_content", "options"); ?>
</div>