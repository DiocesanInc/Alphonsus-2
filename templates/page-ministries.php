<?php

/**
 * Template Name: Ministries
 *
 * The template for displaying the Ministry Groups Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();
?>


<div class="content-area" id="primary">
    <main class="site-main" id="main">
        <?php get_template_part('template-parts/headers/page-header'); ?>

        <?php if (have_posts()) : ?>
            <div class="ministries-container limit-width">

                <div class="content-wrapper">
                    <?php the_content(); ?>
                </div>
                <div class="clearfix"></div>
                <?php get_template_part('template-parts/cpts/ministries/archive/ministry', 'archive'); ?>
            </div>
        <?php else :
            get_template_part('template-parts/content', 'none');
        endif;
        wp_reset_postdata(); ?>
    </main>
</div>

<?php get_footer();
