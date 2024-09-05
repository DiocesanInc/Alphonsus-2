<?php

/**
 * Template part for displaying the stats on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

?>

<?php if (have_rows("stat_items")) : ?>
    <div class="banner-items stat-items slick-slider same-height">
        <?php while (have_rows("stat_items")) : the_row(); ?>
            <div class="banner-item">
                <div class="banner-item-icon">
                    <?php the_sub_field("stat_item_icon"); ?>
                </div>
                <div class="banner-item-content">
                    <?php the_sub_field("stat_item_content"); ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>