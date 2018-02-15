<?php
/**
 * The template for displaying comments
 *
 * Theme Name: Food Recipe
 */
?>

<?php if ( post_password_required() ) {
	return;
} ?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) { ?>
        <h2 class="comments-title">
			<?php _e('COMMENTS', 'foodrecipe');
            echo ' (' . get_comments_number() . ')'; ?>
        </h2><!-- comments-title -->
        <ol class="comment-list">
			<?php function foodrecipe_comment( $comment, $args, $depth ) {
				$GLOBALS['comment'] = $comment; ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div id="comment-<?php comment_ID(); ?>">
						<?php echo get_avatar( $comment ); ?>
                        <div class="comments-top">
                            <div class="comment-author vcard">
								<?php echo get_comment_author_link(); ?>
                            </div><!-- comment-author -->
                            <div class="reply">
								<?php comment_reply_link( array_merge( $args, array(
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								) ) ) ?>
                            </div><!-- reply -->
                        </div><!-- comments-top -->
						<?php if ( $comment->comment_approved == '0' ) { ?>
                            <em><?php _e('Your comment is awaiting moderation', 'foodrecipe'); ?></em>
                            <br/>
						<?php } ?>
						<?php comment_text(); ?>
                        <div class="comment-meta commentmetadata">
							<?php printf( _x( '%s ago', '%s = human-readable time difference', 'foodrecipe' ),
                                human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
							<?php edit_comment_link( 'edit', ' (', ')' ) ?>
                        </div><!-- .comment-meta -->
                    </div>
                </li>
			<?php } ?>

			<?php wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 56,
				'callback'    => 'foodrecipe_comment',
			) ); ?>

        </ol><!-- comment-list -->

        <div class="commpages"><?php paginate_comments_links(); ?></div>

	<?php } // have_comments() ?>

	<?php if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
        <p class="no-comments"><?php _e( 'Comments are closed', 'foodrecipe' ); ?></p>
	<?php } ?>

</div><!-- comments-area -->

<?php $defaults = array(
	'fields'               => array(
		'author' => '<div class="form-group formfield"><input id="author" type="text" name="author" class="form-control first-field" placeholder="Username"></div>',
		'email'  => '<div class="form-group formfield"><input id="email" type="email" name="email" class="form-control second-field" placeholder="Your email*"></div>',
		'url'    => '<div class="form-group formfield"><input id="url" type="text" name="url" class="form-control third-field" placeholder="Your website"></div>',
	),
	'comment_field'        => '<div class="form-group">
                                   <label for="comment"></label>
                                   <textarea name="comment" id="comment" cols="30" rows="8" class="form-control fourth-field" placeholder="Your message"></textarea>
                               </div>',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'class_form'           => 'comment-form',
	'class_submit'         => 'submit',
	'name_submit'          => 'submit',
	'title_reply'          => __( 'Leave a comment ', 'foodrecipe' ),
	'title_reply_to'       => __( 'Leave a Reply to %s ', 'foodrecipe' ),
	'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
	'title_reply_after'    => '</h3>',
	'cancel_reply_before'  => '<small>',
	'cancel_reply_after'   => '</small>',
	'cancel_reply_link'    => __( '(Cancel reply)', 'foodrecipe' ),
	'label_submit'         => __( 'Post Comment', 'foodrecipe' ),
	'submit_button'        => '<button type="submit" name="leave-a-comment" class="leave-a-comment">LEAVE A COMMENT</button>',
	'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
	'format'               => 'xhtml',
	'logged-in-as'         => '',
);

comment_form( $defaults );
