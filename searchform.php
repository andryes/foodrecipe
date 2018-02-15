<?php
/**
 * Searchform used in sidebar / 404 / search etc.
 *
 * Theme Name: Food Recipe
 */
?>

<div class="search-in-blog">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search in Blog', 'placeholder', 'foodrecipe' ) ?>"
           value="<?php echo get_search_query() ?>"
           name="s" title="<?php echo esc_attr_x( 'Search for', 'label', 'foodrecipe' ) ?>">
        <input type="submit" class="search-submit" value="">
    </form>
</div>
