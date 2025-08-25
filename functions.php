<?php

/**
 * alphonsus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package alphonsus
 */

require_once get_template_directory() . '/blocks/index.php';

$inc = get_template_directory() . "/inc";

foreach (glob("/$inc/*.php") as $file) {
    include_once $file;
}

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Check if ACF is installed and show an error message if not
 *
 * @return void
 */
function acfIsInstalled()
{
    if (is_admin() && (!function_exists('get_field') || !function_exists('have_rows'))) {
        setErrorNotice("There’s a problem with Advanced Custom Fields. It might not be installed");
        return false;
    }
    return true;
}

/**
 * Set an error message
 *
 * @param string $message
 * @return void
 */
function setErrorNotice($message = "")
{
    echo "<div class='error notice'>
        <p>$message</p>
    </div>";
}

function getDefaultPlaceholderImage()
{
    return get_template_directory_uri() . "/assets/img/alphonsus_placeholder.png";
}

function add_custom_class_to_buttons($block_content, $block)
{
    // Check if the block is a button block
    if ('core/button' === $block['blockName']) {
        // Add your custom class to the block
        $block_content = str_replace('wp-block-button__link', 'wp-block-button__link the-button', $block_content);
    }

    return $block_content;
}
add_filter('render_block', 'add_custom_class_to_buttons', 10, 2);

function custom_excerpt_length($excerpt)
{
    return wp_trim_words($excerpt, 50, '...');
}

add_filter('the_excerpt', 'custom_excerpt_length');

// require get_template_directory() . "/update-checker/plugin-update-checker.php";
// $MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
//     'https://hybrid-updates.diocesanweb.org/hybrids/alphonsus/theme.json', //Metadata URL.
//     __FILE__, //Full path to the main plugin file.
//     'alphonsus' //Plugin slug. Usually it's the same as the name of the directory.
// );


require get_template_directory() . "/update-checker/plugin-update-checker.php";

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/DiocesanInc/Alphonsus-2',
    __FILE__,
    'alphonsus'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('your-token-here');

function my_acf_prepare_field( $field ) {

    $pageID = get_option('page_on_front');
    if (get_field('cluster_style', $pageID) === 'slider') {
        return false;
    }
    return $field;
}

// Apply to fields named "mass_times_sections".
add_filter('acf/prepare_field/name=mass_times_sections', 'my_acf_prepare_field');
// Apply to field with key "field_61a917a7b95ea".
add_filter('acf/prepare_field/key=field_61a917a7b95ea', 'my_acf_prepare_field');