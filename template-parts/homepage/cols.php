<?php

/**
 * Template part for displaying columns on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

?>

<div class="homepage-section-cols limit-width" data-cols="<?php echo count($args); ?>">
    <?php foreach ($args as $col) :
        get_template_part("template-parts/homepage/$col");
    endforeach; ?>
</div>