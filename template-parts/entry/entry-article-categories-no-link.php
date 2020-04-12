<?php
/**
 * Display categories with no link.
 *
 * @package mokime
 */

$categories = get_the_category();

if ( ! empty( $categories ) ) {
	echo '<ul class="tags">';
}

foreach ( $categories as $category ) {
	echo wp_kses_post( sprintf( '<li class="tag">%s</li>', $category->name ) );
}

if ( ! empty( $categories ) ) {
	echo '</ul>';
}
