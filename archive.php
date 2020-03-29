<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_image       = get_theme_mod( 'header_image' );
$header_title       = get_the_archive_title();
$header_description = get_the_archive_description();

if ( is_category() ) {
	/** @var int $id */
	$id = get_query_var( 'cat' );

	$categories = get_categories(
		array( 'parent' => $id )
	);

	if ( ! empty( $categories ) ) {
		$category_ids = array();

		/** @var WP_Term $category the child category. */
		foreach ( $categories as $category ) {
			array_push( $category_ids, $category->term_id );
		}
		$header_description .= sprintf(
			'<h2>%s</h2><ul>%s</ul>',
			esc_html__( 'Child categories', 'mokime' ),
			wp_list_categories(
				array(
					'echo'     => false,
					'title_li' => false,
					'orderby'  => 'name',
					'include'  => $category_ids,
				)
			)
		);
	}
}

get_template_part( 'template-parts/content/content-archive' );

get_footer();
