<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package alphonsus
 */

get_header();

$hasPageHeader = true;

if (get_post_type() === "post") :

    $hasPageHeader = get_field("show_page_header");

endif;

?>
<div class="content-area" id="primary" data-has-page-header="<?php echo $hasPageHeader ? "true" : "false"; ?>">
    <main id="primary" class="site-main entry-content single single-<?php echo get_post_type(); ?>">
        <?php if (get_post_type() === "post") :

            if ($hasPageHeader) :

                $headerImg = getField("default_post_featured_image", "options", true, get_field("default_featured_image", "options"));

                get_template_part('template-parts/headers/page-header', null, array("headerImg" => $headerImg, "headline" => "News Article"));

            endif;

            elseif(get_post_type() === "staff") : 

                get_template_part('template-parts/headers/page-header', null, array("headerImg" => get_field("default_featured_image", "options"), "headline" => "Staff Member"));

        else :

            get_template_part('template-parts/headers/page-header');

        endif; ?>
        <div class="single-container limit-width">

            <?php while (have_posts()) : the_post();
                if (get_post_type() === 'staff') :
                    get_template_part('template-parts/cpts/staff/single/staff', "biography");
                elseif (get_post_type() === "ministry") :
                    get_template_part('template-parts/cpts/ministries/singles/single', "ministry");
                elseif (get_post_type() === "post") :
                    get_template_part('template-parts/content', "post");
                else :
                    get_template_part("template-parts/content");
                endif;
            endwhile; ?>
        </div>
    </main><!-- #main -->
</div>
<?php
get_footer();