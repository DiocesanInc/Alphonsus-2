<?php

/**
 * Template Name: No Page Header
 *
 * The template for displaying the No Header Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();
?>

<!-- .entry-header -->

<article id="post-<?php the_ID(); ?>" <?php post_class("page-no-header"); ?>>
    <div class="entry-title-wrapper limit-width">
        <h1 class="entry-title has-text-decoration has-text-align-center has-text-decoration text-decoration-is-centered has-primary-background-color-after">
            <?php the_title(); ?>
        </h1>
        <?php the_breadcrumb(); ?>
    </div>
    <div class="entry-content limit-width">
        <?php
        the_content();
        wp_link_pages();

        ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->