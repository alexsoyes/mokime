<?php $comments_number = absint( get_comments_number() );  ?>

<div class="comments-header section-inner">

    <p class="h2 comment-reply-title">
		<?php
		if ( ! have_comments() ) {
			esc_html_e( 'Leave a comment', 'mokime' );
		} elseif ( '1' === $comments_number ) {
			/* translators: %s: post title */
			printf( esc_html_x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'mokime' ), esc_html( get_the_title() ) );
		} else {
			echo wp_kses_post( sprintf(
			/* translators: 1: number of comments, 2: post title */
				_nx(
                    '<span itemprop="commentCount">%1$s</span> reply on &ldquo;%2$s&rdquo;',
                    '<span itemprop="commentCount">%1$s</span> replies on &ldquo;%2$s&rdquo;',
                    $comments_number,
                    'comments title',
                    'mokime'
                ),
				number_format_i18n( $comments_number ),
				esc_html( get_the_title() )
			) );
		}
		?>
    </p><!-- .comments-title -->

</div><!-- .comments-header -->