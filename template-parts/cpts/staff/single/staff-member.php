<?php

/**
 * Template part for displaying staff member archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */


$staffImage = has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/assets/img/Blank-Avatar.png";

?>

<article id="post-<?php echo $post->post_name; ?>" <?php post_class(); ?>>

    <div class="entry-content staff-member">
        <img class="staff-member-image" src="<?php echo $staffImage; ?>;" />
        <div class="staff-member-info">
            <div class="staff-member-title-wrapper">
                <?php the_title("<span class='staff-member-title'>", "</span>"); ?>

                <div class="staff-member-position">
                    <?php the_field("position"); ?>
                </div>
            </div>

            <div class="staff-member-contact-wrapper">
                <?php if (get_field("email")) : ?>
                <a href="mailto:<?php the_field("email"); ?>" class="staff-member-email">
                    <i class="fa-solid fa-envelope"></i>
                </a>
                <?php endif; ?>

                <?php if (get_field("has_link") && get_field("link")) : ?>
                <a title="<?php the_title(); ?>" href="<?php echo get_field("link")["url"]; ?>">
                    <i class="fa-solid fa-link"></i>
                </a>
                <?php endif; ?>

                <?php if (get_field("phone")) : ?>
                <a title="Call <?php the_title(); ?>" href="tel:<?php echo get_field("phone"); ?>">
                    <?php the_field("phone"); ?>
                </a>
                <?php endif; ?>

            </div>

        </div>
    </div>
</article>