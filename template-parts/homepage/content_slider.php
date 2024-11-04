<?php

/**
 * Template part for displaying the content slider on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$content_type = get_field("content_slider_content_type") ? "custom" : "posts";

$alignment = getField("content_slider_alignment", false, false, "left");

$style = get_field("content_slider_style") ? "has-overlay" : "no-bg";
$overlay_color = get_field("content_slider_style") ? get_field("content_slider_background_color") : "";
?>

<div class="content-slider-container" data-parallax="true" data-content-type="<?php echo $content_type; ?>" data-alignment="<?php echo $alignment; ?>" data-style="<?php echo $style; ?>" style="--overlay-color: <?php echo $overlay_color; ?>">
    <?php get_template_part("template-parts/homepage/content_slider", $content_type); ?>
</div>