<?php

/**
 * Template part for displaying the a single news post on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

?>

<div class="news-post">
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php echo get_the_permalink(); ?>" class="image-link-wrapper" title="Read more">
            <img src="<?php echo get_the_post_thumbnail_url(null, "large"); ?>" alt="<?php echo get_the_title(); ?>">
        </a>
    <?php endif; ?>

    <h3 class="post-heading">
        <a href="<?php echo get_the_permalink(); ?>" title="Read more">
            <?php the_title(); ?>
        </a>
    </h3>

    <div class="post-excerpt">
        <?php if (has_excerpt()) :
            the_excerpt();
        else :
            echo wp_trim_words(get_the_content(), 50);
        endif;
        ?>
    </div>

    <a href="<?php echo get_the_permalink(); ?>" class="post-read-more" title="Read more">
        Read More
    </a>
</div>