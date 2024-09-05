<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();
?>

<main id="primary" class="site-main archive content-area">

    <?php switch (get_post_type()):
        case "staff":

            get_template_part("/template-parts/cpts/staff/archive/staff", "archive");

            break;

        default:
            $headline = get_the_category()[0]->cat_name;
            $archivePath = "template-parts/content";


            if (have_posts()) :

                get_template_part("/template-parts/headers/page-header", null, array("headerImg" => get_field("default_featured_image", "options"), "headline" => $headline)); ?>

                <div class="grid-container">
                    <?php

                    $sticky = get_option('sticky_posts');

                    if ($sticky) :
                        $query = new WP_Query('p=' . $sticky[0]);

                        /* Start the Loop */
                        while ($query->have_posts()) : $query->the_post();

                            /*
                    * Include the Post-Type-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                    */
                            get_template_part($archivePath, "archive");

                        endwhile;

                    endif;

                    $query = new WP_Query(array('post__not_in' => get_option('sticky_posts'), "order_by" => "menu_order", "order" => "ASC"));

                    /* Start the Loop */
                    while ($query->have_posts()) : $query->the_post();

                        /*
                    * Include the Post-Type-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                    */
                        get_template_part($archivePath, "archive");

                    endwhile; ?>
                </div>



    <?php the_posts_navigation();

            else :

                get_template_part('template-parts/content', 'none');

            endif;

    endswitch;
    ?>


</main><!-- #main -->

<?php
get_footer();
