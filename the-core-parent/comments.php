<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}

$the_core_commenter     = wp_get_current_commenter();
$the_core_aria_required = get_option( 'require_name_email' ) ? " aria-required='true'" : '';
$the_core_permalink     = get_permalink();
$the_core_comments_type = defined( 'FW' ) ? fw_get_db_settings_option( 'posts_settings/comments_type', 'comments-template-1' ) : 'comments-template-1';

$args = array(
	'id_form'              => 'addcomments',
	'id_submit'            => 'submit',
    'class_submit'         => 'submit fw-btn fw-btn-1 fw-btn-md',
	'title_reply'          => esc_html__('Leave your comment', 'the-core' ),
	'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'the-core' ),
	'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'the-core' ),
	'label_submit'         => esc_html__( 'Submit Comment', 'the-core' ),
	'comment_field'        => '<div class="right-side-comment">
		<p class="comment-form-comment">
			<label for="comment">' . esc_html__( 'Comment', 'the-core' ) . ' <span class="required-label">*</span></label>
			<textarea id="comment" name="comment" class="required" required></textarea>
		</p>
	</div>',
	'must_log_in'          => '<p class="must-log-in">' . sprintf(
									esc_html__( 'You must be', 'the-core').' <a href="%s">'. esc_html__('logged in', 'the-core').'</a> '. esc_html__('to post a comment.', 'the-core' ),
									wp_login_url( apply_filters( 'the_permalink', $the_core_permalink ) )
								) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
									esc_html__( 'Logged in as', 'the-core').' <a href="%1$s">%2$s</a>. <a href="%3$s" title="'.esc_html__('Log out of this account', 'the-core').'">'.esc_html__('Log out?', 'the-core').'</a>',
									admin_url( 'profile.php' ),
									$user_identity,
									wp_logout_url( apply_filters( 'the_permalink', $the_core_permalink ) )
								) . '</p>',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'fields'               => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="left-side-comment">
			<p class="comment-form-author">
				<label for="author">' . esc_html__( 'Display Name', 'the-core' ) . ' <span class="required-label">*</span></label>
				<input type="text" id="author" name="author" class="required" '.$the_core_aria_required.' />
			</p>',
		'email'  => '
			<p class="comment-form-email">
				<label for="email">' . esc_html__( 'Email Address', 'the-core' ) . ' <span class="required-label">*</span></label>
				<span class="optional">' . esc_html__( '(will not be shared)', 'the-core' ) . '</span>
				<input type="email" id="email" name="email" class="required" '.$the_core_aria_required.' />
			</p>
		</div>',
		)
	),
);
?>
<div class="fw-row">
	<div id="comments" class="comments-area <?php echo esc_attr($the_core_comments_type); ?> <?php if ( is_user_logged_in() ) {echo 'user-is-logged';} ?>">
		<h3 class="comments-title">
            <?php if($the_core_comments_type == 'comments-template-1' ) : ?>
			    <strong><?php comments_number( esc_html__( 'no replies', 'the-core' ), esc_html__( '1 reply added', 'the-core' ), esc_html__( '% replies added', 'the-core' ) ); ?></strong>
            <?php else: ?>
                <strong><?php comments_number( esc_html__( '0 Comments', 'the-core' ), esc_html__( '1 Comment', 'the-core' ), esc_html__( '% Comments', 'the-core' ) ); ?></strong>
            <?php endif; ?>
		</h3>

		<?php if ( have_comments() ) : ?>
			<ol class="comment-list">
				<?php get_template_part( 'templates/comments/'.$the_core_comments_type ); ?>
				<?php wp_list_comments( array( 'callback' => 'fw_theme_comment' ) ); ?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-below" class="navigation paging-navigation comment-navigation" role="navigation">
					<div class="pagination loop-pagination">
						<?php paginate_comments_links( array(
							'prev_text' => '<i class="fa fa-angle-left"></i><span>' . esc_html__( 'Previous', 'the-core' ) . '</span>',
							'next_text' => '<i class="fa fa-angle-right"></i><span>' . esc_html__( 'Next', 'the-core' ) . '</span>'
						) ); ?>
					</div>
				</nav>
			<?php endif; // Check for comment navigation. ?>

			<?php if ( ! comments_open() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'the-core' ); ?></p>
			<?php endif; ?>
		<?php endif; // have_comments() ?>

		<?php comment_form( $args ); ?>
	</div><!-- #comments -->
</div><!-- /.row -->