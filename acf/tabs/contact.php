<?php

function acf_contact()
{
    return array(
        array(
            'key' => 'field_6182f74e311d9',
            'label' => 'Contact Form',
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
            'key' => 'field_623cb1cbaac8a',
            'label' => 'Heading',
            'name' => 'contact_form_heading',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '20',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => 20,
        ),
        array(
            'key' => 'field_623caf0119d35',
            'label' => 'Contact Form',
            'name' => 'contact_form',
            'type' => 'forms',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '20',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'post_object',
            'allow_null' => 0,
            'multiple' => 0,
        ),
    );
}