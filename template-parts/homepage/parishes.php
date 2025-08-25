<?php

/**
 * Partial for the Homepage template's parish.
 *
 * @package Celine
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

 ?>
 <div class="parish-cluster">
    <?php if(get_field('parish_scroll_title')):?> 
        <h2 class="parish-scroll-title has-text-decoration text-decoration-is-centered has-tertiary-background-color-after">
            <?php echo get_field('parish_scroll_title');?>
        </h2>
    <?php endif;?>
    <?php if (have_rows('parish_buttons')&&(get_field('cluster_style') == 'buttons')) : ?>
        <div class="featured-buttons parishBtns" data-btns="<?php echo count(get_field('parish_buttons')); ?>">
            <div class="featured-buttons-wrapper parishButtons">
                <?php while (have_rows('parish_buttons')) : the_row();
                    get_template_part("template-parts/homepage/parish", "button");
                endwhile; ?>
            </div>
        </div>
    <?php elseif(have_rows('parish_carousel')&&(get_field('cluster_style') == 'carousel')) : 
        get_template_part("template-parts/homepage/parish", "carousel");?>
    <?php elseif(have_rows('parish_slider')&&(get_field('cluster_style') == 'slider')) : 
        get_template_part("template-parts/homepage/parish", "slider");?>
    <?php endif;?>
 
 </div>
