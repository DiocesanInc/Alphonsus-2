<?php

/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

$icon_clr = getField("footer_icon_color", "options", true, 'white');

?>

<div class="footer-contact">
    <h2 class="has-text-decoration"><?php the_field("footer_contact_header", "options"); ?></h2>

    <div class="footer-contact-inner">
        <?php if (get_field("address", "options")) : ?>
        <div class="address">
            <i class="fa-solid fa-location-dot" style="--icon-clr: <?php echo $icon_clr; ?>"></i>
            <a target="_blank" href="<?php echo get_field("address", "options")["url"]; ?>">
                <?php echo get_field("address", "options")["title"]; ?>
            </a>
        </div>
        <?php endif; ?>

        <?php if (get_field("email", "options")) : ?>
        <div class="email">
            <i class="fa-solid fa-envelope" style="--icon-clr: <?php echo $icon_clr; ?>"></i>
            <?php echo emailLink(get_field("email", "options"), get_field("email", "options")); ?>
        </div>
        <?php endif; ?>

        <?php if (get_field("phone", "options")) : ?>
        <div class="phone">
            <i class="fa-solid fa-phone" style="--icon-clr: <?php echo $icon_clr; ?>"></i>
            <?php echo phoneLink(get_field("phone", "options"), true); ?>
        </div>
        <?php endif; ?>
    </div>

</div>