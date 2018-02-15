<?php
/**
 * The sidebar containing the widget area
 *
 * Theme Name: Food Recipe
 */
?>

<div class="wright-sidebar col-sm-3">
	<?php if ( is_active_sidebar( 'foodrecipe-sidebar' ) ) { ?>
        <ul id="sidebar">
			<?php dynamic_sidebar( 'foodrecipe-sidebar' ); ?>
        </ul>
	<?php } ?>
</div><!-- wright-sidebar -->
