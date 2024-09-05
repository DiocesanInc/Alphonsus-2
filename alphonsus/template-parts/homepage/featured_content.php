<?php

/**
 * Template part for displaying the featured content on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

?>

<?php if (have_rows("featured_content_items")) : ?>
    <div class="featured-content-container limit-width">

        <?php while (have_rows("featured_content_items")) : the_row(); ?>
            <?php $bgImg = get_sub_field("image")["url"]; ?>

            <a href="<?php echo get_sub_field("link")["url"]; ?>" class="featured-content-item-wrapper" style="background-image:url(<?php echo $bgImg; ?>)">
                <div class="featured-content-heading-wrapper">
                    <div class="featured-content-heading">
                        <?php the_sub_field("item_name"); ?>
                    </div>
                    <div class="featured-content-subheading">
                        <?php the_sub_field("item_subheading"); ?>
                    </div>
                    <div class="featured-content-text">
                        <?php the_sub_field("content"); ?>
                    </div>
                </div>
            </a>
        <?php endwhile; ?>

    </div>
<?php endif; ?>