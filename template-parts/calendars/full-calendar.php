<?php

/**
 * Template part for displaying a full calendar page.
 *
 * @package alphonsus
 */

$calendar = $args['calendar'] ?? '';
$context = $args['context'] ?? 'full-calendar';
$grouped_calendars = function_exists('get_grouped_calendars')
    ? get_grouped_calendars($calendar)
    : [];
?>

<?php if ($calendar) : ?>
    <section class="calendar-full-container limit-width" data-simcal-filter-root>
        <?php if (!empty($grouped_calendars)) : ?>
            <div class="calendar-filters" aria-label="Calendar filters">
                <?php foreach ($grouped_calendars as $grouped_calendar) : ?>
                    <?php $filter_id = $context . '-filter-' . $grouped_calendar['id']; ?>
                    <div class="calendar-filter">
                        <label class="calendar-filter__label" for="<?php echo esc_attr($filter_id); ?>">
                            <input
                                class="calendar-filter__input"
                                id="<?php echo esc_attr($filter_id); ?>"
                                type="checkbox"
                                value="<?php echo esc_attr($grouped_calendar['id']); ?>"
                                checked>
                            <span class="calendar-filter__text"><?php echo esc_html($grouped_calendar['title']); ?></span>
                            <span
                                class="calendar-filter__dot"
                                style="--calendar-color: <?php echo esc_attr($grouped_calendar['color']); ?>;"></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="calendar-full-inner">
            <?php echo $calendar; ?>
        </div>
    </section>
<?php endif; ?>
