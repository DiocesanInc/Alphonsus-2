<?php

/**
 * Template Name: Mass Times
 *
 * The template for displaying the mass times Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();

$homepage_id = get_field("homepage_page_id", "options");
$bg_img = get_field("mass_times_bg_img", $homepage_id);
$bg_img_path = get_template_directory_uri() . "/assets/img/$bg_img.svg";

$bg = $bg_img ? "style='background-image:url($bg_img_path);'" : "";

?>

<div class="content-area" id="primary">
    <main class="site-main page-template-mass-times" id="main">
        <?php get_template_part('template-parts/headers/page-header'); ?>
        
        <div class="limit-width">
            <?php the_content(); ?>
        </div>

        <?php $pageID = get_option('page_on_front');
        if(get_field('cluster_style', $pageID) !== 'slider'):?>
        <div class="mass-times-schedule">
            <div class="limit-width grid-container">
                <?php while (have_rows("mass_times_sections", "options")) : the_row(); ?>
                    <div class="mass-times-sction">
                        <h2 class="mass-times-section-title has-text-decoration has-primary-background-color-after">
                            <?php the_sub_field("title"); ?>
                        </h2>

                        <div class="times">
                            <?php while (have_rows("times")) : the_row(); ?>
                                <div class="time">
                                    <div class="day">
                                        <strong>
                                            <?php the_sub_field("day"); ?>:
                                        </strong>
                                    </div>
                                    <span class="daytimes"><?php the_sub_field("day_times"); ?></span>
                                    <?php if (get_sub_field("languages")) : ?>
                                        <span class="languages"><?php the_sub_field("languages"); ?></span>
                                    <?php endif; ?>
                                    <?php if (get_sub_field("additional_notes")) : ?>
                                        <div class="notes"><?php the_sub_field("additional_notes"); ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php if ($bg_img) : ?>
                <div class="bg-img" <?php echo $bg; ?>></div>
            <?php endif; ?>

        </div>
        <?php endif;?>
    </main>
</div>

<?php get_footer();
