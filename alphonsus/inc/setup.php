<?php

if (!function_exists('alphonsus_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function alphonsus_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on alphonsus, use a find and replace
		 * to change 'alphonsus' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('alphonsus', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'alphonsus'),
                'quicklinks' => esc_html__('Quick Links', 'alphonsus'),
                'footer-quicklinks' => esc_html__('Footer Quicklinks', 'alphonsus'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'alphonsus_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        add_image_size("bgImgPreview", 80, 40, false);
        add_image_size("homepagePost", 700, 400, false);
    }
endif;
add_action('after_setup_theme', 'alphonsus_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function alphonsus_content_width()
{
    $GLOBALS['content_width'] = apply_filters('alphonsus_content_width', 640);
}
add_action('after_setup_theme', 'alphonsus_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function alphonsus_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'alphonsus'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'alphonsus'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'alphonsus_widgets_init');

function remove_editor()
{
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        switch ($template) {
            case 'templates/page-homepage.php':
                // the below removes 'editor' support for 'pages'
                // if you want to remove for posts or custom post types as well
                // add this line for posts:
                // remove_post_type_support('post', 'editor');
                // add this line for custom post types and replace
                // custom-post-type-name with the name of post type:
                // remove_post_type_support('custom-post-type-name', 'editor');
                remove_post_type_support('page', 'editor');
                remove_post_type_support('page', 'thumbnail');
                break;
            default:
                // Don't remove any other template.
                break;
        }
    }
}
add_action('init', 'remove_editor');

if (!function_exists('colors_setup') && function_exists("get_field")) {
    function colors_setup()
    {
        // Disable Custom Colors
        // add_theme_support( 'disable-custom-colors' );

        // Editor Color Palette
        $colors = array(
            'Primary'    => get_field('primary_color', 'options')["color"],
            'Secondary'  => get_field('secondary_color', 'options')["color"],
            'Tertiary'   => get_field('tertiary_color', 'options')["color"],
            'Quaternary' => get_field('quaternary_color', 'options')["color"],
            'Black'      => '#111111',
            'White'      => '#FFFFFF'
        );

        foreach ($colors as $color => $rgb) {
            $palette[] = array(
                'name'  => $color,
                'slug'  => strtolower($color),
                'color' => $rgb
            );
        }

        add_theme_support('editor-color-palette', $palette);
    }
    add_action('after_setup_theme', 'colors_setup');
}

/**
 * Limit Menu Items in Footer Menus
 */
add_filter('wp_nav_menu_objects', 'limit_menu_items', 10, 2);
function limit_menu_items($items, $args)
{
    // limit footer top menu to 4 items
    if ($args->theme_location == 'footer-quicklinks-top') {
        $toplinks = 0;
        foreach ($items as $k => $v) {
            if ($v->menu_item_parent == 0) {
                // count how many top-level links we have so far...
                $toplinks++;
            }
            // if we've passed our max # ...
            if ($toplinks > 4) {
                unset($items[$k]);
            }
        }
    }

    // limit footer bottom menu & header quicklinks menu to 6 items
    if ($args->theme_location == 'footer-quicklinks-bottom' || $args->theme_location == 'quicklinks') {
        $toplinks = 0;
        foreach ($items as $k => $v) {
            if ($v->menu_item_parent == 0) {
                // count how many top-level links we have so far...
                $toplinks++;
            }
            // if we've passed our max # ...
            if ($toplinks > 6) {
                unset($items[$k]);
            }
        }
    }
    return $items;
}
