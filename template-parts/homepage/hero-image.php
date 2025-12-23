<?php

/**
 * Partial for the hero section: Image(s).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$slideClasses = get_field("parallax_scrolling") ? "hero-slide parallax" : "hero-slide";
$parallax = get_field("parallax_scrolling") ? "true" : "false";
$autoplay = get_field("hero_slider_autoplay", "options") ? "true" : "false";
$autoplay_speed = get_field("hero_slider_autoplay_speed", "options") ? get_field("hero_slider_autoplay_speed", "options") : "false";
$show_welcome = getField("show_welcome", false,  false, "false");
$has_dots =
    get_field("hero_has_dots", "options") ? "true" : "false";
$has_arrows =
    get_field("hero_has_arrows", "options") ? "true" : "false";
?>
<?php if (have_rows("slider")) : ?>
    <div class="hero" data-show-welcome="<?php echo $show_welcome; ?>">
        <div class="hero-slider" data-parallax="<?php echo $parallax; ?>" data-autoplay="<?php echo $autoplay; ?>" data-autoplay-speed="<?php echo $autoplay_speed; ?>" data-has-dots="<?php echo $has_dots; ?>" data-has-arrows="<?php echo $has_arrows; ?>">
            <?php while (have_rows("slider")) : the_row();
                $bgImg = get_sub_field("image")['url'] ?? '';
            ?>

                <div class="<?php echo $slideClasses; ?>" style="background-image: url(<?php echo $bgImg; ?>)">



                    <?php get_template_part("template-parts/homepage/hero", "overlay"); ?>
                    <?php get_template_part("template-parts/homepage/hero", "info"); ?>


                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
