<?php

/**
 * Template Name: Contact
 *
 * The template for displaying the Contact Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();
?>

<div class="content-area" id="primary">
    <main class="site-main page-template-contact" id="main">
        <?php get_template_part('template-parts/headers/page-header'); ?>
        <div class="limit-width">
            <?php the_content(); ?>

            <?php if (get_field("google_maps_iframe", "options")): ?>
                <iframe src="<?php echo get_field("google_maps_iframe", "options")["url"]; ?>" width="100%" height="450px"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php endif; ?>
        </div>

    </main>
</div>

<?php get_footer();
