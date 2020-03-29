<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_image        = get_theme_mod( 'header_image' );
$header_title        = get_the_archive_title();
$header_description  = get_the_archive_description();
$header_description .= mokime_get_the_child_categories();

get_template_part( 'template-parts/content/content-archive' );

get_footer();
