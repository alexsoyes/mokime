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
			'default-color' => 'ffffff',
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
		)
	);

	// Load translations
	load_theme_textdomain( 'mokime', get_template_directory() . '/languages' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	add_theme_support(
		'custom-header',
		apply_filters(
			'mokime_custom_header_args',
			array(
				'default-image' => get_parent_theme_file_uri( '/assets/img/mokime-custom-header.jpg' ),
				'width'         => 1920,
				'height'        => 1080,
				'flex-width'    => true,
				'flex-height'   => true,
			)
		)
	);

	register_default_headers(
		array(
			'default-image' => array(
				'url'           => '%s/assets/img/mokime-custom-header.jpg',
				'thumbnail_url' => '%s/assets/img/mokime-custom-header.jpg',
				'description'   => esc_html__( 'Default Header Image', 'mokime' ),
			),
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

/**
 * Register default header image
 */
register_default_headers(
	array(
		'default-image' => array(
			'url'           => get_template_directory_uri() . '/assets/img/mokime-custom-header.jpg',
			'thumbnail_url' => get_template_directory_uri() . '/assets/img/mokime-custom-header.jpg',
			'description'   => '',
		),
	)
);

/**
 * Check performance options in customizer
 */
function mokime_performance_setup() {
	if ( (bool) get_theme_mod( 'performance_remove_generator', false ) ) {
		remove_action( 'wp_head', 'wp_generator' );
	}
	if ( (bool) get_theme_mod( 'performance_remove_wlwmanifest_link', false ) ) {
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}
	if ( (bool) get_theme_mod( 'performance_remove_random_post_link', false ) ) {
		remove_action( 'wp_head', 'start_post_rel_link', 10 );
	}
	if ( (bool) get_theme_mod( 'performance_remove_parent_post_rel_link', false ) ) {
		remove_action( 'wp_head', 'parent_post_rel_link', 10 );
	}
	if ( (bool) get_theme_mod( 'performance_remove_emoji', false ) ) {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		add_filter( 'emoji_svg_url', '__return_false' );
	}
	if ( (bool) get_theme_mod( 'performance_remove_shortlink', false ) ) {
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	}
	if ( (bool) get_theme_mod( 'performance_disable_json_api', false ) ) {
		// Filters for WP-API version 1.x
		add_filter( 'json_enabled', '__return_false' );
		add_filter( 'json_jsonp_enabled', '__return_false' );

		// Filters for WP-API version 2.x
		add_filter( 'rest_enabled', '__return_false' );
		add_filter( 'rest_jsonp_enabled', '__return_false' );
	}
	if ( (bool) get_theme_mod( 'performance_disable_embed_posts', false ) ) {
		// Remove the REST API lines from the HTML Header
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

		// Remove the REST API endpoint.
		remove_action( 'rest_api_init', 'wp_oembed_register_route' );

		// Turn off oEmbed auto discovery.
		add_filter( 'embed_oembed_discover', '__return_false' );

		// Don't filter oEmbed results.
		remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

		// Remove oEmbed discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

		// Remove oEmbed-specific JavaScript from the front-end and back-end.
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );

		// Remove all embeds rewrite rules.
		add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	}
	if ( (bool) get_theme_mod( 'performance_remove_wc_generator_tag', false ) ) {
		remove_action( 'wp_head', 'wc_generator_tag' );
	}
	if ( (bool) get_theme_mod( 'performance_enable_only_page_contact_form_7', false ) ) {
		add_filter( 'wpcf7_load_js', '__return_false' );
		add_filter( 'wpcf7_load_css', '__return_false' );
	}
	if ( (bool) get_theme_mod( 'performance_disable_gravatar', false ) ) {
		add_filter( 'avatar_defaults', '__return_empty_array' );
		add_filter( 'default_avatar_select', '__return_empty_string' );
	}
	if ( (bool) get_theme_mod( 'performance_reduce_jpeg_quality', false ) ) {
		add_filter(
			'jpeg_quality',
			'mokime_jpeg_quality'
		);
	}
}

function mokime_jpeg_quality() {
	return 80;
}

add_action( 'after_setup_theme', 'mokime_performance_setup' );

define( 'DEFAULT_AVATAR_URL', get_template_directory_uri() . '/assets/img/icons/person-outline.svg' );

/**
 * Remove Gravatar profile images if check in the customizer
 *
 * @param $avatar string
 *
 * @return string|string[]|null
 */
function mokime_get_gravatar( $avatar ) {

	if ( (bool) get_theme_mod( 'performance_disable_gravatar', false ) ) {
		return preg_replace( "/http.*?gravatar\.com[^\']*/", DEFAULT_AVATAR_URL, $avatar );
	} else {
		return $avatar;
	}
}

add_filter( 'get_avatar', 'mokime_get_gravatar' );

/**
 * Remove Gutenberg block style if checked in the customizer
 */
function mokime_performance_gutenberg_block_style() {

	if ( (bool) get_theme_mod( 'performance_disable_gutenberg_style', true ) ) {
		wp_dequeue_style( 'wp-block-library' );
	}
}

add_action( 'wp_enqueue_scripts', 'mokime_performance_gutenberg_block_style', 100 );

/**
 *
 */
function mokime_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<p class="widget-title h5 is-uppercase has-text-weight-bold">',
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
				'before_title' => '<p class="h4 is-uppercase has-text-weight-bold">',
				'after_title'  => '</p>',
				'name'         => __( 'Single post', 'mokime' ),
				'id'           => 'sidebar-single',
				'description'  => __( 'Widgets in this area will be display next to content in single post pages.', 'mokime' ),
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
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/svg-icons.php';
require get_template_directory() . '/inc/custom-css.php';

require get_template_directory() . '/classes/class-mokime-svg-icons.php';
require get_template_directory() . '/classes/class-mokime-walker-comment.php';
require get_template_directory() . '/classes/class-mokime-customize.php';
require get_template_directory() . '/classes/class-mokime-walker-menu.php';
require get_template_directory() . '/classes/class-mokime-widget-cta-post.php';
require get_template_directory() . '/classes/class-mokime-widget-recent-posts.php';
require get_template_directory() . '/classes/class-mokime-script-loader.php';

/**
 * Custom logo link class
 */
add_filter( 'get_custom_logo', 'add_custom_logo_url' );

function add_custom_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	return sprintf(
		'<a href="%1$s" class="navbar-item custom-logo-link" rel="home">%2$s</a>',
		esc_url( home_url( '/' ) ),
		wp_get_attachment_image(
			$custom_logo_id,
			'full',
			false,
			array(
				'class' => 'custom-logo navbar-item',
			)
		)
	);
}

/**
 * @return mixed|string
 */
function get_custom_logo_url() {

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo_meta      = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	if ( $logo_meta ) {
		return $logo_meta[0];
	} else {
		return '';
	}
}

/**
 * Register and Enqueue Styles.
 */
function mokime_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'mokime-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'mokime-style', 'rtl', 'replace' );

	wp_enqueue_style(
		'mokime-google-fonts',
		'https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,900&display=swap',
		false
	);

	wp_add_inline_style( 'mokime-style', mokime_get_customizer_css() );
}

