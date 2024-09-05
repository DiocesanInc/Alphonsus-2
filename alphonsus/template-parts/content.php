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
        <?php
        the_content();

        wp_link_pages();
        ?>
    </div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->