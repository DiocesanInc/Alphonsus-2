<?php

/**
 * Template part for displaying the mass times schedule on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */
?>

<div class="mass-times-schedule">
    <?php while (have_rows("mass_times_sections", "options")) : the_row();
        if (get_sub_field("show_section_on_homepage")) :

    ?>
            <div class="mass-times-sction">
                <h3 class="mass-times-section-title">
                    <?php the_sub_field("title"); ?>
                </h3>

                <div class="times">
                    <?php while (have_rows("times")) : the_row();
                        if (get_sub_field("show_on_homepage")) :
                    ?>

                            <div class="time">
                                <span class="day"><?php the_sub_field("day"); ?>:</span>
                                <span class="daytimes"><?php the_sub_field("day_times"); ?></span>
                                <?php if (get_sub_field("languages")) : ?>
                                    <span class="languages"><?php the_sub_field("languages"); ?></span>
                                <?php endif; ?>
                                <?php if (get_sub_field("additional_notes")) : ?>
                                    <span class="notes"><?php the_sub_field("additional_notes"); ?></span>
                                <?php endif; ?>
                            </div>
                    <?php endif;
                    endwhile; ?>
                </div>
            </div>
    <?php endif;
    endwhile; ?>
</div>