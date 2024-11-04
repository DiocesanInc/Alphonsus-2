<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://gmpg.org/xfn/11" rel="profile">
    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="<?php bloginfo("name"); ?> <?php bloginfo("description"); ?>" />
    <meta property="og:url" content="<?= esc_url(get_permalink()); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= wp_strip_all_tags(get_the_title()); ?>" />
    <meta property="og:description" content="<?= wp_strip_all_tags(get_the_excerpt()); ?>" />
    <meta property="og:image:secure_url" content="<?= get_the_post_thumbnail_url(); ?>" />
    <meta property="og:image" content="<?= str_replace("https://", "http://", get_the_post_thumbnail_url()); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">