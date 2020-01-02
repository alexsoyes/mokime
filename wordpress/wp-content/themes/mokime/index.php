<?php

get_header();

if ( is_home() || is_front_page() ) {
	get_template_part( 'template-parts/content/content-home' );
}

get_footer();

