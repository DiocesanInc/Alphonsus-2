<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$headline = get_search_query() !== "" ?  get_search_query() : "Page not found";
?>

<section class="no-results not-found">
    <?php get_template_part("/template-parts/headers/page-header", null, array("headline" => $headline)); ?>


    <div class="page-content limit-width">

        <?php if (is_search()) : ?>

            <p>
                <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'alphonsus'); ?>
            </p>
        <?php get_search_form();

        else : ?>

            <p>
                <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'alphonsus'); ?>
            </p>
        <?php get_search_form();

        endif;  ?>

        <?php wp_link_pages(); ?>

    </div><!-- .page-content -->
</section><!-- .no-results -->