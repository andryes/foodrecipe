<?php
/**
 * The template for displaying pages
 *
 * Theme Name: Food Recipe
 */
?>

<?php get_header(); ?>
<div class="row loop-sidebar">
    <div class="left-content col-sm-9">
		<?php the_post(); ?>
        <div class="post">
            <h2 class="postname"><?php the_title(); ?></h2>
            <p class="postinfo"><?php edit_post_link( __( 'edit', 'foodrecipe' ) ); ?></p>
            <div class="entry">
				<?php the_content(); ?>
                <div class="postpages">
					<?php $defaults = array(
						'before'           => '<p>' . __( 'Pages: &ensp;', 'foodrecipe' ),
						'after'            => '</p>',
						'link_before'      => '<span class="">',
						'link_after'       => '</span>',
						'next_or_number'   => 'number',
						'separator'        => '&emsp; | &emsp;',
						'nextpagelink'     => __( 'Next page', 'foodrecipe' ),
						'previouspagelink' => __( 'Previous page', 'foodrecipe' ),
						'pagelink'         => '%',
						'echo'             => 1
					);
					wp_link_pages( $defaults ); ?>
                </div>
            </div><!-- entry -->
			<?php comments_template(); ?>
        </div><!-- post -->
    </div><!-- left-content -->
	<?php get_sidebar(); ?>
</div><!-- row -->
<?php get_footer();
