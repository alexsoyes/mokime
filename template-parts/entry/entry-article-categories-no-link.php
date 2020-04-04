<?php
/**
 * Display categories with no link.
 *
 * @package mokime
 */

$categories = get_the_category();

foreach ( $categories as $category ) {
	echo wp_kses_post( sprintf( '<li class="tag">%s</li>', $category->name ) );
}
