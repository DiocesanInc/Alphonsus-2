<?php

/**
 * Template part for displaying the ministry archive as a slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */


$groups = get_terms(
    array(
        'taxonomy'   => "ministry-group",
        'hide_empty' => false,
        "orderby" => "date",
        "order" => "DESC"
    )
);

$terms = get_terms(
    array(
        'taxonomy'   => "ministry-group",
        'hide_empty' => false,
        "orderby" => "title",
        "order" => "ASC"
    )
);

$ministryGroups = [];

foreach ($terms as $ministryGroup) {
    $order = get_field("ministry_group_order", "ministry-group_$ministryGroup->term_id");

    if ($order !== "") {
        $ministryGroups[$order] = $ministryGroup;
    } else {
        array_push($ministryGroups, $ministryGroup);
    }
}

ksort($ministryGroups, SORT_NUMERIC);

$contactFormId = get_field("ministry_contact_form_id", "options") ? get_field("ministry_contact_form_id", "options")["id"] : 1;
$has_lightbox = get_field("open_lightbox") ? "true" : "false";

?>

<div class="ministry-slider entry-content max-width" data-has-lightbox="<?php echo $has_lightbox; ?>">
    <?php foreach ($ministryGroups as $group) :
        $args = array(
            "post_type" => "ministry",
            "tax_query" => array(
                array(
                    "taxonomy" => "ministry-group",
                    "field" => "term_id",
                    "terms" => $group->term_id
                )
            ),
            "orderby" => "menu_order title",
            "order" => "ASC",
            "numberposts" => -1
        );

        $ministries = get_posts($args);
    ?>
    <div class="ministry-group same-height">
        <h2><?php echo $group->name; ?></h2>
        <?php foreach ($ministries as $ministry) :
                $excerpt = $ministry->post_excerpt ? $ministry->post_excerpt : $ministry->post_content;
                $contactFormId = get_field("ministry_lightbox_contact_form", "options") ? get_field("ministry_lightbox_contact_form", "options")["id"] : 1;
                $thumbnail = has_post_thumbnail($ministry) ? get_the_post_thumbnail_url($ministry) : get_field("default_featured_image", "options");

                if (get_field("open_lightbox")) : ?>

        <div class="ministry-wrapper teaser-box" data-excerpt="<?php echo wp_trim_words($excerpt, 100); ?>"
            data-title="<?php echo $ministry->post_title; ?>" data-image="<?php echo $thumbnail; ?>"
            data-link="<?php echo get_the_permalink($ministry); ?>" data-contact="<?php echo ""; ?>">
            <div class=" ministry-image-wrapper">
                <img class="teaser-img" src="<?php echo $thumbnail; ?>" />
            </div>
            <div class="teaser-content-wrapper">
                <h3 class="teaser-title"><?php echo $ministry->post_title ?></h3>
            </div>
        </div>

        <?php else : ?>

        <a class="ministry-wrapper teaser-box" href="<?php echo get_the_permalink($ministry); ?>">
            <div class=" ministry-image-wrapper">
                <img class="teaser-img" src="<?php echo $thumbnail; ?>" />
            </div>
            <div class="teaser-content-wrapper">
                <h3 class="teaser-title"><?php echo $ministry->post_title ?></h3>
            </div>
        </a>

        <?php endif; ?>

        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>
<?php if (get_field("open_lightbox")) : ?>
<div class="lightbox-overlay"></div>
<div id="ministry-lightbox" class="lightbox">
    <div class="lightbox-close"></div>
    <div class="lightbox-image"></div>
    <div class="lightbox-content">
        <h4 class="lightbox-title"></h4>
        <div class="lightbox-excerpt"></div>
        <div class="lightbox-contact-persons"></div>
        <div class="lightbox-link"></div>
        <?php if ($formId = get_field("ministries", "options")["ministry_contact_form"]) :
            ?>
        <div class="contact-form-wrapper">
            <h5>Interested?</h5>
            <p>Let us know and we will get back to you.</p>
            <div class="contact-form">
                <?php echo do_shortcode("[gravityform id='$formId' title='false' description='false' ajax='true']"); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>
<?php endif;