<?php

/**
 * Template part for displaying the testimonials on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$heading = get_field("testimonials_heading");
$testimonials = get_field("testimonials") ? get_field("testimonials") : get_posts(array("post_type" => "testimonial", "sort_by" => "date", "order" => "desc"));

?>

<div class="testimonials-container">

    <?php if ($heading) : ?>

        <h2 class="testimonials-heading">
            <?php echo $heading; ?>
        </h2>
    <?php endif; ?>

    <?php if ($testimonials) : ?>
        <div class="slick-slider">
            <?php foreach ($testimonials as $testimonial) : ?>
                <div class="testimonial-wrapper">
                    <div class="testimonial-header-wrapper">
                        <?php if (has_post_thumbnail($testimonial)) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url($testimonial); ?>" alt="<?php echo $testimonial->post_title; ?>" class="testimonial-image" />
                        <?php endif; ?>
                        <h4 class="testimonial-heading">
                            <?php echo $testimonial->post_title; ?>
                        </h4>
                    </div>

                    <div class="testimonial-content">
                        <?php echo wp_trim_words($testimonial->post_content, 70); ?>
                    </div>

                    <a href="<?php the_permalink($testimonial) ?>" class="the-button">
                        Learn More
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>


</div>