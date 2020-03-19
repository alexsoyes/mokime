<?php

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_class = ' has-text-align-center';
$header_image = get_theme_mod( 'header_image' );
$header_title = sprintf( '<span class="has-text-weight-bold">' . __( 'Searching for', 'mokime' ) . '</span> "%s"', get_search_query() );

get_template_part( 'template-parts/content/content-search' );

get_footer();
