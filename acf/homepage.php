<?php

//Load the hero tab
load_acf_file("tabs/hero");
load_acf_file("tabs/welcome");
load_acf_file("tabs/featured_buttons");
load_acf_file("tabs/parishes");
    load_acf_file("tabs/mass_times");
    load_acf_file("tabs/content_slider");
    load_acf_file("tabs/calendar");
    load_acf_file("tabs/news");

//get acf fields for the hero
$fields = acf_hero();
// $fields = array_merge($fields, acf_welcome(), acf_featured_buttons());
$fieldsP = array_merge(acf_hero(), acf_welcome(), acf_featured_buttons(), acf_parishes(), acf_mass_times(), acf_content_slider(), acf_calendar(), acf_news());


//if a custom section order for the homepage is set in template settings
if (have_rows("section_order", "options")) :

    //iterate through the sections set in the template settings
    while (have_rows("section_order", "options")) : the_row();

        //get section name
        $section = get_sub_field("section");
        //load according acf tab file
        load_acf_file("tabs/$section");
        //store section name as a variable function name
        $func = "acf_$section";
        //execute variable function to get the acf fields for the corresponding section
        $new_tab = $func();
        //merge array. append new acf fields to the ones that already exist
        $fields = array_merge($fields, $new_tab);
    endwhile;

else :
    //load default order of sections if no custom order is set
    // load_acf_file("tabs/welcome");
    // load_acf_file("tabs/featured_buttons");

    $fields = array_merge($fields, acf_welcome(), acf_featured_buttons(), acf_mass_times(), acf_content_slider(), acf_calendar(), acf_news());

endif;

// $fieldsP = array_merge($fieldsP, acf_mass_times(), acf_content_slider(), acf_calendar(), acf_news());


if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group(
        array(
            'key' => 'group_6182f3cb22bd9',
            'title' => 'Homepage',
            "fields" => $fields, //set the custom order here
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'templates/page-homepage.php',
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
        )
    );

    acf_add_local_field_group(
        array(
            'key' => 'group_6182f3cb22bdz',
            'title' => 'Homepage Cluster',
            "fields" => $fieldsP, //adds Parish Cluster to selected fields
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'templates/page-homepage-cluster.php',
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
        )
    );

endif;