<?php

acf_add_local_field_group(array(
    'key' => 'group_69cbf5640bf68',
    'title' => 'Ministry',
    'fields' => array(
        array(
            'key' => 'field_69cbf568cd36e',
            'label' => 'Page Header Image',
            'name' => 'ministry_page_header_image',
            'aria-label' => '',
            'type' => 'image',
            'instructions' => '*Set a different picture for the ministry\'s page header',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
            'allow_in_bindings' => 0,
            'preview_size' => 'medium',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'ministry',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'display_title' => '',
));
