<?php

/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

$icon_clr = getField("site_info_social_media_icons_color", "options", true, "white");

?>

<div class="site-info">
    <div class="limit-width">
        <div class="copyright">© <?php echo date("Y"); ?> <a href="<?php echo home_url(); ?>"
                class="homelink has-custom-hover has-quaternary-background-color-after"
                title="Home"><?php echo get_bloginfo("name"); ?></a>
        </div>
        <div class="social-media-wrapper">
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
        <div class="diocesan">
            Made with <span class="heart">♥</span> by <a target="_blank" href="https://www.diocesan.com"
                class="diocesan-link has-custom-hover has-quaternary-background-color-after"
                title="Diocesan">Diocesan</a>
        </div>
    </div>
</div>