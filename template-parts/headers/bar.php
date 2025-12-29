<?php

/**
 * Partial for the header bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */
?>

<?php
get_template_part("template-parts/headers/top-bar");
?>
<div class="header-nav limit-width-wide">
    <?php
    get_template_part("template-parts/headers/branding");
    get_template_part("template-parts/headers/navigation");
    ?>
</div>