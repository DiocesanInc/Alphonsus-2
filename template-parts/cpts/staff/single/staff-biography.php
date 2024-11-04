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
        <?php the_title("<h2 class='post-title'>", "</h2>"); ?>

        <div>

            <?php the_content(); ?>
        </div>

    </div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->