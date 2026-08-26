<?php

if (!function_exists('get_grouped_calendars')) {
    /**
     * Get the rendered Simple Calendar post ID from its wrapper markup.
     *
     * @param string $calendar_markup
     * @return int
     */
    function alphonsus_get_rendered_calendar_id($calendar_markup)
    {
        if (
            !is_string($calendar_markup)
            || !preg_match('/\bdata-calendar-id=(["\'])(\d+)\1/i', $calendar_markup, $matches)
        ) {
            return 0;
        }

        return absint($matches[2]);
    }

    /**
     * Get the calendars selected by a Simple Calendar grouped feed.
     *
     * @param int $grouped_calendar_id
     * @return int[]
     */
    function alphonsus_get_grouped_calendar_member_ids($grouped_calendar_id)
    {
        $source = get_post_meta($grouped_calendar_id, '_grouped_calendars_source', true);

        if ('ids' === $source) {
            $calendar_ids = get_post_meta($grouped_calendar_id, '_grouped_calendars_ids', true);

            return array_values(array_unique(array_filter(array_map('absint', (array) $calendar_ids))));
        }

        if ('category' === $source) {
            $category_ids = get_post_meta($grouped_calendar_id, '_grouped_calendars_category', true);
            $category_ids = array_values(array_unique(array_filter(array_map('absint', (array) $category_ids))));

            if (empty($category_ids)) {
                return [];
            }

            return array_map('absint', get_posts([
                'post_type' => 'calendar',
                'post_status' => 'publish',
                'numberposts' => -1,
                'fields' => 'ids',
                'tax_query' => [[
                    'taxonomy' => 'calendar_category',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                ]],
            ]));
        }

        return [];
    }

    /**
     * Return calendar posts that belong to the rendered grouped calendar.
     *
     * The grouped feed's configured members are authoritative. The ACF
     * "grouped_calendar" field only enables identifying color settings and
     * must not add a calendar to every grouped feed.
     *
     * @param string $calendar_markup
     * @return array<int, array<string, mixed>>
     */
    function get_grouped_calendars($calendar_markup = '')
    {
        if (!function_exists('get_field')) {
            return [];
        }

        $grouped_calendar_id = alphonsus_get_rendered_calendar_id($calendar_markup);

        if ($grouped_calendar_id) {
            $calendar_ids = alphonsus_get_grouped_calendar_member_ids($grouped_calendar_id);
        } else {
            // Without a rendered group context, return every color-enabled
            // calendar so the shared inline color rules can still be built.
            $calendar_ids = get_posts([
                'post_type' => 'calendar',
                'post_status' => 'publish',
                'numberposts' => -1,
                'fields' => 'ids',
            ]);
        }

        $grouped_calendars = [];
        foreach ($calendar_ids as $id) {
            $id = absint($id);

            if (!$id || (!$grouped_calendar_id && !get_field('grouped_calendar', $id))) {
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
