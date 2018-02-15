<?php
/**
 * The template for displaying 404 page (not found)
 *
 * Theme Name: Food Recipe
 */
?>

<?php get_header(); ?>
<div class="left-content">
    <div class="search-not-found">
        <h1 class="page-title"><?php _e( '404. That page can&rsquo;t be found', 'foodrecipe' ); ?></h1>
    </div><!-- search-not-found -->
    <div class="page-content not-found">
        <p>
            <?php _e( 'Sorry, nothing was found at this location. Please try a search or visit our ', 'foodrecipe' ); ?>
            <a href="<?php echo get_home_url(); ?>" class="homepage"><?php _e('main page', 'foodrecipe') ?></a>
        </p>
		<?php get_search_form(); ?>
    </div><!-- page-content -->
</div><!-- left-content -->
<?php get_footer();
