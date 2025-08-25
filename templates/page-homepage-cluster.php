<?php

/**
 * Template Name: Homepage Cluster
 *
 * The template for displaying the Homepage Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();

$add_wrapper = false;
$skip = false;

?>

<div class="content-area" id="primary">
    <main class="site-main page-template-homepage" id="main">
        <?php get_template_part("template-parts/homepage/hero"); ?>
        <?php get_template_part("template-parts/homepage/welcome"); ?>
        <?php get_template_part("template-parts/homepage/featured_buttons"); ?>
        <?php get_template_part("template-parts/homepage/parishes"); ?>
        
        <?php

        // if (have_rows("section_order", "options")) :

        //     //iterate through the sections set in the template settings
        //     while (have_rows("section_order", "options")) : the_row();

        //         //get section name
        //         $section = get_sub_field("section");

        //         if($section === 'welcome' || $section === 'featured_buttons' || $section === 'parishes'):
        //             continue;
        //         else:
        //             //determine if we need to wrap the next two sections
        //             //(calendar and news)
        //             $add_wrapper =
        //                 get_field("show_news") &&       //if news section is displayed
        //                 get_field("show_calendar") &&   //if calendar section is displayed
        //                 get_field("news_position") &&   //if news section is next to calendar
        //                 $section === "calendar";        //if current section is calendar

        //             $section = $add_wrapper ? "cols" : $section;    //add cols section instead

        //             $args = $add_wrapper ? array("calendar", "news") : null;

        //             if($section === 'mass_times'):
        //                 $style = get_field('cluster_style');
        //                 if($style != 'slider'):
        //                     get_template_part("template-parts/homepage/mass_times"); 
        //                 else: endif;
        //             else:
        //                 //check if section needs to be skipped
        //                 //(if calendar and news are next to each other, news needs to be skipped
        //                 //so it doesn't appear twice)
        //                 if (!$skip) :
        //                     //load template
        //                     get_template_part("template-parts/homepage/$section", null, $args);
        //                 else :
        //                     //set skip to false, to not skip more than needed
        //                     $skip = false;
        //                 endif;

        //                 //check if during the next iteration a section has to be skipped
        //                 $skip = $add_wrapper ? true : false;
        //             endif;
        //         endif;
        //     endwhile;

        // else : ?>
        <?php $style = get_field('cluster_style');
                if($style != 'slider'): ?>
            <?php get_template_part("template-parts/homepage/mass_times"); ?>
        <?php else: endif;?>
        <?php get_template_part("template-parts/homepage/content_slider"); ?>
        <?php 
            $add_wrapper =
                get_field("show_news") &&       //if news section is displayed
                get_field("show_calendar") &&   //if calendar section is displayed
                get_field("news_position");   //if news section is next to calendar
        ?>
        <?php if($add_wrapper):
                get_template_part("template-parts/homepage/cols", null, array("calendar", "news")); 
                else: 
                get_template_part("template-parts/homepage/calendar");
                get_template_part("template-parts/homepage/news"); 
                endif;?>
                 
        <?php //endif; ?> 
    </main>
</div>

<?php get_footer();
