<?php

function acf_testimonials()
{
    return array(
        array(
            'key' => 'field_626aca64f562d',
            'label' => 'Testimonials',
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
            'key' => 'field_626aca6ff562e',
            'label' => 'Heading',
            'name' => 'testimonials_heading',
            'type' => 'text',
            'instructions' => '*Max 30 characters',
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
            'maxlength' => 30,
        ),
        array(
            'key' => 'field_626aca8df562f',
            'label' => 'Testimonials',
            'name' => 'testimonials',
            'type' => 'post_object',
            'instructions' => 'Choose specific testimonials to show, or leave empty to show all ordered by newest to oldest',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => 'testimonial',
            'taxonomy' => '',
            'allow_null' => 0,
            'multiple' => true,
            'return_format' => 'object',
            'ui' => 1,
        ),
    );
}