<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */



?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content limit-width">

        <img class="featured-image" src="<?php the_post_thumbnail_url("medium"); ?>" />
        <?php
        if (!$args["hasPageHeader"]) :
            the_title("<h1 class='post-title'>", "</h1>");
        endif; ?>

        <div>

            <?php
            the_content();

            wp_link_pages();
            ?>
        </div>

    </div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->