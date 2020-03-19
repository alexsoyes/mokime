<?php
/**
 *
 * @package WordPress
 * @subpackage MokiMe
 * @from Twenty_Twenty
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

if ( $comments ) {
	?>

	<div class="comments" id="comments">

		<?php get_template_part( 'template-parts/entry/entry-comment-title' ); ?>

		<div class="comments-inner section-inner thin max-percentage">

			<?php
			wp_list_comments(
				array(
					'walker'      => new MokiMe_Walker_Comment(),
					'avatar_size' => 64,
					'style'       => 'div',
				)
			);

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __( 'Newer Comments', 'mokime' ) . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __( 'Older Comments', 'mokime' ),
				)
			);

			if ( $comment_pagination ) {
				$pagination_classes = '';

				// If we're only showing the "Next" link, add a class indicating so.
				if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
					$pagination_classes = ' only-next';
				}
				?>

				<nav class="comments-pagination pagination<?php echo $pagination_classes; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>"
					 aria-label="<?php esc_attr_e( 'Comments', 'mokime' ); ?>">
					<?php echo wp_kses_post( $comment_pagination ); ?>
				</nav><!-- .comments-pagination -->

				<?php
			}
			?>

		</div><!-- .comments-inner -->

	</div><!-- comments -->

	<?php
}

if ( comments_open() || pings_open() ) {

	if ( $comments ) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	mokime_the_ads( 'advertising_post_comments_bottom' );

	comment_form(
		array(
			'class_form'         => 'section-inner thin max-percentage',
			'title_reply_before' => '<p id="reply-title" class="h3 has-text-weight-bold comment-reply-title">',
			'title_reply_after'  => '</p>',
		)
	);

} elseif ( is_single() ) {

	if ( $comments ) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	?>

	<div class="comment-respond" id="respond">

		<p class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'mokime' ); ?></p>

	</div><!-- #respond -->

	<?php
}
