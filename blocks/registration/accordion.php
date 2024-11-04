<?php
/**
 * The following registers custom ACF Block: Accordion.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @package dpiChild
 */

acf_register_block(array(
  'name'            => 'accordion',
  'title'           => __('Accordion', 'dpiChild'),
  'description'     => __('Custom Accordion Blocks.', 'dpiChild'),
  'render_callback' => 'acf_block_render_callback',
  'category'        => 'layout',
  'icon'            => 'screenoptions',
  'keywords'        => array( 'accordion', 'list' ),
));
