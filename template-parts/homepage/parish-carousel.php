<?php

/**
 * Template part for displaying the buttons component on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Celine
 */
?>

<div class="buttons-container carousel">
    <?php while (have_rows('parish_carousel')) : the_row(); ?>
    <div class="button carousel-item">
        <?php if (get_sub_field('is_image') && get_sub_field('image')) : ?>
        <img src="<?= get_sub_field('image')['url'] ?? ''; ?>" class="button-image" alt="<?= get_sub_field('parish_name'); ?>" />
        <?php else : ?>
        <?= get_sub_field('fa_icon'); ?>
        <?php endif; ?>

        <?php if (get_sub_field('parish_name')) : ?>
        <h4 class="button-title"><?= get_sub_field('parish_name'); ?></h4>
        <?php endif; ?>

        <?php if (get_sub_field('content')) : ?>
        <div class="button-text"><?= get_sub_field('content'); ?></div>
        <?php endif; ?>

        <a href="<?= get_sub_field('button')['url'] ?? ''; ?>" target="<?= get_sub_field('button')['target'] ?? ''; ?>" class="the-button"><?= get_sub_field('button')['title'] ?? ''; ?></a>
    </div>
    <?php endwhile; ?>
</div>
<?php get_template_part('template-parts/homepage/carousel', 'arrows', ['controls' => 'buttons-container']); ?>