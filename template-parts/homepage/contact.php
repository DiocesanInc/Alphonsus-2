<?php

/**
 * Template part for displaying the contact form on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$form_id = get_field("contact_form")["id"];

?>

<?php if ($form_id) : ?>
    <div class="contact-form-container">

        <?php if (get_field("contact_form_heading")) : ?>
            <h1 class="contact-form-heading has-text-decoration text-decoration-is-centered has-primary-background-color-after">
                <?php the_field("contact_form_heading"); ?>
            </h1>
        <?php endif; ?>

        <?php
        if (function_exists("gravity_form")) :
            gravity_form($form_id, false, false);
        endif;
        ?>

    </div>
<?php endif; ?>