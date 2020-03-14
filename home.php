<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_class         = ' has-text-align-center';
$header_image         = get_header_image();
$header_title         = get_bloginfo( 'name' );
$header_description   = get_bloginfo( 'description' );
$has_background_image = isset( $header_image ) && ( $header_image && 'remove-header' !== $header_image );

get_template_part( 'template-parts/content/content-home' );

get_footer();

?>

potentialAction

@type

SearchAction
target

@type

EntryPoint
urlTemplate

https://www.security-helpzone.com/?s={search_term_string}
query-input

@type

PropertyValueSpecification
valueRequired

http://schema.org/True
valueName

search_term_string
