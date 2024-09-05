<?php
/**
 * The following registers custom ACF Block: Image Banner.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @package dpiChild
 */

acf_register_block(array(
  'name'            => 'image-banner',
  'title'           => __('Image Banner', 'dpiChild'),
  'description'     => __('A custom banner block.', 'dpiChild'),
  'render_callback'	=> 'acf_block_render_callback',
  'category'        => 'layout',
  'icon'            => 'align-center',
  'keywords'        => array( 'banner', 'image-banner' ),
));
