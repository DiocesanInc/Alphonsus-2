<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <div class="entry-summary limit-width">
        <?php the_post_thumbnail();
        the_title("<h3 class='post-title'>", "</h3>");
        if (has_excerpt(get_the_ID())) :
            the_excerpt();
        else :
            echo wp_trim_words(get_the_content(), 25);
        endif; ?>

        <a href="<?php the_permalink(get_the_ID()); ?>" class="more" title="<?php the_title(); ?>">more</a>
        <?php wp_link_pages(); ?>

    </div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->