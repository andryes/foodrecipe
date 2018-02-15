<?php
/**
 * The main template file for content
 *
 * Theme Name: Food Recipe
 */
?>

<?php get_header(); ?>
<div class="row loop-sidebar">
    <div class="left-content col-sm-9 col-xs-12">
	    <?php get_template_part( 'loop' ); ?>
    </div><!-- .left-content -->
	<?php get_sidebar(); ?>
</div><!-- .row .loop-sidebar -->
<?php get_footer();
