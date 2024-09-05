<?php

/**
 * The template for displaying Category Archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();
?>



<div class="content-area" id="primary">
    <main class="site-main" id="main">
        <?php get_template_part('template-parts/headers/page-header', null, array("headerImg" => getDefaultFeaturedImage(true), "headline" => get_queried_object()->name)); ?>
        <div class="entry-content limit-width">
            <div class="result-container">
                <?php echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="6" category="' . get_queried_object()->slug . '" loading_style="infinite ring" orderby="date" order="DESC"]'); ?>
            </div>
        </div>
    </main>
</div>

<?php get_footer();
