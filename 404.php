<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_image       = get_theme_mod( 'header_image' );
$header_title       = __( 'Page Not Found', 'mokime' );
$header_description = __( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'mokime' );

get_template_part( 'template-parts/content/content-404' );

get_footer();
