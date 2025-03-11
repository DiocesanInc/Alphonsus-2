<?php

/**
 * Partial for the site branding.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */
?>

<div class="site-branding">
    <?php $customLink = get_field('logo_link','options')['url'] ?? '';?>
    <a href="<?php echo $customLink ? esc_url($customLink) : home_url(); ?>" class="header-logo-link" title="<?php bloginfo(); ?>" rel="home">
        <img src="<?php the_field("header_logo", "options"); ?>" alt="<?php bloginfo(); ?>" class="header-logo header-logo-default" />
        <img src="<?php the_field("header_logo_sticky", "options"); ?>" alt="<?php bloginfo(); ?>" class="header-logo header-logo-sticky" />
    </a>
</div>