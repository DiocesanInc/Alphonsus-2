<?php

/**
 * Template part for displaying the custom content slider on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$slick = count(get_field("content_slider_items")) > 1 ? "true" : "false";

?>

<div class="content-slider-custom equal-height" data-is-slider="<?php echo $slick; ?>">
    <?php while (have_rows("content_slider_items")) : the_row(); ?>
        <?php $bglink = get_sub_field("background_image")["url"];?>
        <div class="content-slider-post" style="background-image:url(<?php echo $bglink; ?>)">
            <div class="limit-width">
                <h2 class="content-slider-post-heading has-text-decoration"><?php the_sub_field("heading"); ?></h2>
                <h3 class="content-slider-post-subheading"><?php the_sub_field("subheading"); ?></h3>
                <div class="content-slider-post-content"><?php the_sub_field("text"); ?></div>
                <?php echo acfLink(get_sub_field("link"), "the-button btn-secondary"); ?>
                <div class="slick-dots-wrapper"></div>
            </div>

        </div>
    <?php endwhile; ?>
</div>