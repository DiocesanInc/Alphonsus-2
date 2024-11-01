<?php

function acf_content_slider()
{
    return array(
        array(
            'key' => 'field_65b94cff02fc5',
            'label' => 'Content Slider',
            'name' => '',
            'aria-label' => '',
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
            'key' => 'field_65b94e1d02fc8',
            'label' => 'Content Type',
            'name' => 'content_slider_content_type',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '*Choose whether you want to display posts or custom slides',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui_on_text' => 'Custom',
            'ui_off_text' => 'Posts',
            'ui' => 1,
        ),
        array(
            'key' => 'field_65b9507a52fc6',
            'label' => 'Populate posts automatically',
            'name' => 'content_slider_auto_posts',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '*Choose whether the last 3 posts of a certain category shall be displayed, or pick the posts yourself',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65b94e1d02fc8',
                        'operator' => '!=',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui_on_text' => 'Choose Category',
            'ui_off_text' => 'Choose Posts',
            'ui' => 1,
        ),
        array(
            'key' => 'field_65b94f0802fc9',
            'label' => 'Post Category',
            'name' => 'content_slider_taxonomy',
            'aria-label' => '',
            'type' => 'taxonomy',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65b94e1d02fc8',
                        'operator' => '!=',
                        'value' => '1',
                    ),
                    array(
                        'field' => 'field_65b9507a52fc6',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'taxonomy' => 'category',
            'add_term' => 1,
            'save_terms' => 0,
            'load_terms' => 0,
            'return_format' => 'id',
            'field_type' => 'checkbox',
            'bidirectional' => 0,
            'multiple' => 0,
            'allow_null' => 0,
            'bidirectional_target' => array(),
        ),
        array(
            'key' => 'field_65b950ed52fc9',
            'label' => 'Posts',
            'name' => 'content_slider_posts',
            'aria-label' => '',
            'type' => 'post_object',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65b94e1d02fc8',
                        'operator' => '!=',
                        'value' => '1',
                    ),
                    array(
                        'field' => 'field_65b9507a52fc6',
                        'operator' => '!=',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array(
                0 => 'post',
            ),
            'post_status' => array(
                0 => 'publish',
            ),
            'taxonomy' => '',
            'return_format' => 'object',
            'multiple' => 1,
            'allow_null' => 0,
            'bidirectional' => 0,
            'ui' => 1,
            'bidirectional_target' => array(),
        ),
        array(
            'key' => 'field_65b94d1202fc6',
            'label' => 'Items',
            'name' => 'content_slider_items',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65b94e1d02fc8',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'table',
            'pagination' => 0,
            'min' => 0,
            'max' => 0,
            'collapsed' => '',
            'button_label' => 'Add Row',
            'rows_per_page' => 20,
            'sub_fields' => array(
                array(
                    'key' => 'field_65b94ffd02fcc',
                    'label' => 'Heading',
                    'name' => 'heading',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '*Max 20 characters',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => 20,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'parent_repeater' => 'field_65b94d1202fc6',
                ),
                array(
                    'key' => 'field_65b9500602fcd',
                    'label' => 'Subheading',
                    'name' => 'subheading',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '*Max 30 characters',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => 30,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'parent_repeater' => 'field_65b94d1202fc6',
                ),
                array(
                    'key' => 'field_65b9503a02fce',
                    'label' => 'Text',
                    'name' => 'text',
                    'aria-label' => '',
                    'type' => 'textarea',
                    'instructions' => '*Max 100 characters',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => 100,
                    'rows' => 3,
                    'placeholder' => '',
                    'new_lines' => '',
                    'parent_repeater' => 'field_65b94d1202fc6',
                ),
                array(
                    'key' => 'field_65b9505402fcf',
                    'label' => 'Link',
                    'name' => 'link',
                    'aria-label' => '',
                    'type' => 'link',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'parent_repeater' => 'field_65b94d1202fc6',
                ),
                array(
                    'key' => 'field_65b962fd8d1f8',
                    'label' => 'Background Image',
                    'name' => 'background_image',
                    'aria-label' => '',
                    'type' => 'image',
                    'instructions' => '',
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
                    'preview_size' => 'medium',
                    'parent_repeater' => 'field_65b94d1202fc6',
                ),
            ),
        ),
        array(
            'key' => 'field_65b95435bd061',
            'label' => 'Alignment',
            'name' => 'content_slider_alignment',
            'aria-label' => '',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '33',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ),
            'default_value' => false,
            'return_format' => 'value',
            'multiple' => 0,
            'allow_null' => 0,
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
        ),
        array(
            'key' => 'field_65b94f6602fca',
            'label' => 'Styling',
            'name' => 'content_slider_style',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '33',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 1,
            'ui_on_text' => 'Colored Background',
            'ui_off_text' => 'No Background',
            'ui' => 1,
        ),
        array(
            'key' => 'field_65b94f9e02fcb',
            'label' => 'Color',
            'name' => 'content_slider_background_color',
            'aria-label' => '',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_65b94f6602fca',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '33',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'var(--clr-primary-st)' => 'Primary',
                'var(--clr-secondary-st)' => 'Secondary',
                'var(--clr-tertiary-st)' => 'Tertiary',
                'var(--clr-quaternary-st)' => 'Quaternary',
            ),
            'default_value' => false,
            'return_format' => 'value',
            'multiple' => 0,
            'allow_null' => 0,
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
        ),
    );
}
