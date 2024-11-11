<?php

function acf_parishes()
{
    return array(
  		array(
  			'key' => 'field_626c37b2602a3',
  			'label' => 'Parish Buttons',
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
  			'key' => 'field_626c37cd602a4',
			'label' => 'Cluster Style',
			'name' => 'cluster_style',
			'aria-label' => '',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'buttons' => 'Buttons',
				'carousel' => 'Carousel',
			),
			'default_value' => '',
			'return_format' => 'value',
			'allow_null' => 0,
			'other_choice' => 0,
			'layout' => 'vertical',
			'save_other_choice' => 0,
  		),
  		array(
  			'key' => 'field_6270a5d99e494',
  			'label' => 'Parish Cluster Title',
  			'name' => 'parish_scroll_title',
  			'type' => 'text',
  			'instructions' => '*Max 25 Characters',
  			'required' => 0,
  			'conditional_logic' => array(
  				array(
  					array(
  						'field' => 'field_626c37cd602a4',
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
  			'default_value' => '',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '25',
  		),
  		array(
  			'key' => 'field_626c3734abd52',
  			'label' => 'Parish Buttons',
  			'name' => 'parish_buttons',
  			'type' => 'repeater',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => array(
  				array(
  					array(
  						'field' => 'field_626c37cd602a4',
  						'operator' => '==',
  						'value' => 'buttons',
  					),
  				),
  			),
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'collapsed' => '',
  			'min' => 0,
  			'max' => 0,
  			'layout' => 'table',
  			'button_label' => '',
  			'sub_fields' => array(
  				array(
  					'key' => 'field_626c3747abd53',
  					'label' => 'Image',
  					'name' => 'image',
  					'type' => 'image',
  					'instructions' => 'Recommended aspect ratio 370 / 305.',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'return_format' => 'url',
  					'preview_size' => 'medium',
  					'library' => 'all',
  					'min_width' => '',
  					'min_height' => '',
  					'min_size' => '',
  					'max_width' => '',
  					'max_height' => '',
  					'max_size' => '',
  					'mime_types' => '',
  				),
        		array(
        			'key' => 'field_626c3734abd5z',
        			'label' => 'Mass Times',
        			'name' => 'mass_times',
        			'type' => 'repeater',
        			'instructions' => 'Character limit 30.',
        			'required' => 0,
        			'wrapper' => array(
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'collapsed' => '',
        			'min' => 0,
        			'max' => 3,
        			'layout' => 'table',
        			'button_label' => '',
        			'sub_fields' => array(
        				array(
        					'key' => 'field_626c3773abd54',
        					'label' => 'Time',
        					'name' => 'text',
        					'type' => 'text',
        					'instructions' => '',
        					'required' => 0,
        					'conditional_logic' => 0,
        					'wrapper' => array(
        						'width' => '',
        						'class' => '',
        						'id' => '',
        					),
        					'default_value' => '',
        					'placeholder' => '',
        					'maxlength' => 30,
        					'rows' => '',
        					'new_lines' => '',
        				),
				      ),
          		),
  				array(
  					'key' => 'field_626c3773abd5z',
  					'label' => 'Title',
  					'name' => 'title',
  					'type' => 'text',
  					'instructions' => 'Character limit 20.',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'default_value' => '',
  					'placeholder' => '',
  					'maxlength' => 20,
  					'rows' => '',
  					'new_lines' => '',
  				),
  				array(
  					'key' => 'field_626c379dabd55',
  					'label' => 'Link',
  					'name' => 'link',
  					'type' => 'link',
  					'instructions' => 'Please note the Title field will display instead of the link text.',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'return_format' => 'array',
  				),
  			),
  		),
		array(
			'key' => 'field_65f19df8329dz',
			'label' => 'Carousel',
			'name' => 'parish_carousel',
			'aria-label' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_626c37cd602a4',
						'operator' => '==',
						'value' => 'carousel',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'min' => 0,
			'max' => 0,
			'collapsed' => '',
			'button_label' => 'Add Parish',
			'sub_fields' => array(
				array(
                    'key' => 'field_60f1e107bcf37',
                    'label' => 'Icon Type',
                    'name' => 'is_image',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'Image',
                    'ui_off_text' => 'FA Icon',
                ),
                array(
                    'key' => 'field_60f1e1b3bcf39',
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_60f1e107bcf37',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_60f1e136bcf38',
                    'label' => 'FA Icon',
                    'name' => 'fa_icon',
                    'type' => 'font-awesome',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_60f1e107bcf37',
                                'operator' => '!=',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'icon_sets' => array(
                        0 => 'fas',
                        1 => 'far',
                        2 => 'fab',
                    ),
                    'custom_icon_set' => '',
                    'default_label' => '',
                    'default_value' => '',
                    'save_format' => 'element',
                    'allow_null' => 0,
                    'show_preview' => 1,
                    'enqueue_fa' => 0,
                    'fa_live_preview' => '',
                    'choices' => array(),
                ),
				array(
					'key' => 'field_65f19e2a329dz',
					'label' => 'Parish Name',
					'name' => 'parish_name',
					'aria-label' => '',
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
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_65f19df8329dz',
				),
				array(
					'key' => 'field_626c379dabd5y',
					'label' => 'Button',
					'name' => 'button',
					'type' => 'link',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '25',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
				),
				array(
					'key' => 'field_65f19e4b329dz',
					'label' => 'Content',
					'name' => 'content',
					'aria-label' => '',
					'type' => 'textarea',
                    'instructions' => '*Max 200 characters',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '100',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => 200,
                    'rows' => 4,
                    'new_lines' => 'br',
                ),
			),
		),
		// array(
		// 	'key' => 'field_65f19df8329d0',
		// 	'label' => 'Parishes',
		// 	'name' => 'parish_maps',
		// 	'aria-label' => '',
		// 	'type' => 'repeater',
		// 	'instructions' => '',
		// 	'required' => 0,
		// 	'conditional_logic' => array(
		// 		array(
		// 			array(
		// 				'field' => 'field_626c37cd602a4',
		// 				'operator' => '==',
		// 				'value' => 'map',
		// 			),
		// 		),
		// 	),
		// 	'wrapper' => array(
		// 		'width' => '',
		// 		'class' => '',
		// 		'id' => '',
		// 	),
		// 	'layout' => 'table',
		// 	'pagination' => 0,
		// 	'min' => 0,
		// 	'max' => 0,
		// 	'collapsed' => '',
		// 	'button_label' => 'Add Parish',
		// 	'rows_per_page' => 20,
		// 	'sub_fields' => array(
		// 		array(
		// 			'key' => 'field_65f19e2a329d1',
		// 			'label' => 'Parish Name',
		// 			'name' => 'parish_name',
		// 			'aria-label' => '',
		// 			'type' => 'text',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'default_value' => '',
		// 			'maxlength' => '',
		// 			'placeholder' => '',
		// 			'prepend' => '',
		// 			'append' => '',
		// 			'parent_repeater' => 'field_65f19df8329d0',
		// 		),
		// 		array(
		// 			'key' => 'field_626c379dabd5z',
		// 			'label' => 'Link',
		// 			'name' => 'link',
		// 			'type' => 'link',
		// 			'instructions' => 'Please note the Parish Name field will display instead of the link text.',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'return_format' => 'array',
		// 		),
		// 		array(
		// 			'key' => 'field_65f19e4b329d2',
		// 			'label' => 'Address',
		// 			'name' => 'address',
		// 			'aria-label' => '',
		// 			'type' => 'text',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'default_value' => '',
		// 			'maxlength' => '',
		// 			'placeholder' => '',
		// 			'prepend' => '',
		// 			'append' => '',
		// 			'parent_repeater' => 'field_65f19df8329d0',
		// 		),
		// 		array(
		// 			'key' => 'field_65f19e5b329d3',
		// 			'label' => 'Phone',
		// 			'name' => 'phone',
		// 			'aria-label' => '',
		// 			'type' => 'text',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'default_value' => '',
		// 			'maxlength' => '',
		// 			'placeholder' => '',
		// 			'prepend' => '',
		// 			'append' => '',
		// 			'parent_repeater' => 'field_65f19df8329d0',
		// 		),
		// 		array(
		// 			'key' => 'field_65f19e6d329d5',
		// 			'label' => 'Email',
		// 			'name' => 'email',
		// 			'aria-label' => '',
		// 			'type' => 'text',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'default_value' => '',
		// 			'maxlength' => '',
		// 			'placeholder' => '',
		// 			'prepend' => '',
		// 			'append' => '',
		// 			'parent_repeater' => 'field_65f19df8329d0',
		// 		),
		// 		array(
		// 			'key' => 'field_65f19e6d329zz',
		// 			'label' => 'Latitude',
		// 			'name' => 'latitude',
		// 			'aria-label' => '',
		// 			'type' => 'text',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'default_value' => '',
		// 			'maxlength' => '',
		// 			'placeholder' => '',
		// 			'prepend' => '',
		// 			'append' => '',
		// 			'parent_repeater' => 'field_65f19df8329d0',
		// 		),
		// 		array(
		// 			'key' => 'field_65f19e6d329zy',
		// 			'label' => 'Longitude',
		// 			'name' => 'longitude',
		// 			'aria-label' => '',
		// 			'type' => 'text',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'default_value' => '',
		// 			'maxlength' => '',
		// 			'placeholder' => '',
		// 			'prepend' => '',
		// 			'append' => '',
		// 			'parent_repeater' => 'field_65f19df8329d0',
		// 		),
		// 	),
		// ),
  		// array(
  		// 	'key' => 'field_626c380e602a5',
  		// 	'label' => 'Parish Scroll',
  		// 	'name' => 'parish_scroll',
  		// 	'type' => 'repeater',
  		// 	'instructions' => '',
  		// 	'required' => 0,
  		// 	'conditional_logic' => array(
  		// 		array(
  		// 			array(
  		// 				'field' => 'field_626c37cd602a4',
  		// 				'operator' => '==',
  		// 				'value' => 'scroll',
  		// 			),
  		// 		),
  		// 	),
  		// 	'wrapper' => array(
  		// 		'width' => '',
  		// 		'class' => '',
  		// 		'id' => '',
  		// 	),
  		// 	'collapsed' => '',
  		// 	'min' => 0,
  		// 	'max' => 0,
  		// 	'layout' => 'table',
  		// 	'button_label' => '',
  		// 	'sub_fields' => array(
  		// 		array(
  		// 			'key' => 'field_626c3822602a6',
  		// 			'label' => 'Parish',
  		// 			'name' => 'parish',
  		// 			'type' => 'link',
  		// 			'instructions' => '',
  		// 			'required' => 0,
  		// 			'conditional_logic' => 0,
  		// 			'wrapper' => array(
  		// 				'width' => '',
  		// 				'class' => '',
  		// 				'id' => '',
  		// 			),
  		// 			'return_format' => 'array',
  		// 		),
  		// 	),
  		// ),
  );
}
