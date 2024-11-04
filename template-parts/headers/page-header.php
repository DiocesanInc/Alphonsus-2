<?php

/**
 * Partial for the page header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

if (array_key_exists("headerImg", $args) && $args["headerImg"] && $args["headerImg"] !== null) {
    $headerImg = $args["headerImg"];
} else {
    if (has_post_thumbnail()) {
        $headerImg = get_the_post_thumbnail_url(null, "large");
    } else {
        $headerImg = getDefaultFeaturedImage(true) ? getDefaultFeaturedImage(true) : get_stylesheet_directory_uri() . "/assets/img/alphonsus_placeholder.png";
    }
}

$headline = array_key_exists("headline", $args) && $args["headline"] ? $args["headline"] : get_the_title();
?>

<div class="entry-header page-header" style="background-image: url(<?php echo $headerImg; ?>)">
    <div class="entry-title-wrapper">
        <h1 class="entry-title has-text-decoration">
            <?php if (is_tax()) {
                    $headline = preg_replace("/^([\w ]+)Group:\s+/i", "", get_the_archive_title());
                    echo $headline;
                } else { echo $headline; } ?>
        </h1>
        <?php the_breadcrumb(); ?>
    </div>
    <div class="overlay" style="opacity: <?php the_field("page_header_overlay", "options"); ?>"></div>
</div><!-- .entry-header -->