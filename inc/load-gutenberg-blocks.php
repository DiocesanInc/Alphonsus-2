<?php

add_action(
    "enqueue_block_editor_assets",
    "enqueue_block_editor_assets"
);

function enqueue_block_editor_assets()
{

    $block_path = "/assets/gutenberg-blocks";

    $block_folders = array_filter(glob(get_template_directory() . "$block_path/*"), 'is_dir');

    foreach ($block_folders as $folder) {
        $block_name = basename($folder);
        $uri = get_stylesheet_directory_uri() . "$block_path/$block_name/";
        $path = get_stylesheet_directory() . "$block_path/$block_name/";
        $css_file = $block_name . "_editor.css";
        $js_file = "$block_name.js";
        // Enqueue CSS file if it exists
        if (file_exists($path . $css_file)) {
            wp_enqueue_style('block-' . $block_name . '-editor-styles', $uri . $css_file, array(), filemtime($path . $css_file));
        }

        // Enqueue JS file if it exists
        if (file_exists($path . $js_file)) {
            wp_enqueue_script('block-' . $block_name . '-editor-script', $uri . $js_file, array('jquery'), filemtime($path . $js_file), true);
        }
    }
}
