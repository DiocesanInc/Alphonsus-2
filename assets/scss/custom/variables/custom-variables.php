<?php

$filename = \CssHelper::getFileName();

$variables = new CssHelper([], $filename, false);

/**
 * THEME COLORS
 */
$variables->addCssRule(
    ":root",
    array(
        "--clr-primary" => get_field("primary_color", "options")["color"],
        "--clr-primary-st" => get_field("primary_color", "options")["color"] . get_field("opacity", "options"),
        "--clr-secondary" => get_field("secondary_color", "options")["color"],
        "--clr-secondary-st" => get_field("secondary_color", "options")["color"] . get_field("opacity", "options"),
        "--clr-tertiary" => get_field("tertiary_color", "options")["color"],
        "--clr-tertiary-st" => get_field("tertiary_color", "options")["color"] . get_field("opacity", "options"),
        "--clr-quaternary" => get_field("quaternary_color", "options")["color"],
        "--clr-quaternary-st" => get_field("quaternary_color", "options")["color"] . get_field("opacity", "options"),
    )
);

$variables->addCssRule(
    ".has-primary-color-after::after",
    array("color" => get_field("primary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-primary-color-before::before",
    array("color" => get_field("primary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-primary-background-color-after::after",
    array("background-color" => get_field("primary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-primary-background-color-before::before",
    array("background-color" => get_field("primary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-secondary-color-after::after",
    array("color" => get_field("secondary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-secondary-color-before::before",
    array("color" => get_field("secondary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-secondary-background-color-after::after",
    array("background-color" => get_field("secondary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-secondary-background-color-before::before",
    array("background-color" => get_field("secondary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-tertiary-color-after::after",
    array("color" => get_field("tertiary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-tertiary-color-before::before",
    array("color" => get_field("tertiary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-tertiary-background-color-after::after",
    array("background-color" => get_field("tertiary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-tertiary-background-color-before::before",
    array("background-color" => get_field("tertiary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-quaternary-color-after::after",
    array("color" => get_field("quaternary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-quaternary-color-before::before",
    array("color" => get_field("quaternary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-quaternary-background-color-after::after",
    array("background-color" => get_field("quaternary_color", "options")["color"])
);
$variables->addCssRule(
    ".has-quaternary-background-color-before::before",
    array("background-color" => get_field("quaternary_color", "options")["color"])
);

if (get_field("primary_color", "options")["is_gradient"]) {
    $variables->addCssRule(
        ":root",
        array(
            "--clr-primary-2" => get_field("primary_color", "options")["color_2"]
        )
    );
}

if (get_field("secondary_color", "options")["is_gradient"]) {
    $variables->addCssRule(
        ":root",
        array(
            "--clr-secondary-2" => get_field("secondary_color", "options")["color_2"]
        )
    );
}

if (get_field("tertiary_color", "options")["is_gradient"]) {
    $variables->addCssRule(
        ":root",
        array(
            "--clr-tertiary-2" => get_field("tertiary_color", "options")["color_2"]
        )
    );
}

if (get_field("quaternary_color", "options")["is_gradient"]) {
    $variables->addCssRule(
        ":root",
        array(
            "--clr-quaternary-2" => get_field("quaternary_color", "options")["color_2"]
        )
    );
}

/**
 * TYPOGRAPHY
 */

if (have_rows("font_imports", "options")) {
    while (have_rows("font_imports", "options")) {
        the_row();
        $variables->addImport(get_sub_field("import"));
    }
} else {
    $imports = [
        "https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap",
        "https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap",
        "https://fonts.googleapis.com/css2?family=Lato&display=swap",
        "https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap"
    ];
    foreach ($imports as $import) :
        $variables->addImport($import);
    endforeach;
}

$variables->addCssRule(
    ":root",
    array(
        "--font-main" => getField('font_main', 'options', true, "Lato, sans-serif"),
        "--font-heading" => getField('font_heading', 'options', true, "Playfair Display, serif"),
        "--font-script" => getField('font_script', 'options', true, "Playfair Display, serif"),
        "--fs-1000" => "clamp(" . getField("heading_1", "options", true, "1.75rem")["font_size_min"] . "px, 3.5vw, " . getField("heading_1", "options", true, "2.25rem")["font_size_max"] . "px)",
        "--fs-900" => "clamp(" . getField("heading_2", "options", true, "1.625rem")["font_size_min"] . "px, 3.5vw, " . getField("heading_2", "options", true, "1.875rem")["font_size_max"] . "px)",
        "--fs-800" => "clamp(" . getField("heading_3", "options", true, "1.5rem")["font_size_min"] . "px, 4.5vw, " . getField("heading_3", "options", true, "1.625rem")["font_size_max"] . "px)",
        "--fs-700" => "clamp(" . getField("heading_4", "options", true, "1.375rem")["font_size_min"] . "px, 4.5vw, " . getField("heading_4", "options", true, "1.375rem")["font_size_max"] . "px)",
        "--fs-600" => "clamp(" . getField("heading_5", "options", true, "1.25rem")["font_size_min"] . "px, 4.5vw, " . getField("heading_5", "options", true, "1.25rem")["font_size_max"] . "px)",
        "--fs-500" => "clamp(" . getField("heading_6", "options", true, "1.125rem")["font_size_min"] . "px, 4.5vw, " . getField("heading_6", "options", true, "1.125em")["font_size_max"] . "px)",
        "--fs-400" => get_field("paragraph", "options")["font_size"] . "px",
        "--fs-300" => "0.9375rem",
        "--fs-200" => "0.875rem",
        "--fs-100" => "0.8125rem"
    )
);

$variables->addCssRule(
    ":root",
    array(
        "--hero-height" => getField("hero_height", "options", true, "60") . "vh",
        "--page-header-height" => getField("page_header_height", "options", true, "60") . "vh"
    )
);

for ($i = 1; $i <= 6; $i++) :
    $heading = get_field("heading_$i", "options");

    $variables->addCssRule(
        "h$i",
        array(
            "font-weight" => $heading["font_weight"],
            "font-style" => $heading["font_style"],
            "font-family" => $heading["font_family"],
            "color" => $heading["font_color"]
        )
    );
endfor;

$variables->addCssRule(
    "p",
    array(
        "color" => get_field("paragraph", "options")["font_color"],
        "font-size" => get_field("paragraph", "options")["font_size"] . "px",
    )
);

$variables->addCssRule(
    ":root",
    array(
        "--clr-font" => get_field("paragraph", "options")["font_color"],
    )
);

$variables->addCssRule(
    "a, .ui-widget-content a",
    array(
        "color" => getField("links", "options", true, "var(--clr-primary)")["font_color"],
        "font-weight" => get_field("links", "options")["font_weight"],
        "font-style" => get_field("links", "options")["font_style"],
        "text-decoration" => get_field("links", "options")["text_decoration"],
    )
);

$variables->addCssRule(
    "a:hover, a:focus, a:active",
    array(
        "color" => get_field("links", "options")["hover_styles"]["font_color"],
        "font-weight" => get_field("links", "options")["hover_styles"]["font_weight"],
        "font-style" => get_field("links", "options")["hover_styles"]["font_style"],
        "text-decoration" => get_field("links", "options")["hover_styles"]["text_decoration"],
    )
);

/**
 * check if Gradient is set in Theme Colors
 *
 * @param [type] $color
 * @return boolean
 */
function isGradient($color, $gradient)
{
    return getField($color . "_color", "options")["is_gradient"] && $gradient;
}

function getColor($color)
{
    return getField($color . "_color", "options", true, "white");
}

function getBgColor($color, $gradient = false)
{
    if ($color === "white" || $color === "black" || $color === "transparent") return $color;

    if (!isGradient($color, $gradient)) {
        $opa = get_field("opacity", "options");
        $clr = getColor($color)["color"] . $opa;
        return $clr;
    }

    $gradient_a = "var(--clr-$color)";
    $gradient_b = "var(--clr-$color-2)";
    return "linear-gradient(45deg, $gradient_a, $gradient_b)";
}

$variables->addCssRule(
    ":root",
    array(
        "--menu-top-level-default-font-color" => get_field('menu_colors', 'options')['top_level_default']['default_font_color'],
        "--menu-top-level-hover-font-color" => get_field('menu_colors', 'options')['top_level_default']['font_color_hover'],
        "--menu-top-level-default-bg-color" => getBgColor(get_field('menu_colors', 'options')['top_level_default']['default_bg_color'], get_field('menu_colors', 'options')['top_level_default']['default_bg_color_is_gradient']),
        "--menu-top-level-hover-bg-color" => getBgColor(get_field('menu_colors', 'options')['top_level_default']['bg_color_hover'], get_field('menu_colors', 'options')['top_level_default']['bg_color_hover_is_gradient']),
        "--menu-submenu-header-font-color" => get_field('menu_colors', 'options')['submenu_default']['header_font_color'],
        "--menu-submenu-header-font-color-hover" => get_field('menu_colors', 'options')['submenu_default']['header_font_color_hover'],
        "--menu-submenu-default-font-color" => get_field('menu_colors', 'options')['submenu_default']['default_font_color'],
        "--menu-submenu-hover-font-color" => get_field('menu_colors', 'options')['submenu_default']['font_color_hover'],
        "--menu-submenu-default-bg-color" => getBgColor(get_field('menu_colors', 'options')['submenu_default']['default_bg_color'], get_field('menu_colors', 'options')['submenu_default']['default_bg_color_is_gradient']),
        "--menu-submenu-hover-bg-color" => getBgColor(get_field('menu_colors', 'options')['submenu_default']['bg_color_hover'], get_field('menu_colors', 'options')['submenu_default']['bg_color_hover_is_gradient']),

        "--sticky-menu-top-level-default-font-color" => get_field('menu_colors', 'options')['top_level_sticky']['default_font_color'],
        "--sticky-menu-top-level-hover-font-color" => get_field('menu_colors', 'options')['top_level_sticky']['font_color_hover'],
        "--sticky-menu-top-level-default-bg-color" => getBgColor(get_field('menu_colors', 'options')['top_level_sticky']['default_bg_color'], get_field('menu_colors', 'options')['top_level_sticky']['default_bg_color_is_gradient']),
        "--sticky-menu-top-level-hover-bg-color" => getBgColor(get_field('menu_colors', 'options')['top_level_sticky']['bg_color_hover'], get_field('menu_colors', 'options')['top_level_sticky']['bg_color_hover_is_gradient']),
        "--sticky-menu-submenu-header-font-color" => get_field('menu_colors', 'options')['submenu_sticky']['header_font_color'],
        "--sticky-menu-submenu-header-font-color-hover" => get_field('menu_colors', 'options')['submenu_sticky']['header_font_color_hover'],
        "--sticky-menu-submenu-default-font-color" => get_field('menu_colors', 'options')['submenu_sticky']['default_font_color'],
        "--sticky-menu-submenu-hover-font-color" => get_field('menu_colors', 'options')['submenu_sticky']['font_color_hover'],
        "--sticky-menu-submenu-default-bg-color" => getBgColor(get_field('menu_colors', 'options')['submenu_sticky']['default_bg_color'], get_field('menu_colors', 'options')['submenu_sticky']['default_bg_color_is_gradient']),
        "--sticky-menu-submenu-hover-bg-color" => getBgColor(get_field('menu_colors', 'options')['submenu_sticky']['bg_color_hover'], get_field('menu_colors', 'options')['submenu_sticky']['bg_color_hover_is_gradient']),

        "--sidebar-top-level-default-font-color" => get_field('menu_colors', 'options')['top_level_sidebar']['default_font_color'],
        "--sidebar-top-level-hover-font-color" => get_field('menu_colors', 'options')['top_level_sidebar']['font_color_hover'],
        "--sidebar-top-level-default-bg-color" => getBgColor(get_field('menu_colors', 'options')['top_level_sidebar']['default_bg_color'], get_field('menu_colors', 'options')['top_level_sidebar']['default_bg_color_is_gradient']),
        "--sidebar-top-level-hover-bg-color" => getBgColor(get_field('menu_colors', 'options')['top_level_sidebar']['bg_color_hover'], get_field('menu_colors', 'options')['top_level_sidebar']['bg_color_hover_is_gradient']),
        "--sidebar-submenu-default-font-color" => get_field('menu_colors', 'options')['submenu_sidebar']['default_font_color'],
        "--sidebar-submenu-hover-font-color" => get_field('menu_colors', 'options')['submenu_sidebar']['font_color_hover'],
        "--sidebar-submenu-default-bg-color" => getBgColor(get_field('menu_colors', 'options')['submenu_sidebar']['default_bg_color'], get_field('menu_colors', 'options')['submenu_sidebar']['default_bg_color_is_gradient']),
        "--sidebar-submenu-hover-bg-color" => getBgColor(get_field('menu_colors', 'options')['submenu_sidebar']['bg_color_hover'], get_field('menu_colors', 'options')['submenu_sidebar']['bg_color_hover_is_gradient']),
    )
);

/**
 * Header
 */
$variables->addCssRule(
    ":root",
    array(
        "--max-logo-height" => get_field("max_logo_height", "options") . "px"
    )
);

/**
 * FOOTER COLORS
 */
/** Footer */
$variables->addCssRule(
    "footer",
    array(
        "background-color" => get_field("footer_bg_color", "options"),
    )
);

$variables->addCssRule(
    "footer, footer h1, footer h2, footer h3, footer h4, footer h5, footer h6",
    array(
        "background-color" => get_field("footer_bg_color", "options"),
        "color" => get_field("footer_font_color", "options")
    )
);

$variables->addCssRule(
    "footer a",
    array(
        "color" => get_field("footer_link_color", "options"),
        "text-decoration" => get_field("footer_link_text_decoration", "options")
    )
);

$variables->addCssRule(
    "footer a:hover",
    array(
        "color" => get_field("footer_link_color_hover", "options"),
        "text-decoration" => get_field("footer_link_text_decoration_hover", "options")
    )
);

/** Site Info */
$variables->addCssRule(
    "footer .site-info",
    array(
        "background-color" => get_field("site_info_bg_color", "options"),
        "color" => get_field("site_info_font_color", "options")
    )
);

$variables->addCssRule(
    "footer .site-info a",
    array(
        "color" => get_field("site_info_link_color", "options"),
        "text-decoration" => get_field("site_info_link_text_decoration", "options")
    )
);

$variables->addCssRule(
    "footer .site-info a:hover",
    array(
        "color" => get_field("site_info_link_color_hover", "options"),
        "text-decoration" => get_field("site_info_link_text_decoration_hover", "options")
    )
);

$variables->addCssRule(
    "footer .site-info .heart",
    array(
        "color" => get_field("site_info_heart_color", "options")
    )
);

/**
 * Buttons
 */
$variables->addCssRule(
    ":root",
    array(
        /**PRIMARY BUTTON */
        "--primary-button-background-color" => get_field("primary_button", "options")["button_background_color"],
        "--primary-button-font-color" => get_field("primary_button", "options")["button_font_color"],
        "--primary-button-border-color" => get_field("primary_button", "options")["button_border_color"],
        "--primary-button-background-color-hover" => get_field("primary_button", "options")["button_background_color_hover"],
        "--primary-button-font-color-hover" => get_field("primary_button", "options")["button_font_color_hover"],
        "--primary-button-border-color-hover" => get_field("primary_button", "options")["button_border_color_hover"],
        /**SECONDARY BUTTON */
        "--secondary-button-background-color" => get_field("secondary_button", "options")["button_background_color"],
        "--secondary-button-font-color" => get_field("secondary_button", "options")["button_font_color"],
        "--secondary-button-border-color" => get_field("secondary_button", "options")["button_border_color"],
        "--secondary-button-background-color-hover" => get_field("secondary_button", "options")["button_background_color_hover"],
        "--secondary-button-font-color-hover" => get_field("secondary_button", "options")["button_font_color_hover"],
        "--secondary-button-border-color-hover" => get_field("secondary_button", "options")["button_border_color_hover"],
        /**FOOTER BUTTON */
        "--footer-button-background-color" => get_field("footer_button_color", "options")["button_background_color"],
        "--footer-button-font-color" => get_field("footer_button_color", "options")["button_font_color"],
        "--footer-button-border-color" => get_field("footer_button_color", "options")["button_border_color"],
        "--footer-button-background-color-hover" => get_field("footer_button_color", "options")["button_background_color_hover"],
        "--footer-button-font-color-hover" => get_field("footer_button_color", "options")["button_font_color_hover"],
        "--footer-button-border-color-hover" => get_field("footer_button_color", "options")["button_border_color_hover"],
    )
);

$variables->generateCssFile();
