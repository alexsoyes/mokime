<?php


$categories = get_the_category();

foreach( $categories as $category ) {
	$category_link = sprintf(
		'<a href="%1$s" title="%2$s" class="button is-info is-rounded is-small is-small-text has-padding-x-2 has-margin-right-2" itemprop="about" >%3$s</a>',
		esc_url( get_category_link( $category->term_id ) ),
		esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
		esc_html( $category->name )
	);
	echo $category_link;
}