add_action( 'wp_enqueue_scripts', 'mokime_register_styles' );

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function mokime_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . esc_html__( 'Skip to the content', 'mokime' ) . '</a>';
}

add_action( 'wp_body_open', 'mokime_skip_link', 5 );


/**
 * Triggered just after theme activation
 */
function mokime_setup_options() {
	set_theme_mod( 'single_post_sidebar_sticky', true );
	set_theme_mod( 'single_post_nav_posts', true );
	set_theme_mod( 'single_post_author_bio', true );
	set_theme_mod( 'single_post_featured_image', false );
	set_theme_mod( 'single_post_featured_image_overlay', 0.4 );

	set_theme_mod( 'homepage_header_search', true );
	set_theme_mod( 'homepage_last_posts', false );

	set_theme_mod( 'primary_color', '#53257F' );
	set_theme_mod( 'secondary_color', '#49516f' );
	set_theme_mod( 'header_textcolor', 'fff' );
	set_theme_mod( 'footer_text_color', '#dcdcdd' );
	set_theme_mod( 'footer_background_color', '#222222' );
	set_theme_mod( 'header_background_color', '#49516f' );
	set_theme_mod( 'header_hero_text_color', '#fff' );
}

add_action( 'after_switch_theme', 'mokime_setup_options' );

/**
 * Register and Enqueue Scripts.
 */
function mokime_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'mokime-js', get_template_directory_uri() . '/assets/js/menu.js', array(), $theme_version, false );

	wp_script_add_data( 'mokime-js', 'async', true );
}

add_action( 'wp_enqueue_scripts', 'mokime_register_scripts' );
