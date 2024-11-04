<?php

/**
 * The template for displaying quicklinks at the bottom of the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

$marker_clr = getField("footer_icon_color", "options", true, 'white');

?>

<div class="quicklinks-container" style="--marker-clr: <?php echo $marker_clr; ?>">
    <h2 class="has-text-decoration"><?php the_field("footer_quicklinks_header", "options"); ?></h2>
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'footer-quicklinks',
            'menu_id'        => 'footer-quicklinks',
        )
    );
    ?>

</div>