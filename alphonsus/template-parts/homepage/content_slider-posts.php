<?php

/**
 * Template part for displaying the posts content slider on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */
$auto = get_field("content_slider_auto_posts") ? true : false;
if ($auto) :
    $categories = get_field("content_slider_taxonomy");

    $num_posts = 3;

    $sticky = get_option("sticky_posts");

    if ($sticky) :
        $post_slides_sticky = get_posts(array(
            "category" => $categories,
            "numberposts" => $num_posts,
            "post__in" => $sticky
        ));

        $num_posts -= count($post_slides_sticky);
    endif;

    $post_slides_non_sticky = get_posts(array(
        "category" => $categories,
        "numberposts" => $num_posts,
        "post__not_in" => $sticky
    ));

    $post_slides = $sticky ? array_merge($post_slides_sticky, $post_slides_non_sticky) : $post_slides_non_sticky;
else :
    $post_slides = get_field("content_slider_posts");
endif;

$slick = count($post_slides) > 1 ? true : false;
?>

<div class="content-slider-posts equal-height" data-is-slider="<?php echo $slick ? "true" : "false"; ?>" data-auto-posts="<?php echo $auto ? "true" : "false"; ?>">
    <?php foreach ($post_slides as $single_post) : ?>
        <?php $bg_img = has_post_thumbnail($single_post) ? get_the_post_thumbnail_url($single_post) : getDefaultFeaturedImage(true); ?>
        <div class="content-slider-post" data-id="<?php echo $single_post->ID; ?>" style="background-image:url('<?php echo $bg_img; ?>');">
            <div class="limit-width">
                <div class="content-slider-post-inner">
                    <h2 class="content-slider-post-heading has-text-decoration">
                        <?php echo $single_post->post_title; ?>
                    </h2>
                    <div class="content-slider-post-content">
                        <?php echo wp_trim_words($single_post->post_content, 15); ?>
                    </div>
                    <a href="<?php echo get_the_permalink($single_post); ?>" class="the-button btn-secondary">
                        Learn More
                    </a>
                </div>
                <div class="slick-dots-wrapper"></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>