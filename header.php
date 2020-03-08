<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="https://gmpg.org/xfn/11"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php
	global $header_class, $header_image, $header_title, $header_description, $has_background_image;

	$header_class         = ' has-text-align-center';
	$header_image         = get_header_image();
	$header_title         = get_bloginfo( 'name' );
	$header_description   = get_bloginfo( 'description' );
	$has_background_image = isset( $header_image ) && ( $header_image && 'remove-header' !== $header_image );

	if ( is_single() ) {
	} elseif ( is_page() && ( ! is_home() && ! is_front_page() ) ) {
		$header_title = get_the_title();
		$header_image = mokime_get_post_thumbnail_url( get_post() );
	} elseif ( is_archive() ) {
		$header_image       = get_theme_mod( 'header_image' );
		$header_title       = get_the_archive_title();
		$header_description = get_the_archive_description();
	} elseif ( is_404() ) {
		$header_image       = get_theme_mod( 'header_image' );
		$header_title       = __( 'Page Not Found', 'mokime' );
		$header_description = __( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'mokime' );
	} elseif ( is_search() ) {
		$header_image       = get_theme_mod( 'header_image' );
		$header_title       = sprintf( '<span class="has-text-weight-bold">' . __( 'Searching for', 'mokime' ) . '</span> "%s"', get_search_query() );
		$header_description = '';
	} else { // homepage
		$header_class       = ' has-text-align-center';
		$header_image       = get_header_image();
		$header_title       = get_bloginfo( 'name' );
		$header_description = get_bloginfo( 'description' );
	}

	$has_background_image = isset( $header_image ) && ( $header_image && 'remove-header' !== $header_image );
	?>


	<header id="masthead" role="banner" class="site-header entry-content">

		<?php get_template_part( 'template-parts/header/menu' ); ?>

	</header><!-- #masthead -->

	<main id="site-content" role="main">
