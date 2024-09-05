<?php

/**
 * Template Name: Tabs
 *
 * The template for displaying the tabs Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();

$id = get_the_ID();

$has_children = !empty(get_children(array("post_parent" => $id, "post_type" => "page"))); //check if post has children

$has_parent = has_post_parent();

$container_classes = array();



if ($has_parent) {
    $container_classes[] = "tab-child";
    $parent_id = wp_get_post_parent_id($id);
} else {
    $parent_id = $id;
}

if ($has_children) {
    $container_classes[] = "tab-parent";
    $parent_id = $id;
}

$container_classes = implode(" ", $container_classes);

$siblings = get_children(
    array(
        "post_parent" => $parent_id,
        "orderby" => "menu_order",
        "order" => "ASC",
        "post_type" => "page"
    )
);

$headline = get_the_title();
?>

<div class="content-area" id="primary">
    <main class="site-main page-template-tabs" id="main">
        <?php get_template_part('template-parts/headers/page-header', null, array("headline" => $headline)); ?>

        <div class="content">

            <div class="tabs-container <?php echo $container_classes; ?>">
                <?php foreach ($siblings as $sibling) : ?>
                    <?php $active = $id === $sibling->ID ? " active" : "";

                    ?>

                    <div class="tab-wrapper">
                        <a href="<?php the_permalink($sibling->ID); ?>" class="tab-link<?php echo $active; ?>" title="<?php echo $sibling->post_title; ?>">
                            <?php echo $sibling->post_title; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>


            <div class="limit-width">
                <?php the_content(); ?>
            </div>
        </div>
    </main>
</div>

<?php get_footer();
