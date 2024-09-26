<?php

/**
 * Block Name: Image Button
 * This is the template that displays the Image Button block.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package dpiChild
 */
?>

<?php
// create id attribute for specific styling
$id = 'image-buttons-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? ' align' . $block['align'] : '';


// values from ACF
if (get_field('is_manual')) {
    $bkgd   = is_array(get_field("bkgd")) && array_key_exists("url", get_field("bkgd")) ? get_field('bkgd')['url'] : "";

    $link   = get_field('link');
    $target = is_array($link) && array_key_exists("target", $link) ? $link['target'] : "";
    $title  = is_array($link) && array_key_exists("title", $link) ? $link['title'] : "";
    $url    = is_array($link) && array_key_exists("url", $link) ? $link['url'] : "";
} else {
    $page   = get_field('page');
    $bkgd   = $page ? get_the_post_thumbnail_url($page) : "";
    $target = '';
    $title  = $page ? get_the_title($page->ID) : "";
    $url    = $page ? get_permalink($page->ID) : "";
}
$bkgd = $bkgd ? $bkgd : getDefaultFeaturedImage(true);

$bgClr = "var(--clr-quaternary)";
$opacity = 0.7;
// if (!$bkgd) {
//     $bgClr = get_field("primary_color", "options")["is_gradient"] ? "linear-gradient(90deg, var(--clr-primary), var(--clr-primary-2))" : "var(--clr-primary)";
//     $opacity = 1;
// }

?>

<a href="<?php echo $url; ?>" class="button-link image-button-block<?php echo $align_class; ?>"
    target="<?php echo $target; ?>" title="<?php echo $title; ?>" id="<?php echo $id; ?>">
    <div class="background-image" style="background-image: url(<?php echo $bkgd; ?>)">

    </div>
    <div class="button-title has-white-color">
        <?php echo $title; ?>
    </div>
</a>

<style type="text/css">
#<?php echo "$id";

?> {
    font-size: 30px;
    position: relative;
    display: flex;
    flex-flow: row wrap;
    justify-content: center;
    /* float: left; */
    align-items: center;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    text-decoration: none;
    width: 100%;
    height: 9.5em;
    margin-bottom: 1.75rem;
    box-shadow: 0 20px 25px #293d4729;
    overflow: hidden;
    border-radius: 10px;
}

#<?php echo "$id *";

?> {
    z-index: 1;
}

#<?php echo "$id .background-image";

?> {
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transition: var(--tr-transform);
}

#<?php echo "$id .background-image::after";

?> {
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: <?php echo $opacity ?>;
    transition: opacity 0.25s ease-in;
    background: <?php echo $bgClr ?>;
}

#<?php echo "$id .background-image::before";

?> {
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 0.25s ease-in;
    background: white;
}

#<?php echo "$id .button-title";

?> {
    padding: 0 0.25rem;
    position: absolute;
    font-family: var(--font-heading);
    font-size: inherit;
}



#<?=$id;
?>:hover .background-image,
#<?=$id;

?>:focus .background-image {
    transform: scale(1.1);
}

#<?=$id;
?>:hover .background-image::before,
#<?=$id;

?>:focus .background-image::before {
    opacity: 0.2;
}
</style>