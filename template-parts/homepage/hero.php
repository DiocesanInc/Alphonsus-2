<?php

/**
 * Template part for displaying the hero on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$hero = get_field("is_video") ? "video" : "image";
get_template_part("template-parts/homepage/hero", $hero);
