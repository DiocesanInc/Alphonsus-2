<?php

/**
 * Template part for displaying single pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$groups = get_the_terms(get_post(), "ministry-group");

if (!empty($groups)) {
    $group = $groups[0];
    $backlink = get_field("ministry_is_slider", getMinistryPostObject()) ? get_permalink(getMinistryPostObject()) : get_term_link($group->term_id);
} else {
    $backlink = "/ministries";
}

$contacts = get_field("contacts");


?>

<article class="entry-content single-ministry-article">
    <div class="the-content">
        <?php the_content(); ?>
        <div class="back-button-container align-center desktop-only">
            <a href="<?php echo $backlink; ?>"
                class="the-button has-primary-color has-primary-border-color has-transparent-background-color"
                title="back">
                Go Back
            </a>
        </div>

    </div>
</article>
<?php if (is_array($contacts)) : ?>
    <div class="contact-persons-container">
        <?php foreach ($contacts as $contact) :

            $c = $contact["contact"];
            $isStaff = $contact["is_staff"];
            $image = $isStaff ? get_the_post_thumbnail_url($c) : '';
            $name = $isStaff ? $c->post_title : $contact["contact_name"];
            $position = $isStaff ? get_field("position", $c) : $contact["position"];
            $phone = $isStaff ? get_field("phone", $c) : $contact["contact_phone_number"];
            $email = $isStaff ? get_field("email", $c) : $contact["contact_email"];
            $website = $isStaff && get_field("link", $c) ? get_field("link", $c)["url"] : null;
        ?>
            <div class="contact-person-wrapper staff-single teaser-box flex-column">
                <?php if ($image) : ?>
                    <div class="contact-image">
                        <img src="<?php echo $image; ?>" class="staff-image teaser-img" alt="<?php echo $name; ?>" />
                    </div>
                <?php endif; ?>

                <div class="teaser-content-wrapper flex-column">
                    <?php if ($name) : ?>
                        <h3 class="staff-name teaser-title">
                            <?php echo $name; ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ($position) : ?>
                        <div class="staff-position">
                            <?php echo $position; ?>
                        </div>
                    <?php endif; ?>

                    <div class="teaser-content">
                        <?php if ($email) : ?>
                            <div class="contact-person-email">
                                <a href="mailto: <?php echo $email; ?>" class="has-underline-hover">
                                    <i class="fa-solid fa-envelope"></i>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($website) : ?>
                            <div class="contact-person-website">
                                <a href="<?php echo $website; ?>" class="has-underline-hover">
                                    <i class="fa-solid fa-link"></i>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($phone) : ?>
                            <div class="contact-person-phone">
                                <a href="<?php echo phoneLink($phone); ?>" class="has-underline-hover">
                                    <?php echo $phone; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="back-button-container align-center mobile-only">
    <a href="<?php echo $backlink; ?>"
        class="the-button has-primary-color has-primary-border-color has-transparent-background-color" title="back">
        Go Back
    </a>
</div>