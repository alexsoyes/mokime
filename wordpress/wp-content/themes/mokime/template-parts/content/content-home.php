<?php

/**
 * Display the content from the static page
 */
if ( ! is_home() && is_front_page() && have_posts() ) {
	the_post();
	the_content();
}

/**
 * Display the last articles
 */
if ( is_home() && ! is_front_page() || (bool) get_theme_mod( 'homepage_last_posts', true ) ) {

	$recent_posts = get_posts( array(
		'posts_per_page' => 12,
		'offset'         => 0,
		'post_status'    => 'publish'
	) );

	if ( $recent_posts ) {

		echo '<h2 class="title has-text-weight-light">' . __( 'Nos derniers articles', 'mokime' ) . '</h2>';
		echo '<div class="row">';

		foreach ( $recent_posts as $index => $post ) {
			if ( ( $index !== 0 && fmod( $index, 3 ) == 0 ) ) {
				echo '</div><div class="has-margin-top-3 row">';
			}

			setup_postdata( $post );
			get_template_part( 'template-parts/content/content-article' );
		}

		wp_reset_postdata();

		echo '</div>';
	}

	wp_reset_query();
}
