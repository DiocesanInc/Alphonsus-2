<?php

/**
 * Template Name: Landing Page
 *
 * The template for displaying the Landing page Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header("landing");

?>

<div class="content-area" id="primary">
    <main class="site-main page-template-landing-page" id="main">
        <div data-aos="fade-right" class="landing-left" style="background-image: url(<?php echo get_field("church_background_image")["url"]; ?>);">

            <?php if (get_field("church_logo")) : ?>
                <img data-aos="fade-up" data-aos-delay=".5s" src="<?php echo get_field("church_logo")["url"]; ?>" class="logo" alt="church logo" />
            <?php endif; ?>

            <?php if (get_field("church_title")) : ?>
                <h1 class="title">
                    <?php the_field("church_title"); ?>
                </h1>
            <?php endif; ?>

            <?php if (get_field("church_subtitle")) : ?>
                <h2 class="subtitle">
                    <?php the_field("church_subtitle"); ?>
                </h2>
            <?php endif; ?>

            <?php if (get_field("church_link")) : ?>
                <a href="<?php echo get_field("church_link")["url"]; ?>" class="link the-button">
                    <?php echo get_field("church_link")["title"]; ?>
                </a>
            <?php endif; ?>

            <?php if (get_field("church_has_separate_address")) : ?>
                <div class="address">
                    <a target="_blank" href="<?php the_field("church_google_maps_link"); ?>"><?php the_field("church_address"); ?></a> | <a href="tel:<?php the_field("church_phone_number"); ?>"><?php the_field("church_phone_number"); ?></a>
                </div>
            <?php endif; ?>

        </div>
        <div data-aos="fade-left" class="landing-right" style="background-image: url(<?php echo get_field("school_background_image")["url"]; ?>);">

            <?php if (get_field("school_logo")) : ?>
                <img data-aos="fade-up" data-aos-delay=".5s" src="<?php echo get_field("school_logo")["url"]; ?>" class="logo" alt="school logo" />
            <?php endif; ?>

            <?php if (get_field("school_title")) : ?>
                <h1 class="title">
                    <?php the_field("school_title"); ?>
                </h1>
            <?php endif; ?>

            <?php if (get_field("school_subtitle")) : ?>
                <h2 class="subtitle">
                    <?php the_field("school_subtitle"); ?>
                </h2>
            <?php endif; ?>

            <?php if (get_field("school_link")) : ?>
                <a href="<?php echo get_field("school_link")["url"]; ?>" class="link the-button">
                    <?php echo get_field("school_link")["title"]; ?>
                </a>
            <?php endif; ?>

            <?php if (get_field("school_has_separate_address")) : ?>
                <div class="address">
                    <a target="_blank" href="<?php the_field("school_google_maps_link"); ?>"><?php the_field("school_address"); ?></a> |
                    <a href="tel:<?php the_field("school_phone_number"); ?>"><?php the_field("school_phone_number"); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!get_field("church_has_separate_address") && !get_field("school_has_separate_address")) : ?>
            <div class="address">
                <a target="_blank" href="<?php the_field("landing_google_maps_link"); ?>"><?php the_field("landing_address"); ?></a> | <a href="tel:<?php the_field("landing_phone_number"); ?>"><?php the_field("landing_phone_number"); ?></a>
            </div>
        <?php endif; ?>
    </main>
</div>