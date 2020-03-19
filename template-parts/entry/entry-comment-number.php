<?php if ( comments_open()  ): ?>

	<?php $comments_number = absint( get_comments_number() ); ?>

	<a href="#<?php echo $comments_number > 0 ? 'comments' : 'respond'; ?>" title="<?php esc_html_e( 'Go to comments', 'mokime' ); ?>">

		<img src="<?php mokime_the_asset('icon', 'chatbox-ellipses-outline.svg' ); ?>"
		     class="icon" aria-hidden="true"
		     alt="<?php esc_html_e( 'Comments number', 'mokime' ); ?>">

		<?php
		if ( 0 === $comments_number ) {
			esc_html_e( 'Add a comment', 'mokime' );
		} else {
			echo wp_kses_post(
				sprintf(
				/* translators: 1: number of comments */
					_nx(
						'%1$s comment',
						'%1$s comments',
						$comments_number,
						'comments count',
						'mokime'
					),
					number_format_i18n( $comments_number )
				)
			);
		}
		?>
	</a>

<?php endif; ?>
