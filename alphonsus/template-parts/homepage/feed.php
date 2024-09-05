<?php

/**
 * Template part for displaying the instagram feed on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

?>

<?php if (get_field("feed_shortcode")) : ?>
    <div class="instagram-feed-container">
        <?php echo do_shortcode(get_field("feed_shortcode")); ?>
    </div>
<?php endif; ?>