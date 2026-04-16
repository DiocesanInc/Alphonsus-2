<?php

/**
 * Template Name: Calendar
 *
 * Full calendar page template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();

$calendar = get_field('page_calendar');
?>

<div class="content-area" id="primary">
    <main class="site-main page-template-calendar" id="main">
        <?php get_template_part('template-parts/headers/page-header'); ?>

        <?php if (get_the_content()) : ?>
            <div class="limit-width">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>

        <?php
        get_template_part(
            'template-parts/calendars/full-calendar',
            null,
            array(
                'calendar' => $calendar,
                'context' => 'page-calendar-' . get_the_ID(),
            )
        );
        ?>
    </main>
</div>

<?php get_footer();
