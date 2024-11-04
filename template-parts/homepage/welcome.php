<?php

/**
 * Template part for displaying the welcome section on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$bg_img = get_field("welcome_background_image") ? get_field("welcome_background_image")["url"] : "";
$overlay = getField("welcome_overlay_color", false, false, "");
$text_color = getField("welcome_text_color", false, false, "clr-tertiary");
$show = getField("show_welcome", false,  false, false);
?>
<?php if ($show) : ?>
    <div class="welcome-container" style="background-image: url(<?php echo $bg_img; ?>); --overlay: <?php echo $overlay; ?>; --color: <?php echo $text_color; ?>">
        <div class="limit-width">

            <h2 class="welcome-line welcome-line-1">
                <?php the_field("welcome_line_1"); ?>
            </h2>
            <h3 class="welcome-line welcome-line-2">
                <?php the_field("welcome_line_2"); ?>
            </h3>
        </div>
    </div>
<?php endif; ?>