<?php

function acf_calendar()
{
    return array(
        array(
            'key' => 'field_626aca39f562b',
            'label' => 'Calendar',
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
            'key' => 'field_65cbe435d5d51',
            'label' => 'Show Calendar?',
            'name' => 'show_calendar',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '20',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'ui' => 1,
        ),
        array(
            'key' => 'field_65cbe435d5d51123',
            'label' => 'Heading',
            'name' => 'calendar_heading',
            'type' => 'text',
            'instructions' => '*Max. 25 characters',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65cbe435d5d51',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '20',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => 'Upcoming Events',
            'prepend' => '',
            'append' => '',
            'maxlength' => '25',
        ),
        array(
            'key' => 'field_626aca56f562c',
            'label' => 'Calendar',
            'name' => 'calendar',
            'type' => 'simple_calendar',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65cbe435d5d51',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '20',
                'class' => '',
                'id' => '',
            ),
            'allow_null' => 1,
        ),
        array(
            'key' => 'field_65d76de1ad750',
            'label' => 'Link to full calendar',
            'name' => 'calendar_link',
            'aria-label' => '',
            'type' => 'link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65cbe435d5d51',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '20',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
        ),
    );
}
