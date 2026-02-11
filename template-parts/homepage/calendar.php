<?php

/**
 * Template part for displaying the calendar on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$show = getField("show_calendar", false,  false, false);
$calendar = get_field("calendar");
?>

<?php if ($show && get_field("calendar")) : ?>
    <div class="calendar-container limit-width">
        <?php if (get_field("calendar_heading")) : ?>
            <h2 class="calendar-heading has-text-decoration text-decoration-is-centered has-tertiary-background-color-after">
                <?php the_field("calendar_heading"); ?>
            </h2>
        <?php endif; ?>

        <div class="calendar-inner">
            <?php echo get_field("calendar"); ?>
            <div class="calendar-weekday-slick"></div>
            <div class="calendar-event-slick"></div>
        </div>

        <?php if (get_field("calendar_link")) : ?>
            <div class="view-all-link-wrapper">
                <?php $link = get_field("calendar_link")["url"] ?? ''; ?>
                <?php $title = get_field("calendar_link")["title"] ?? ''; ?>
                <a class="the-button" href="<?php echo $link; ?>">
                    <?php echo $title; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>