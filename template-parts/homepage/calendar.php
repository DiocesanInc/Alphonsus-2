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
$grouped_calendars = function_exists('get_grouped_calendars')
    ? get_grouped_calendars($calendar)
    : [];
?>

<?php if ($show && $calendar) : ?>
    <div class="calendar-container limit-width" data-simcal-filter-root>
        <?php if (get_field("calendar_heading")) : ?>
            <h2 class="calendar-heading has-text-decoration text-decoration-is-centered has-tertiary-background-color-after">
                <?php the_field("calendar_heading"); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($grouped_calendars)) : ?>
            <div class="calendar-filters" aria-label="Calendar filters">
                <?php foreach ($grouped_calendars as $grouped_calendar) : ?>
                    <?php $filter_id = 'calendar-filter-' . $grouped_calendar['id']; ?>
                    <div class="calendar-filter">
                        <label class="calendar-filter__label" for="<?php echo esc_attr($filter_id); ?>">
                            <input class="calendar-filter__input" id="<?php echo esc_attr($filter_id); ?>" type="checkbox"
                                value="<?php echo esc_attr($grouped_calendar['id']); ?>" checked>
                            <span class="calendar-filter__text"><?php echo esc_html($grouped_calendar['title']); ?></span>
                            <span class="calendar-filter__dot"
                                style="--calendar-color: <?php echo esc_attr($grouped_calendar['color']); ?>;"></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="calendar-inner">
            <?php echo $calendar; ?>
            <div class="calendar-weekday-slick"></div>
            <div class="simcal-default-calendar-list calendar-event-slick"></div>
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
