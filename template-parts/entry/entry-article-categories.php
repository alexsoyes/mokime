<?php

$categories = get_the_category();

if ( $categories ) {
	echo '<div class="tags categories">';
}

foreach ( $categories as $category ) {
	$category_link = sprintf(
		'<a href="%1$s" title="%2$s" class="tag">%3$s</a>',
		esc_url( get_category_link( $category->term_id ) ),
		sprintf(
		/* translators: %s: name of the category */
			esc_html__( 'View all posts in %s', 'mokime' ),
			esc_html( $category->name )
		),
		esc_html( $category->name )
	);
	echo wp_kses_post( $category_link );
}

if ( $categories ) {
	echo '</div><!-- .categories -->';
}
