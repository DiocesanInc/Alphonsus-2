<?php

function acf_news()
{
    return array(
        array(
            'key' => 'field_619e4b8e20523',
            'label' => 'News',
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
            'key' => 'field_65cbe3f2d5d4f',
            'label' => 'Show News?',
            'name' => 'show_news',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '10',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 1,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'ui' => 1,
        ),
        array(
            'key' => 'field_65e6341f8feff',
            'label' => 'Position',
            'name' => 'news_position',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '*Choose whether the news show up next to the calendar or below',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65cbe3f2d5d4f',
                        'operator' => '==',
                        'value' => '1',
                    ),
                    array(
                        'field' => 'field_65cbe435d5d51',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '40',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 1,
            'ui_on_text' => 'Next to the calendar',
            'ui_off_text' => 'Below the calendar',
            'ui' => 1,
        ),
        array(
            'key' => 'field_61ead174d187a',
            'label' => 'News Category',
            'name' => 'news_category',
            'type' => 'taxonomy',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65cbe3f2d5d4f',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'taxonomy' => 'category',
            'field_type' => 'select',
            'allow_null' => 1,
            'add_term' => 0,
            'save_terms' => 0,
            'load_terms' => 0,
            'return_format' => 'id',
            'multiple' => 0,
        ),
    );
}
