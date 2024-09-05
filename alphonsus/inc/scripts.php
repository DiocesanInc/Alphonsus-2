<?php

/**
 * Enqueue scripts and styles.
 */
function alphonsusScripts()
{
    /**
     * Slick Slider Lib
     */
    $file = get_template_directory_uri() . "/assets/slick-slider/slick.min.js";
    wp_enqueue_script('slick-lib', $file, array("jquery"), "1.8.1", false);

    /**
     * jQuery UI
     */
    $jqui_v = getField("jqui_v", "options", true, "1.12.1");

    wp_enqueue_script(
        'jquery-ui',
        "https://ajax.googleapis.com/ajax/libs/jqueryui/$jqui_v/jquery-ui.min.js",
        array('jquery'),
        $jqui_v
    );


    foreach (glob(get_template_directory() . "/assets/js/*.js") as $file) {
        $filename = substr($file, strrpos($file, '/') + 1);

        $hash = filemtime($file);

        wp_enqueue_script($filename, get_template_directory_uri() . "/assets/js/$filename", array("jquery"), $hash, false);
    }
}
add_action('wp_enqueue_scripts', 'alphonsusScripts', 10);
