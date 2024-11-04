<?php

/**
 * Template part for displaying the ministry archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

if (get_field("ministry_is_slider")) {
    get_template_part("template-parts/cpts/ministries/archive/ministry", "slider");
} else {
    get_template_part("template-parts/cpts/ministries/archive/ministry", "funnel");
}
