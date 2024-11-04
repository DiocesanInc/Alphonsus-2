<?php
/**
 * The following registers custom ACF Block: Image Button.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @package dpiChild
 */

acf_register_block(array(
  'name'            => 'image-button',
  'title'           => __('Image Button', 'dpiChild'),
  'description'     => __('Custom Image Blocks.', 'dpiChild'),
  'render_callback'	=> 'acf_block_render_callback',
  'category'        => 'layout',
  'icon'            => 'screenoptions',
  'keywords'        => array( 'button', 'image-button' ),
));
