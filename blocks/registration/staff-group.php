<?php
/**
 * The following registers custom ACF Block: Staff Group.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @package dpiChild
 */

acf_register_block(array(
  'name'            => 'staff-group',
  'title'           => __('Staff Group', 'dpiChild'),
  'description'     => __('Custom Staff Group Blocks.', 'dpiChild'),
  'render_callback' => 'acf_block_render_callback',
  'category'        => 'layout',
  'icon'            => 'people',
  'keywords'        => array( 'staff-group', 'list' ),
));
