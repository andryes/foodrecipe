<?php
/**
 * The template for displaying all single posts
 *
 * Theme Name: Food Recipe
 */
?>

<?php get_header(); ?>
<div class="row loop-sidebar">
	<div class="left-content col-sm-9">
		<?php the_post(); ?>
			<div class="post">
				<h2 class="postname"><?php echo ( trim ( the_title( '', '', 0 ) ) == '' ? '* * ' . __( 'Post have no title', 'foodrecipe' ) . ' * *' : the_title() ); ?></h2>
                <p class="postinfo">
	                <?php _e( 'Posted by', 'foodrecipe' ); ?>
	                <?php the_author_posts_link(); ?> /
	                <?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago'; ?> /
                    <a href="<?php the_permalink(); ?>#comments"><?php echo get_comments_number() . ' ' . __( 'comments', 'foodrecipe' ); ?></a>
	                <?php edit_post_link( __( 'edit', 'foodrecipe' ), ' / ' ); ?>
                </p>
                <p class="cat-tags">
					<?php if ( has_category() ) {
						_e( 'Categories', 'foodrecipe' );
						echo ': ';
						the_category( ', ' );
					} ?>
                </p>
                <p class="cat-tags">
                    <?php the_tags( __( 'Tags: ', 'foodrecipe' ) ); ?>
                </p>
                <div class="entry">
	                <?php if ( has_post_thumbnail() ) { ?>
                        <div class="post-thumb">
			                <?php the_post_thumbnail(); ?>
                        </div><!-- post-thumb -->
	                <?php } ?>
					<?php the_content(); ?>
                    <div class="postpages">
	                    <?php $defaults = array(
                        'before'           => '<p>' . __( 'Pages: &ensp;', 'foodrecipe' ),
                        'after'            => '</p>',
                        'link_before'      => '<span class="current-post-page">',
                        'link_after'       => '</span>',
                        'next_or_number'   => 'number',
                        'separator'        => '&emsp; | &emsp;',
                        'nextpagelink'     => __( 'Next page', 'foodrecipe'),
                        'previouspagelink' => __( 'Previous page', 'foodrecipe' ),
                        'pagelink'         => '%',
                        'echo'             => 1
                        );
	                    wp_link_pages( $defaults ); ?>
                    </div>
                </div><!-- entry -->
                <a name="comments"></a>
				<?php comments_template(); ?>
			</div><!-- post -->
	</div><!-- left-content -->
	<?php get_sidebar(); ?>
</div><!-- row -->
<?php get_footer();
