<?php

if (!function_exists('get_grouped_calendars')) {
    /**
     * Returns calendar posts that are part of the grouped calendar UI.
     *
     * If rendered calendar markup is provided, prefer calendars that are
     * actually present in that markup and fall back to all grouped calendars.
     *
     * @param string $calendar_markup
     * @return array<int, array<string, mixed>>
     */
    function get_grouped_calendars($calendar_markup = '')
    {
        if (!function_exists('get_field')) {
            return [];
        }

        $calendar_ids = get_posts([
            'post_type' => 'calendar',
            'post_status' => 'publish',
            'numberposts' => -1,
            'fields' => 'ids',
        ]);

        $grouped_calendars = [];
        $calendars_in_markup = [];

        foreach ($calendar_ids as $id) {
            if (!get_field('grouped_calendar', $id)) {
                continue;
            }

            $color = get_field('color_palette', $id)
                ? get_field('calendar_color_theme', $id)
                : get_field('calendar_color_custom', $id);

            $calendar = [
                'id' => $id,
                'title' => get_the_title($id),
                'color' => $color ?: 'var(--clr-primary)',
            ];

            $grouped_calendars[] = $calendar;

            if (
                $calendar_markup
                && strpos($calendar_markup, "simcal-events-calendar-$id") !== false
            ) {
                $calendars_in_markup[] = $calendar;
            }
        }

        if ($calendar_markup !== '') {
            return $calendars_in_markup;
        }

        return $grouped_calendars;
    }
}

add_action('wp_enqueue_scripts', function () {
    $grouped_calendars = get_grouped_calendars();
    if (empty($grouped_calendars)) {
        return;
    }

    $css = '';

    foreach ($grouped_calendars as $calendar) {
        $id = (int) $calendar['id'];
        $color = $calendar['color'];

        if (!$color) {
            continue;
        }

        //List view
        $css .= ".simcal-default-calendar-list .simcal-event.simcal-events-calendar-$id .event-item {";
        $css .= "border-left: 10px solid $color; padding-left: 1rem;";
        $css .= "}";

        //Grid view
        $css .= ".simcal-default-calendar-grid .simcal-event.simcal-events-calendar-$id {";
        $css .= "border-left: 5px solid $color; padding-left: 1rem;";
        $css .= "}";

        //Mobile view
        $css .= ".simcal-default-calendar.simcal-event-bubble .simcal-event.simcal-events-calendar-$id {";
        $css .= "border-left: 7px solid $color; padding-left: 1rem;";
        $css .= "}";
    }

    wp_add_inline_style('main-styles', $css);
});