<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_class = ' has-text-align-center';
$header_image = get_header_image();

/**
 * Display the page title if front page.
 */
if ( ! is_home() && is_front_page() ) {
	$header_title = get_the_title();
}

/**
 * Display title and tag line if checked in customizer.
 */
if ( display_header_text() === true ) {
	if ( ! isset( $header_title ) ) {
		$header_title = get_bloginfo( 'name' );
	}
	$header_description = get_bloginfo( 'description' );
}

$has_background_image = isset( $header_image ) && ( $header_image && 'remove-header' !== $header_image );

get_template_part( 'template-parts/content/content-home' );

get_footer();
