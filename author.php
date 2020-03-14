<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_image       = get_theme_mod( 'header_image' );
$header_title       = get_the_archive_title();
$header_description = '';

$author_description = get_the_author_meta( 'description' );
$author_url         = get_the_author_meta( 'url' );

if ( $author_description ) {
	$header_description .= sprintf( '<p>%1$s</p>', $author_description );
}

if ( $author_url ) {
	$header_description .= sprintf( '<p><a href="%1$s" class="tag" target="_blank">%1$s</a></p>', $author_url );
}

get_template_part( 'template-parts/content/content-archive' );

get_footer();
