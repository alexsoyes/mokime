<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

if ( (bool) get_theme_mod( 'single_post_featured_image', false ) ) {
	$header_image = get_the_post_thumbnail_url( null, 'large' );
}
$header_class         = '';
$header_title         = get_the_title();
$header_description   = get_the_excerpt();
$has_background_image = isset( $header_image ) && ( $header_image && 'remove-header' !== $header_image );

the_post();
get_template_part( 'template-parts/content/content-single' );

get_footer();
