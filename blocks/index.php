<?php

/**
 * The following registers custom ACF Blocks.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @package dpiChild
 */

if (!function_exists('acf_init_blocks')) {
    function acf_init_blocks()
    {
        // verify register function exists
        if (function_exists('acf_register_block')) {
            /* comment out any blocks to omit */
            $blocks = [
                'accordion',
                'image-banner',
                'image-button',
            ];

            foreach ($blocks as $block) {
                require_once "registration/$block.php"; // register block
            }
        }
    }

    add_action("acf/init", "acf_init_blocks", 5);
}

function acf_block_render_callback($block)
{
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "blocks/render" folder
    if (file_exists(get_theme_file_path("/blocks/render/{$slug}.php"))) {
        include get_theme_file_path("/blocks/render/{$slug}.php");
    }
}