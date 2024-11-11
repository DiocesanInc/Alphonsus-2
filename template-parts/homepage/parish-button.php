<?php

/**
 * Partial template for a single featured button
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package celine
 */

//  if (get_sub_field('link') || get_sub_field('image')) :
     $link = get_sub_field('link');
     $icon  = get_sub_field('image');
     $target = $link['target'] ?? 'target';
     $title  = get_sub_field('title');
     $url    = $link['url'] ?? '#';
     //if ($link["url"] || $icon) :?>

     <a class="featured-button" href="<?php echo $url; ?>" target="<?php echo $target; ?>" title="<?php echo $title; ?>">
        <img src="<?php echo $icon; ?>">
        <h4 class="button-title">
            <?php echo $title; ?>
        </h4>
        <?php if (have_rows('mass_times')):?>
        <?php while (have_rows('mass_times')): the_row();?>
        <p>
        <?php echo get_sub_field('text');?>
        </p>
        <?php endwhile; ?>
        <?php endif;?>
     </a>
     <?php //endif;
 //endif;
