<?php

/**
 * Template part for displaying the featured buttons on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$gap = get_field("featured_buttons_gap") ? "true" : "false";

$inner_border = $gap == "true" && get_field("featured_buttons_inner_border") ? "true" : "false";
?>

<?php if (have_rows("featured_buttons")) : ?>
<div class="featured-buttons-container limit-width" data-gap="<?php echo $gap; ?>"
    data-inner-border="<?php echo $inner_border; ?>">
    <?php while (have_rows("featured_buttons")) : the_row(); ?>
    <?php $bg_clr = get_sub_field("background_color"); ?>
    <?php $class = str_replace(array("var(--", ")"), "", $bg_clr); ?>
    <?php $img = get_sub_field("hover_image")["url"] ?? ''; ?>
    <?php $url = get_sub_field("link")["url"] ?? ''; ?>
    <?php $title = get_sub_field("link")["title"] ?? ''; ?>
    <?php $icon = get_sub_field("icon"); ?>

    <a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="featured-button <?php echo $class; ?>"
        style="--background_color: <?php echo $bg_clr; ?>; --hover-image: url(<?php echo $img; ?>);">
        <div class="featured-button-inner">
            <?php echo $icon; ?>
            <span class="featured-button-title">
                <?php echo $title; ?>
            </span>
        </div>
    </a>
    <?php endwhile; ?>
</div>
<?php endif; ?>