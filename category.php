<?php
/**
 * The template for displaying category pages
 *
 * Theme Name: Food Recipe
 */
?>

<?php get_header(); ?>
    <div class="row loop-sidebar">
        <div class="left-content col-sm-9">
			<?php if ( have_posts() ) { ?>
                <div class="search-header">
					<?php the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
                </div><!-- search-header -->
				<?php get_template_part( 'loop' ); ?>
			<?php } else { ?>
                <div class="search-not-found">
                    <h1><?php _e( 'Sorry, No Posts Found', 'foodrecipe' ); ?></h1>
                </div>
                <div class="page-content not-found">
                    <p>
						<?php _e( 'You can visit our ', 'foodrecipe' ); ?>
                        <a href="<?php echo get_home_url(); ?>" class="homepage"><?php _e( 'main page', 'foodrecipe' ) ?></a>
						<?php _e( ' or try again with another keywords:', 'foodrecipe' ); ?>
                    </p>
					<?php get_search_form(); ?>
                </div>
			<?php } ?>
        </div><!-- left-content col-sm-9 -->
		<?php get_sidebar(); ?>
    </div><!-- row loop-sidebar -->
<?php get_footer();
