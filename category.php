<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_image = get_theme_mod( 'header_image' );
$header_title = single_cat_title( '', false );

if ( ! is_paged() ) {
	$header_description  = get_the_archive_description();
	$header_description .= mokime_get_the_child_categories();
} else {
	global $wp_query;
	$header_description = sprintf(
		'<p class="h4 tag tag-primary">Page %d / %d</p>',
		$paged,
		$wp_query->max_num_pages
	);
}

get_template_part( 'template-parts/content/content-archive' );

get_footer();
