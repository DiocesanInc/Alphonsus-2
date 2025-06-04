<?php

/**
 * Template part for displaying the mass times on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$bg_img = get_field("mass_times_bg_img");
$bg_img_path = $bg_img == 'select' ? get_field('watermark_upload') : get_template_directory_uri() . "/assets/img/$bg_img.svg";

$bg = $bg_img ? "style='background-image:url($bg_img_path);'" : "";

?>

<div class="mass-times-container">
    <div class="limit-width-laptop-up">

        <div class="mass-times-left">

            <?php if (get_field("mass_times_image_1")) : ?>
                <div class="mass-times-image-wrapper">
                    <?php $image1 = get_field("mass_times_image_1")["url"] ?? '';?>
                    <img src="<?php echo $image1; ?>" alt="">
                </div>
            <?php endif; ?>

            <?php if (get_field("mass_times_image_2")) : ?>
                <div class="mass-times-image-wrapper">
                    <?php $image2 = get_field("mass_times_image_2")["url"] ?? '';?>
                    <img src="<?php echo $image2; ?>" alt="">
                </div>
            <?php endif; ?>
        </div>

        <div class="mass-times-right limit-width-laptop-down">
            <h2 class="mass-times-heading has-text-decoration has-primary-background-color-after">
                <?php the_field("mass_times_headline_1"); ?>
            </h2>

            <?php
            if (get_field("mass_times_content_type")) :
                if (have_rows("mass_times_sections", "options")) :
                    get_template_part(
                        "template-parts/homepage/mass_times",
                        "schedule"
                    );
                endif;
            else :
                echo get_field("mass_times_content");
            endif;
            echo acfLink(get_field("mass_times_link"), "the-button"); ?>
        </div>
    </div>
    <?php if ($bg_img == 'select') : ?>
        <div class="bg-img select" <?php echo $bg; ?>></div>
    <?php elseif ($bg_img) : ?>
        <div class="bg-img" <?php echo $bg; ?>></div>
    <?php endif; ?>
</div>