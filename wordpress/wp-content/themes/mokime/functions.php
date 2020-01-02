<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mokime_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'mokime-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 180;
	$logo_height = 60;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'mokime' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mokime' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
//	if ( is_customize_preview() ) {
//		require get_template_directory() . '/inc/starter-content.php';
//		add_theme_support( 'starter-content', mokime_get_starter_content() );
//	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
//	$loader = new mokime_Script_Loader();
//	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'mokime_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/menu.php';
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/classes/class-mokime-separator-control.php';
require get_template_directory() . '/classes/class-mokime-customize.php';
require get_template_directory() . '/classes/class-mokime-walker-menu.php';

/**
 * Register and Enqueue Styles.
 */
function mokime_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'mokime-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'mokime-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
//	wp_add_inline_style( 'mokime-style', mokime_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'mokime-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'mokime_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function mokime_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'mokime-js', get_template_directory_uri() . '/assets/js/menu.js', array(), $theme_version, false );
	wp_enqueue_script( 'mokime-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'mokime-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'mokime_register_scripts' );

