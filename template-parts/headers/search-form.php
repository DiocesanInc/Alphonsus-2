<?php

/**
 * Partial for the search form in the navbar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */
?>

<li class="mega-menu-item search-container mobile-search">
    <form role="search" class="search-form" method="GET" action=<?php echo home_url(); ?>>
        <label for="s">
            <span class="screen-reader-text">Search for:</span>
            <input type="search" class="search-field" placeholder="Search" name="s" title="Search for:" />
            <span class=""></span>
        </label>
        <button type="submit" class="search-submit" value="Search">
            <i class='header-search fa fa-search'></i>
        </button>
    </form>
</li>
<li class="mega-menu-item search-container desktop-search">
    <i class='header-search fa fa-search'></i>
    <form role="search" class="search-form" method="GET" action=<?php echo home_url(); ?>>
        <label for="s">
            <span class="screen-reader-text">Search for:</span>
            <input type="search" class="search-field" placeholder="Search" name="s" title="Search for:" />
        </label>
        <button type="submit" class="search-submit" value="Search">
            Search
        </button>
    </form>
</li>