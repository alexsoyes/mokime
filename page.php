<?php
/**
 * Display content type "page".
 *
 * @package mokime
 */

get_header();

global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_class = '';
$header_title = get_the_title();
$header_image = mokime_get_post_thumbnail_url( get_post() );

the_post();
get_template_part( 'template-parts/content/content-page' );


if ( (bool) get_theme_mod( 'performance_enable_only_page_contact_form_7', false ) ) {

	if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
		wpcf7_enqueue_scripts();
	}

	if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
		wpcf7_enqueue_styles();
	}
}

get_footer();
