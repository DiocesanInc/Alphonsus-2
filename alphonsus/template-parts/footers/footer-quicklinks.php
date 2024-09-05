<?php

/**
 * The template for displaying quicklinks at the bottom of the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

?>

<div class="quicklinks-container">
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