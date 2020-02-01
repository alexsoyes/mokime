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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
			'flex-height' => true
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

	// Add support for custom header image
	add_theme_support( 'custom-header', array(
//	    'default-image'      => get_template_directory_uri() . 'img/default-image.jpg',
		'default-text-color' => '000',
		'width'              => 1000,
		'height'             => 250,
		'flex-width'         => true,
		'flex-height'        => true,
	) );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);

	add_editor_style();

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new MokiMe_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );
}

add_action( 'after_setup_theme', 'mokime_theme_support' );

function mokime_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<p class="h5 is-white is-uppercase has-text-weight-bold">',
		'after_title'   => '</p>',
		'before_widget' => '<div class="%2$s">',
		'after_widget'  => '</div>',
	);

	for ( $i = 1; $i <= 4; $i ++ ) {
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer', 'mokime' ) . " $i",
					'id'          => 'sidebar-footer-' . $i,
					'description' => __( 'Widgets in this area will be displayed in columns.', 'mokime' ),
				)
			)
		);
	}

	unset( $shared_args['before_title'] );
	unset( $shared_args['after_title'] );

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Pre-footer', 'mokime' ),
				'id'          => 'sidebar-pre-footer',
				'description' => __( 'Widgets will be displayed just before the footer.', 'mokime' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'before_title' => '<p class="has-margin-top-3 h4 has-text-grey-dark is-uppercase has-text-weight-bold">',
				'after_title'  => '</p>',
				'name'         => __( 'Single pages', 'mokime' ),
				'id'           => 'sidebar-single',
				'description'  => __( 'Widgets in this area will be display next to content in article.', 'mokime' ),
			)
		)
	);
}

add_action( 'widgets_init', 'mokime_sidebar_registration' );


function mokime_widgets_registration() {
	register_widget( 'MokiMe_Widget_CTA_Post' );
	register_widget( 'MokiMe_Widget_Recent_Posts' );
}

add_action( 'widgets_init', 'mokime_widgets_registration' );


/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/menu.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/svg-icons.php';

require get_template_directory() . '/classes/class-mokime-svg-icons.php';
require get_template_directory() . '/classes/class-mokime-separator-control.php';
require get_template_directory() . '/classes/class-mokime-walker-comment.php';
require get_template_directory() . '/classes/class-mokime-customize.php';
require get_template_directory() . '/classes/class-mokime-walker-menu.php';
require get_template_directory() . '/classes/class-mokime-widget-cta-post.php';
require get_template_directory() . '/classes/class-mokime-widget-recent-posts.php';
require get_template_directory() . '/classes/class-mokime-script-loader.php';

/**
 * Register and Enqueue Styles.
 */
function mokime_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'mokime-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'mokime-style', 'rtl', 'replace' );
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

