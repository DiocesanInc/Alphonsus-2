<?php

if (class_exists("GF_Field_Checkbox")) {
    class GF_Field_Ministries extends GF_Field_Checkbox
    {
        public $type = "ministry_checkboxes";

        //
        public function get_form_editor_field_title()
        {
            return esc_attr__("Ministry Checkboxes");
        }

        public function get_form_editor_button()
        {
            return [
                "group" => "advanced_fields",
                "text" => $this->get_form_editor_field_title()
            ];
        }

        public function get_form_editor_field_settings()
        {
            return [
                "label_setting"
            ];
        }

        public function get_field_input($form, $value = "", $entry = null)
        {
            if ($this->is_form_editor()) {
                return $this->_get_backend_field_input();
            }

            return $this->_get_frontend_field_input();
        }

        private function _get_backend_field_input()
        {
            $ministryGroups = get_terms(
                array(
                    'taxonomy'   => "ministry-group",
                    'hide_empty' => false,
                    "orderby" => "date",
                    "order" => "DESC"
                )
            );
            $output = "<ul class='ministry-group-list'>";

            foreach ($ministryGroups as $group) {
                $output .= "<li class='ministry-group'>";
                $output .= "<h3>$group->name</h3>";
                $output .= "<ul class='ministry-list'>";
                $args = array(
                    "post_type" => "ministry",
                    "tax_query" => array(
                        array(
                            "taxonomy" => "ministry-group",
                            "field" => "term_id",
                            "terms" => $group->term_id
                        )
                    ),
                    "orderby" => "title",
                    "order" => "ASC"
                );

                $q = new WP_Query($args);
                $ministries = $q->posts;

                foreach ($ministries as $ministry) {
                    $output .= "<li class='ministry'>";
                    $output .= "$ministry->post_title";
                    $output .= "</li>";
                }
                $output .= "</li></ul>";
            }
            $output .= "</ul>";
            return $output;
        }

        private function _get_frontend_field_input()
        {
            $id = (int) $this->id;

            $ministryGroups = get_terms(
                array(
                    'taxonomy'   => "ministry-group",
                    'hide_empty' => false,
                    "orderby" => "date",
                    "order" => "DESC"
                )
            );

            $output = "<ul class='ministry-group-list'>";

            foreach ($ministryGroups as $group) {
                $output .= "<li data-ministry-list-id='$group->term_id' class='ministry-group'>";
                $output .= "<span class='the-button has-primary-color has-primary-border-color has-transparent-background-color ministry-group-title has-primary-color-hover'>$group->name</span>";
                $output .= "<ul id='ministry-list-$group->term_id' class='ministry-list'>";
                $args = array(
                    "post_type" => "ministry",
                    "tax_query" => array(
                        array(
                            "taxonomy" => "ministry-group",
                            "field" => "term_id",
                            "terms" => $group->term_id
                        )
                    ),
                    "orderby" => "title",
                    "order" => "ASC"
                );

                $q = new WP_Query($args);

                $ministries = $q->posts;
                foreach ($ministries as $ministry) {
                    $output .= "<li class='ministry'>";
                    $output .= "<input name='input_" . $id . "[]' type='checkbox' value='$ministry->post_title' id='$ministry->ID'>";
                    $output .= "<label class='ministry-title' for='$ministry->ID'>$ministry->post_title</label>";
                    $output .= "</li>";
                }
                $output .= "</li></ul>";
            }
            $output .= "</ul>";


            return $output;
        }

        public function is_value_submission_array()
        {
            return true;
        }
    }
    GF_Fields::register(new GF_Field_Ministries());
}