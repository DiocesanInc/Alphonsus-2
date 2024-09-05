<?php

function acf_gallery()
{
    return array(
        array(
            'key' => 'field_623c89b279aaa',
            'label' => 'Gallery',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        ),
        array(
            'key' => 'field_623c8b85e2b8c',
            'label' => 'Heading',
            'name' => 'gallery_heading',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '25',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => 40,
        ),
        array(
            'key' => 'field_623c89ce79aab',
            'label' => 'Gallery Shortcode',
            'name' => 'gallery_shortcode',
            'type' => 'text',
            'instructions' => '*Get the shortcode from <a href="edit.php?post_type=envira">here</a>',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '25',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '[envira-gallery id="356"]',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
    );
}