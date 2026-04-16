<?php
// exit if accessed directly
if (!defined('ABSPATH')) exit;

// check if class already exists
if (!class_exists('acf_field_theme_colors')) :

    class acf_field_theme_colors extends acf_field
    {
        /**
         * Controls field type visibilty in REST requests.
         *
         * @var bool
         */
        public $show_in_rest = true;

        /**
         * Environment values relating to the theme or plugin.
         *
         * @var array $env Plugin or theme context such as 'url' and 'version'.
         */
        private $env;



        /**
         * Constructor.
         */
        public function __construct()
        {

            /**
             * Field type reference used in PHP and JS code.
             *
             * No spaces. Underscores allowed.
             */
            $this->name = 'theme_colors';

            /**
             * Field type label.
             *
             * For public-facing UI. May contain spaces.
             */
            $this->label = __('Theme Colors', 'TEXTDOMAIN');

            /**
             * The category the field appears within in the field type picker.
             */
            $this->category = 'advanced'; // basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME

            /**
             * Field type Description.
             *
             * For field descriptions. May contain spaces.
             */
            $this->description = __('Dropdown of theme colors', 'TEXTDOMAIN');

            $this->env = array(
                'url'     => site_url(str_replace(ABSPATH, '', __DIR__)), // URL to the acf-FIELD-NAME directory.
                'version' => '1.0', // Replace this with your theme or plugin version constant.
            );

            parent::__construct();
        }


        /**
         * Settings to display when users configure a field of this type.
         *
         * These settings appear on the ACF “Edit Field Group” admin page when
         * setting up the field.
         *
         * @param array $field
         * @return void
         */
        public function render_field_settings($field)
        {
            // Get theme colors for the dropdown
            $colors = $this->_get_theme_colors();
            $choices = array('' => '- Select Default -'); // Add empty option first

            // Convert colors array to format needed for choices
            foreach ($colors as $color) {
                $choices[$color['slug']] = $color['name'];
            }

            acf_render_field_setting($field, array(
                'label'         => __('Default Value', 'TEXTDOMAIN'),
                'instructions' => __('Select a default color', 'TEXTDOMAIN'),
                'type'         => 'select',
                'name'         => 'default_value',
                'choices'      => $choices
            ));
        }

        /**
         * HTML content to show when a publisher edits the field on the edit screen.
         *
         * @param array $field The field settings and values.
         * @return void
         */
        public function render_field($field)
        {
            $colors = $this->_get_theme_colors();
            $value = isset($field['value']) ? $field['value'] : $field['default_value'];

            if (preg_match('/^var\(--clr-([a-z0-9-]+)\)$/', (string) $value, $matches)) {
                $value = $matches[1];
            }


            //dropdown of colors
            echo '<select name="' . esc_attr($field['name']) . '" id="' . esc_attr($field['id']) . '">';

            foreach ($colors as $color) {
                $selected = selected($value, $color['slug'], false);

                echo '<option value="' . esc_attr($color['slug']) . '" ' . $selected . '>' . esc_html($color['name']) . '</option>';
            }

            echo '</select>';
        }

        /**
         * Load value from database
         */
        // public function load_value($value, $post_id, $field)
        // {
        //     error_log('Theme Colors load_value called with value: ' . print_r($value, true));
        //     return $value;
        // }

        /**
         * Update value in database
         */
        public function update_value($value, $post_id, $field)
        {
            if (preg_match('/^var\(--clr-([a-z0-9-]+)\)$/', (string) $value, $matches)) {
                $value = $matches[1];
            }

            $valid_slugs = array_map(function ($color) {
                return $color['slug'];
            }, $this->_get_theme_colors());

            // If value is not a valid color slug and allow_null is false, use default value
            if (!in_array($value, $valid_slugs, true) && empty($field['allow_null'])) {
                $value = $field['default_value'] ?? '';
            }

            return $value;
        }

        /**
         * Format the saved slug into a CSS variable for get_field().
         *
         * @param string $value
         * @param mixed  $post_id
         * @param array  $field
         * @return string
         */
        public function format_value($value, $post_id, $field)
        {
            if (empty($value)) {
                return $value;
            }

            foreach ($this->_get_theme_colors() as $color) {
                if ($value === $color['slug']) {
                    return 'var(--clr-' . $color['slug'] . ')';
                }

                if ($value === 'var(--clr-' . $color['slug'] . ')') {
                    return $value;
                }
            }

            return $value;
        }

        private function _get_theme_colors()
        {
            return [
                ['slug' => 'primary', 'name' => 'Primary'],
                ['slug' => 'secondary', 'name' => 'Secondary'],
                ['slug' => 'tertiary', 'name' => 'Tertiary'],
                ['slug' => 'quaternary', 'name' => 'Quaternary']
            ];
        }
    }

endif;

add_action('acf/include_field_types', 'include_acf_field_theme_colors');
add_action('init', 'include_acf_field_theme_colors');
/**
 * Registers the ACF field type.
 */
function include_acf_field_theme_colors($version = false)
{
    static $registered = false;

    if ($registered) {
        return;
    }

    if (! function_exists('acf_register_field_type')) {
        return;
    }

    acf_register_field_type('acf_field_theme_colors');
    $registered = true;
}
