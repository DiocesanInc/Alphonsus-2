<?php

// setErrorNotice("test");
// setErrorNotice(filemtime(get_template_directory_uri() . "/style.css"));


function getCustomStylesFilename()
{
    $blog_id = get_current_blog_id();
    $theme = wp_get_theme()->get_template();
    $prefix = $theme . "_" . $blog_id;
    return "$prefix-custom-variables.css";
}

function alphonsusStyles()
{
    /**
     * Slick
     */
    $file = get_template_directory_uri() . "/assets/slick-slider/slick.css";
    wp_enqueue_style('slick-styles', $file, array(), "1.8.1", "screen");
    $file = get_template_directory_uri() . "/assets/slick-slider/slick-theme.css";
    wp_enqueue_style('slick-theme', $file, array(), "1.8.1", "screen");
    /**
     * Font Awesome
     */
    $fa_v = getField("fa_v", "options", true, "6.5.1");
    $file = "https://use.fontawesome.com/releases/v$fa_v/css/all.css";
    wp_enqueue_style('font-awesome', $file, array(), "$fa_v", "screen");

    $jqui_v = getField("jqui_v", "options", true, "1.12.1");
    wp_enqueue_style(
        "jquery-ui-css",
        "https://code.jquery.com/ui/$jqui_v/themes/base/jquery-ui.css",
        array(),
        $jqui_v,
        "screen"
    );

    /**
     * Style.css
     */
    $file = get_template_directory_uri() . "/style.css";
    $path = get_template_directory() . "/style.css";
    $hash = filemtime($path);
    wp_enqueue_style('main-styles', $file, array(), $hash, "screen");

    /**
     * Ministry Lightbox Contact Form Styles
     */
    wp_enqueue_style(
        "ministryContactForm",
        get_template_directory_uri() . "/assets/css/ministry-contact-form.css",
        array(),
        "1",
        "screen"
    );

    /**
     * Envira Styles
     */
    wp_enqueue_style(
        "envira",
        get_template_directory_uri() . "/assets/css/envira.css",
        array(),
        "1",
        "screen"
    );

    /**
     * custom emergency alert
     */
    wp_enqueue_style(
        "dpi-emergency-alert",
        get_template_directory_uri() . "/assets/css/emergency-alert.css",
        array(),
        "1",
        "screen"
    );
}

add_action('wp_enqueue_scripts', 'alphonsusStyles', 9);

add_action(
    "acf/save_post",
    function () {
        if (acfIsInstalled()) {
            include_once get_template_directory() . "/assets/scss/custom/variables/custom-variables.php";
        }
    }
);

add_action('after_setup_theme', "addEditorStylesThemeSupport");

function addEditorStylesThemeSupport()
{
    add_theme_support('editor-styles');
}

add_action('admin_init', "addEditorCustomVariables");

function addEditorCustomVariables()
{
    if (class_exists("CssHelper")) {
        $url = CssHelper::css_get_plugin_dir_url();
        $path = CssHelper::css_get_plugin_dir_path();
        $filename  = getCustomStylesFilename();
        $custom_variables_path = $path . "css-helper/$filename";
        $custom_variables_url = $url . "css-helper/$filename";


        if (file_exists($custom_variables_path)) {
            add_editor_style($custom_variables_url);
        }
    } else {

        add_editor_style(get_template_directory_uri() . '/custom-variables.css');
    }
    add_editor_style(get_template_directory_uri() . '/style.css');
}
function addEditorStyles()
{
    wp_enqueue_style("editor-styles", get_template_directory_uri() . '/assets/scss/backend-styles/editor.css');
}

add_action('admin_enqueue_scripts', "addEditorStyles", 999);
