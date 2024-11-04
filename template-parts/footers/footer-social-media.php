<?php

/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alphonsus
 */

?>

<?php if (have_rows("footer_social_media", "options")) : while (have_rows("footer_social_media", "options")) : the_row() ?>
        <div class="footer-social-media">
            <h6>
                <?php echo get_field("footer_social_media", "options")["header"]; ?>
            </h6>
            <?php if (have_rows("social_media", "options")) : ?>
                <ul class="social-media-link-list">
                    <?php while (have_rows("social_media", "options")) : the_row();
                        $link = get_sub_field("link");
                        $logo = get_sub_field("logo");
                    ?>
                        <li class="social-media-link">
                            <a target="_blank" href="<?php echo $link; ?>"><?php echo $logo; ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
<?php endwhile;
endif; ?>