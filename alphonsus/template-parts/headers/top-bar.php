<?php

/**
 * Partial for the top bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$bg_clr = getField("top_bar_bg_color", "options", true, "black");
$icon_clr = getField("top_bar_icon_color", "options", true, "white");
$show_address = get_field("top_bar_show_address", "options");
$show_email = get_field("top_bar_show_email", "options");
$show_phone_number = get_field("top_bar_show_phone_number", "options");
$show_lang = get_field("show_language_selector", "options");
?>

<div id="header-top-bar" class="top-bar" style="--bg-clr: <?php echo $bg_clr; ?>">
    <div class="top-bar-inner limit-width-wide">
        <div class="top-bar-left">
            <?php if ($show_address) : ?>
            <div class="address">
                <a target="_blank" href="<?php echo get_field("address", "options")["url"]; ?>">
                    <i class="fa-solid fa-location-dot" style="--icon-clr: <?php echo $icon_clr; ?>"></i>
                    <?php echo get_field("address", "options")["title"]; ?>
                </a>
            </div>
            <?php endif; ?>

            <?php if ($show_email) : ?>
            <div class="email">
                <a href="mailto:<?php echo get_field("email", "options"); ?>">
                    <i class="fa-solid fa-envelope" style="--icon-clr: <?php echo $icon_clr; ?>"></i>
                    <?php echo get_field("email", "options"); ?>
                </a>
            </div>
            <?php endif; ?>

            <?php if ($show_phone_number) : ?>
            <div class="phone">
                <a href="tel:<?php echo get_field("phone", "options"); ?>">
                    <i class="fa-solid fa-mobile-screen-button" style="--icon-clr: <?php echo $icon_clr; ?>"></i>
                    <?php echo get_field("phone", "options"); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>

        <div class="top-bar-right">
            <?php if (have_rows("social_media", "options")) : ?>
            <div class="social-media">
                <?php while (have_rows("social_media", "options")) : the_row();
                        $title = get_sub_field("link")["title"] ? get_sub_field("link")["title"] : get_sub_field("link")["url"];
                    ?>
                <a target="_blank" title="<?php echo $title; ?>" href="<?php echo get_sub_field("link")["url"]; ?>"
                    style="--icon-clr: <?php echo $icon_clr; ?>">
                    <?php echo get_sub_field("icon"); ?>
                </a>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>