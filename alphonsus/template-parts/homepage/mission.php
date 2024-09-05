<?php

/**
 * Template part for displaying the mission on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$backgroundImage = get_field("mission_background_image")["url"];
$position = get_field("mission_content_position");
$header = get_field("mission_header");
$content = get_field("mission_content");
?>


<div class="mission-container limit-width" style="background-image: url(<?php echo $backgroundImage; ?>)">
    <div class="mission-content-wrapper hidden-mobile <?php echo $position; ?>">
        <?php if ($header) : ?>
            <h3 class="mission-header has-text-decoration has-white-background-color-after text-decoration-is-centered">
                <?php echo $header; ?>
            </h3>
        <?php endif; ?>
        <?php if ($content) : ?>
            <div class="mission-content">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="mission-content-wrapper hidden-laptop">
    <?php if ($header) : ?>
        <h3 class="mission-header has-text-decoration has-white-background-color-after text-decoration-is-centered">
            <?php echo $header; ?>
        </h3>
    <?php endif; ?>
    <?php if ($content) : ?>
        <div class="mission-content">
            <?php echo $content; ?>
        </div>
    <?php endif; ?>
</div>