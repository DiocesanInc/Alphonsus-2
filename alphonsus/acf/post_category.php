<?php

acf_add_local_field_group(array(
    'key' => 'group_66db1ae6a0221',
    'title' => 'Post Category',
    'fields' => array(
        array(
            'key' => 'field_66db1ae7f6065',
            'label' => 'Single Article Title',
            'name' => 'single_article_title',
            'aria-label' => '',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'the_title' => 'Post Title',
                'news-article' => 'News Article',
                'event' => 'Event',
                'blogpost' => 'Blog Post',
            ),
            'default_value' => false,
            'return_format' => 'label',
            'multiple' => 0,
            'allow_null' => 0,
            'allow_in_bindings' => 0,
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'category',
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
));
