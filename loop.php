<?php
/**
 * The loop used for displaying related posts
 *
 * Theme Name: Food Recipe
 */
?>

<?php if ( have_posts() ) { ?>
    <div class="foodrecipe-content-meta row">
        <div class="col-sm-6 col-xs-12">
		    <?php global $wp_query;
		    echo '<h2>' . $wp_query->found_posts . ' ';
		    $wp_query->post_count == 1 ? _e( 'post', 'foodrecipe' ) : _e( 'posts', 'foodrecipe' );
		    echo ' ';
            _e( 'found', 'foodrecipe' );
		    echo '</h2>'; ?>
        </div><!-- col-sm-6 -->
        <div class="col-sm-6 col-xs-12 display">
            <form action="" method="POST">
                <div class="count-display">
					<?php $current_count = isset( $_SESSION['foodrecipe_count_post'] ) && $_SESSION['foodrecipe_count_post'] > 0 ? $_SESSION['foodrecipe_count_post'] : ''; ?>
                    <select class="selectpicker">
                        <option value="">
                            <?php _e( 'Show ', 'foodrecipe' );
							if ( $current_count == 1 ) {
								echo ' 1 ';
								_e( 'item', 'foodrecipe' );
							} elseif ( $current_count > 1 ) {
								echo $current_count . ' ';
								_e( 'items', 'foodrecipe' );
							} else {
	                            _e( 'items', 'foodrecipe' );
							}; ?>
                        </option>
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
					<?php if ( 'posts' == get_option( 'show_on_front' ) ) { ?>
                        <input type="hidden" id="reload_url" value="<?php echo home_url( '/' ); ?>"/>
					<?php } else { ?>
                        <input type="hidden" id="reload_url" value="<?php echo get_the_permalink( get_option( 'page_for_posts' ) ); ?>"/>
					<?php } ?>
                </div><!-- count-display -->
                <div class="sort-display">
					<?php $current_sort = isset( $_SESSION['foodrecipe_sort_post'] ) ? $_SESSION['foodrecipe_sort_post'] : ''; ?>
                    <select class="selectpicker">
                        <option value="">
                            <?php _e('Sort By', 'foodrecipe');
                            echo ' ' . ucfirst( $current_sort ); ?>
                        </option>
                        <option value="title"><?php _e( 'Title', 'foodrecipe' ); ?></option>
                        <option value="author"><?php _e( 'Author', 'foodrecipe' ); ?></option>
                        <option value="date"><?php _e( 'Date', 'foodrecipe' ); ?></option>
                    </select>
                </div><!-- sort-display -->
            </form>
            <span class="ajax-loader" data-toggle="modal" data-target="#foodrecipe-loader"></span>
            <div id="foodrecipe-loader" class="modal fade" role="dialog">
                <div class="loader"></div>
            </div><!-- modal fade -->
        </div>
    </div><!-- foodrecipe-content-meta row -->
	<?php while ( have_posts() ) { // Posts output start
		the_post(); ?>
        <div <?php post_class(); ?>>
            <h2 class="postname">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to post ', 'foodrecipe' ); ?><?php the_title_attribute(); ?>">
					<?php echo( trim( the_title( '', '', 0 ) ) == '' ? '* * ' . __( 'Post have no title', 'foodrecipe' ) . ' * *' : the_title() ); ?>
                </a>
            </h2>
            <p class="postinfo">
				<?php if ( is_page( '' ) ) {
					edit_post_link( __( 'edit', 'foodrecipe' ) );
				} else { ?>
                    <?php _e( 'Posted by', 'foodrecipe' ); ?>
                    <?php the_author_posts_link(); ?> /
					<?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago'; ?> /
                    <a href="<?php the_permalink(); ?>#comments"><?php echo get_comments_number() . ' ' . __( 'comments', 'foodrecipe' ); ?></a>
					<?php edit_post_link( __( 'edit', 'foodrecipe' ), ' / ' ); ?>
				<?php } ?>
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
			<?php if ( has_post_thumbnail() ) { ?>
                <div class="post-thumb">
					<?php the_post_thumbnail(); ?>
                </div><!-- post-thumb -->
			<?php } ?>
            <div class="entry">
				<?php if ( 'gallery' == get_post_format() ) {
					$gallery = get_post_gallery( get_the_ID(), false );
					if ( isset( $gallery['ids'] ) ) {
						$gallery_ids = explode( ',', $gallery['ids'] );
					} else {
						$media       = get_attached_media( 'image' );
						$gallery_ids = array_keys( $media );
					}
					if ( ! empty( $gallery_ids ) ) { ?>
                        <div class="gallery-pics row">
							<?php foreach ( $gallery_ids as $image ) { ?>
                                <div class="each-pic col-sm-6 col-xs-6">
									<?php echo wp_get_attachment_image( $image, 'foodrecipe-gallery' ); ?>
                                </div><!-- each-pic -->
							<?php } ?>
                        </div><!-- gallery-pics -->
                        <div class="post-btn"><a class="btn read-post" href="<?php the_permalink(); ?> "><?php _e( 'VIEW MORE', 'foodrecipe' ); ?></a></div>
					<?php } else {
						the_content();
					}
				} else {
	                if ( has_excerpt() ) {
		                the_excerpt();
	                } else {
		                the_content();
	                }
				} ?>
            </div><!-- entry -->
        </div><!-- post_class() -->
	<?php } // Posts output end
	global $wp_query; ?> <!-- Pagination -->
    <div class="pagination-foodrecipe big-pagination">
		<?php $big = 9999999999;
		$args      = array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'total'     => $wp_query->max_num_pages,
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'show_all'  => false,
			'end_size'  => 1,
			'mid_size'  => 2,
			'prev_next' => true,
			'prev_text' => '<',
			'next_text' => '>',
			'type'      => 'plain',
			'add_args'  => false
		);
		echo paginate_links( $args ); ?>
    </div><!-- pagination-foodrecipe -->
    <div class="pagination-foodrecipe small-pagination">
		<?php $args['mid_size'] = 1;
		echo paginate_links( $args ); ?>
    </div><!-- pagination-foodrecipe -->
<?php } else { ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'foodrecipe' ); ?></p>
<?php }
