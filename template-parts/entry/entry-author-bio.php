<?php
/**
 * Show the author biography on post.
 *
 * @package mokime
 */

?>
<div class="author-box has-text-align-center
	 <?php
		if ( ! (bool) get_theme_mod( 'single_post_author_bio', true ) ) :
			?>
			 display-none<?php endif; ?>">

	<figure class="author-image">
		<?php
		echo get_avatar(
			get_the_author_meta( 'ID' ),
			96,
			'',
			get_the_author()
		);
		?>
	</figure><!-- .author-image -->

	<?php
    $wpseo             = get_option( 'wpseo_titles' );
    $index_author_page = false;

	if ( is_array( $wpseo ) && array_key_exists( 'noindex-author-wpseo', $wpseo ) ) {
		$index_author_page = true === $wpseo['noindex-author-wpseo'];
	}
	?>

	<div class="media-content-center content">

		<p class="h3 has-text-weight-bold"><?php echo esc_html( get_the_author() ); ?></p>

		<div class="author-description">
            <div>
                <?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
            </div>
			<a class="author-link"
			   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
			   rel="author<?php if ( $index_author_page ) :?> nofollow<?php endif; ?>">
				<?php
                // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction
				_e( 'View Archive <span aria-hidden="true">&rarr;</span>', 'mokime' );
				?>
			</a>
		</div><!-- .author-description -->

	</div><!-- .media-content-center -->

</div><!-- .author-box -->
