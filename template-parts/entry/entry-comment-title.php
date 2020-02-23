<?php $comments_number = absint( get_comments_number() );  ?>

<div class="comments-header section-inner">

    <p class="h2 comment-reply-title">
		<?php
		if ( ! have_comments() ) {
			_e( 'Leave a comment', 'mokime' );
		} elseif ( '1' === $comments_number ) {
			/* translators: %s: post title */
			printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'mokime' ), esc_html( get_the_title() ) );
		} else {
			echo sprintf(
			/* translators: 1: number of comments, 2: post title */
				_nx(
					'%1$s reply on &ldquo;%2$s&rdquo;',
					'%1$s replies on &ldquo;%2$s&rdquo;',
					$comments_number,
					'comments title',
					'mokime'
				),
				number_format_i18n( $comments_number ),
				esc_html( get_the_title() )
			);
		}
		?>
    </p><!-- .comments-title -->

</div><!-- .comments-header -->