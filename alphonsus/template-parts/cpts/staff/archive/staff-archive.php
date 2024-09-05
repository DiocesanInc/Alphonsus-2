<?php

/**
 * Template part for displaying staff member archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$staffGroups = get_terms(array("taxonomy" => "staff-group", 'hide_empty' => false));

$staff = [];

foreach ($staffGroups as $staffGroup) {
    $order = get_field("staff_group_order", "staff-group_" . $staffGroup->term_id);

    $args = array(
        'post_type' => 'staff',
        'posts_per_page' => -1,
        "orderby" => "menu_order title",
        "order" => "ASC",
        "tax_query" => array(
            array(
                "taxonomy" => "staff-group",
                "field" => "slug",
                "terms" => $staffGroup->slug
            )
        )
    );

    $staff[$order] = ["title" => $staffGroup->name, "staffMembers" => get_posts($args)];
}

ksort($staff, SORT_NUMERIC);

get_template_part("/template-parts/headers/page-header", null, array("headline" => "Meet Our Team", "headerImg" => getDefaultFeaturedImage(true)));

foreach ($staff as $order => $group) : ?>

    <div class="<?php echo get_post_type(); ?>-category limit-width">
        <h2 class="<?php echo get_post_type(); ?>-category-title has-text-decoration has-primary-background-color-after">
            <?php echo $group['title']; ?>
        </h2>
        <div class="<?php echo get_post_type(); ?>-category-members">
            <?php foreach ($group['staffMembers'] as $post) : setup_postdata($post);
                get_template_part('/template-parts/cpts/staff/single/staff-member');
            endforeach; ?>
        </div>
    </div>

<?php
endforeach;
