<?php
/**
 * The footer sidebar containing additional widgets
 *
 * Theme Name: Food Recipe
 */
?>

<div class="wright-sidebar">
	<?php if ( is_active_sidebar( 'foodrecipe-sidebar-footer' ) ) { ?>
        <ul id="sidebar">
			<?php dynamic_sidebar( 'foodrecipe-sidebar-footer' ); ?>
        </ul>
	<?php } ?>
</div><!-- wright-sidebar -->
