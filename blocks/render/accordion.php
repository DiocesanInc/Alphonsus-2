<?php

/**
 * Block Name: Accordion
 * This is the template that displays the Accordion block.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package dpiChild
 */

// create id attribute for specific styling
$id = 'accordion-' . $block['id'];

$headingFontColor = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["heading_font_color"] : "white";
$headingFontColorHover = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["heading_font_color_hover"] : "white";
$headingFontColorActive = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["heading_font_color_active"] : "white";

$headingBackgroundColor = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["heading_background_color"] : "var(--clr-primary)";
$headingBackgroundColorHover = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["heading_background_color_hover"] : "var(--clr-primary)";
$headingBackgroundColorActive = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["heading_background_color_active"] : "var(--clr-primary)";

$contentFontColor = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["content_font_color"] : "black";
$contentBackgroundColor = get_field("accordion_colors", "options") ? get_field("accordion_colors", "options")["content_background_color"] : "white";
?>

<div class="accordion-block" id="<?php echo $id; ?>">
    <div class="accordion">
        <?php if (have_rows('accordion')) :
            while (have_rows('accordion')) : the_row(); ?>
                <div class="accordion-section-title has-primary-background-color has-white-color">
                    <h6 class="font-header">
                        <?php the_sub_field('section_title'); ?>
                    </h6>
                    <div class="accordion-toggle">
                        <i class="fas fa-plus"></i>
                        <i class="fas fa-minus"></i>
                    </div>
                </div>
                <div class="accordion-content">
                    <?php echo get_sub_field('section_content'); ?>
                </div>
        <?php endwhile;
        endif; ?>
    </div>
</div>

<style type="text/css">
    #<?php echo $id;

        ?> {
        margin-bottom: 3.5rem;
        max-width: 1080px;
        width: 100%;
    }

    #<?php echo "$id .accordion-section-title";

        ?> {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: none;
        border-bottom: 1px solid #D6D6D6;
        border-radius: 5px 5px 0 0;
        padding: 0 1rem;
        margin: 1.5625rem 0 0;
        min-height: 3rem;
        transition: all .4s ease;
        margin-left: 1rem;
        background: <?php echo $headingBackgroundColor ?>;

    }

    #<?php echo "$id .accordion-section-title:hover";

        ?> {
        background: <?php echo $headingBackgroundColorHover ?>;
    }

    #<?php echo "$id .accordion-section-title h6";

        ?> {
        margin: 0;
        padding-right: 2rem;
        cursor: pointer;
        color: <?php echo $headingFontColor; ?>;
    }

    #<?php echo "$id .accordion-section-title:hover h6";

        ?> {
        color: <?php echo $headingFontColorHover ?>;
    }

    #<?php echo "$id .accordion-section-title .ui-accordion-header-icon.ui-icon";

        ?> {
        display: none;
    }

    #<?php echo "$id .accordion-section-title .accordion-toggle";

        ?> {
        position: relative;
        height: 2rem;
        width: 2rem;
        border-radius: 50%;
        cursor: pointer;
    }

    #<?php echo "$id .accordion-section-title .accordion-toggle .fa-plus";
        ?>,
    #<?php echo "$id .accordion-section-title .accordion-toggle .fa-minus";

        ?> {
        top: 50%;
        left: 50%;
        transition: transform .4s ease;
        position: absolute;
        color: var(--clr-quaternary);
    }

    #<?php echo "$id .accordion-section-title:hover .accordion-toggle .fa-plus";
        ?>,
    #<?php echo "$id .accordion-section-title:hover .accordion-toggle .fa-minus";

        ?> {
        color: <?php echo $headingFontColorHover; ?>;
    }

    #<?php echo "$id .accordion-section-title .accordion-toggle .fa-plus";
        ?>,
    #<?php echo "$id .accordion-section-title.ui-accordion-header-active .accordion-toggle .fa-minus";

        ?> {
        transform: translate(-50%, -50%) scale(1);
    }

    #<?php echo "$id .accordion-section-title .accordion-toggle .fa-minus";
        ?>,
    #<?php echo "$id .accordion-section-title.ui-accordion-header-active .accordion-toggle .fa-plus";

        ?> {
        transform: translate(-50%, -50%) scale(0);
    }

    #<?php echo "$id .accordion-section-title.ui-accordion-header-active";

        ?> {
        background: <?php echo $headingBackgroundColorActive ?>;
    }

    #<?php echo "$id .accordion-section-title.ui-accordion-header-active h6";

        ?> {
        color: <?php echo $headingFontColorActive ?>;
    }

    #<?php echo "$id .accordion-section-title.ui-accordion-header-active .accordion-toggle .fa-plus";

        ?>,

    #<?php echo "$id .accordion-section-title.ui-accordion-header-active .accordion-toggle .fa-minus";

        ?> {
        color: <?php echo $headingFontColorActive; ?>;
    }

    #<?php echo "$id .accordion-content";

        ?> {
        margin-left: 1rem;
        padding-inline: 2rem;
        background: <?php echo $contentBackgroundColor ?>;
        color: <?php echo $contentFontColor ?>;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
        outline: 1px solid #D8D8D8;
    }

    #<?php echo "$id .accordion-content ol";
        ?>,
    #<?php echo "$id .accordion-content ul";

        ?> {
        margin-left: 0;
    }

    #<?php echo "$id .accordion-content p";

        ?> {
        margin-bottom: 1.5em;
    }
</style>

<script>
    jQuery(".accordion").accordion({
        collapsible: true,
        active: false,
        heightStyle: "content",
    });
</script>