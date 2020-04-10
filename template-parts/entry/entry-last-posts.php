<?php
/**
 * Display the last posts.
 *
 * @package mokime
 */

$recent_posts = mokime_get_the_last_posts();

if ( $recent_posts ) {

	echo '<h2 class="custom-title">' . esc_html__( 'Our last posts', 'mokime' ) . '</h2>';
	echo '<div class="wp-block-columns">';

    // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	foreach ( $recent_posts as $index => $post ) {

		if ( 0 !== $index && 0 === ( $index % 3 ) ) {
			echo '</div><!-- .wp-block-columns --><div class="wp-block-columns">';
		}

		setup_postdata( $post );
		get_template_part( 'template-parts/entry/entry-article' );
	}

	wp_reset_postdata();

	echo '</div><!-- .wp-block-columns -->';

	$blog_url = get_permalink( get_option( 'page_for_posts' ) );

	if ( ( ! $blog_url ) ) {
		echo sprintf(
			'<div class="more-posts has-text-align-center"><a href="%1$s" class="button">%2$s</a></div>',
			esc_url( $blog_url ),
			esc_html__( 'More posts', 'mokime' )
		);
	}
}

wp_reset_postdata();
