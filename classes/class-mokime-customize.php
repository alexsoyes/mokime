<?php
/**
 * Customizer settings for this theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

if ( ! class_exists( 'MokiMe_Customize' ) ) {
	/**
	 * CUSTOMIZER SETTINGS
	 */
	class MokiMe_Customize {

		/**
		 * Register customizer options.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function register( $wp_customize ) {

			/**
			 * Site Title & Description.
			 * */
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			self::add_selective_refreshes( $wp_customize );

			/**
			 * Site Identity
			 */
			self::add_section_logo( $wp_customize );
			self::add_section_color(
				$wp_customize,
				'primary_color',
				__( 'Primary Color', 'mokime' ),
				'#219385'
			);
			self::add_section_color(
				$wp_customize,
				'secondary_color',
				__( 'Secondary Color', 'mokime' ),
				'#49516f'
			);
			self::add_section_color(
				$wp_customize,
				'footer_text_color',
				__( 'Footer Text Color', 'mokime' ),
				'#dcdcdd'
			);
			self::add_section_color(
				$wp_customize,
				'footer_background_color',
				__( 'Footer Background Color', 'mokime' ),
				'#222222'
			);
			self::add_section_color(
				$wp_customize,
				'header_background_color',
				__( 'Header Background Color', 'mokime' ),
				'#c5c3c6'
			);
			self::add_section_color(
				$wp_customize,
				'header_hero_text_color',
				__( 'Header Hero Text Color', 'mokime' ),
				'#49516f'
			);


			/**
			 * Theme Options
			 */
			self::add_section_homepage( $wp_customize );
			self::add_section_single_post( $wp_customize );

			$wp_customize->add_panel(
				'options',
				array(
					'title'      => __( 'Theme Options', 'mokime' ),
					'priority'   => 40,
					'capability' => 'edit_theme_options',
				)
			);
		}

		/**
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function add_section_logo( &$wp_customize ) {

			/* 2X Header Logo ---------------- */
			$wp_customize->add_setting(
				'retina_logo',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'retina_logo',
				array(
					'type'        => 'checkbox',
					'section'     => 'title_tagline',
					'priority'    => 10,
					'label'       => __( 'Retina logo', 'mokime' ),
					'description' => __( 'Scales the logo to half its uploaded size, making it sharp on high-res screens.', 'mokime' ),
				)
			);
		}

		/**
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @param $id string The id of the color
		 * @param $label string The displaying label in customizer
		 * @param $default string The default color bound
		 */
		public static function add_section_color( &$wp_customize, $id, $label, $default ) {
			$wp_customize->add_setting(
				$id,
				array(
					'default'           => $default,
					'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$id,
					array(
						'label'   => $label,
						'section' => 'colors',
					)
				)
			);
		}

		/**
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function add_section_single_post( &$wp_customize ) {

			// Add section
			$wp_customize->add_section(
				'options_single',
				array(
					'title'    => __( 'Single Posts', 'mokime' ),
					'priority' => 10,
					'panel'    => 'options'
				)
			);

			// Add setting
			$wp_customize->add_setting(
				'single_post_author_bio',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
				)
			);

			// Add control
			$wp_customize->add_control(
				'single_post_author_bio',
				array(
					'type'     => 'checkbox',
					'section'  => 'options_single',
					'settings' => 'single_post_author_bio',
					'label'    => __( 'Show the author bio.', 'mokime' ),
				)
			);

			// Add setting
			$wp_customize->add_setting(
				'single_post_nav_posts',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
				)
			);

			// Add control
			$wp_customize->add_control(
				'single_post_nav_posts',
				array(
					'type'     => 'checkbox',
					'section'  => 'options_single',
					'settings' => 'single_post_nav_posts',
					'label'    => __( 'Display previous / next posts.', 'mokime' ),
				)
			);
		}

		/**
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function add_section_homepage( &$wp_customize ) {

			// Add section
			$wp_customize->add_section(
				'options_homepage',
				array(
					'title'    => __( 'Homepage', 'mokime' ),
					'priority' => 10,
					'panel'    => 'options'
				)
			);

			// Add setting
			$wp_customize->add_setting(
				'homepage_title', array(
				'default'           => '',
				'sanitize_callback' => array( __CLASS__, 'sanitize_text' )
			) );

			$wp_customize->add_setting(
				'homepage_description',
				array(
					'default'           => '',
					'sanitize_callback' => 'sanitize_textarea_field'
				)
			);

			$wp_customize->add_setting(
				'homepage_header_search',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_setting(
				'homepage_last_posts',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
				)
			);

			// Add control
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'homepage_title',
					array(
						'label'    => __( 'Homepage title', 'mokime' ),
						'section'  => 'options_homepage',
						'settings' => 'homepage_title',
						'type'     => 'text'
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'homepage_description',
					array(
						'label'    => __( 'Homepage description', 'mokime' ),
						'section'  => 'options_homepage',
						'settings' => 'homepage_description',
						'type'     => 'textarea'
					)
				)
			);

			$wp_customize->add_control(
				'homepage_header_search',
				array(
					'type'     => 'checkbox',
					'section'  => 'options_homepage',
					'priority' => 10,
					'label'    => __( 'Show search in header', 'mokime' ),
				)
			);


			$wp_customize->add_control(
				'homepage_last_posts',
				array(
					'type'     => 'checkbox',
					'section'  => 'options_homepage',
					'priority' => 10,
					'label'    => __( 'Show last posts in the hompeage', 'mokime' ),
				)
			);
		}

		/**
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function add_selective_refreshes( &$wp_customize ) {

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 'mokime_customize_partial_blogname',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'mokime_customize_partial_blogdescription',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'custom_logo',
				array(
					'selector'        => '.header-titles [class*=site-]:not(.site-description)',
					'render_callback' => 'mokime_customize_partial_site_logo',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'retina_logo',
				array(
					'selector'        => '.header-titles [class*=site-]:not(.site-description)',
					'render_callback' => 'mokime_customize_partial_site_logo',
				)
			);
		}


		/**
		 * @param $file
		 * @param $setting
		 *
		 * @return bool
		 */
		public static function sanitize_image( $file, $setting ) {

			//allowed file types
			$mimes = array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif'          => 'image/gif',
				'png'          => 'image/png'
			);

			//check file type from file name
			$file_ext = wp_check_filetype( $file, $mimes );

			//if file has a valid mime type return it, otherwise return default
			return ( $file_ext['ext'] ? $file : $setting->default );
		}


		/**
		 * Sanitization callback for the "accent_accessible_colors" setting.
		 *
		 * @static
		 * @access public
		 * @since 1.0.0
		 * @param array $value The value we want to sanitize.
		 * @return array       Returns sanitized value. Each item in the array gets sanitized separately.
		 */
		public static function sanitize_accent_accessible_colors( $value ) {

			// Make sure the value is an array. Do not typecast, use empty array as fallback.
			$value = is_array( $value ) ? $value : array();

			// Loop values.
			foreach ( $value as $area => $values ) {
				foreach ( $values as $context => $color_val ) {
					$value[ $area ][ $context ] = sanitize_hex_color( $color_val );
				}
			}

			return $value;
		}

		/**
		 * Sanitize select.
		 *
		 * @param string $input The input from the setting.
		 * @param object $setting The selected setting.
		 *
		 * @return string $input|$setting->default The input from the setting or the default setting.
		 */
		public static function sanitize_select( $input, $setting ) {
			$input   = sanitize_key( $input );
			$choices = $setting->manager->get_control( $setting->id )->choices;
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}

		/**
		 * Sanitize boolean for checkbox.
		 *
		 * @param bool $checked Whether or not a box is checked.
		 *
		 * @return bool
		 */
		public static function sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true === $checked ) ? true : false );
		}

		/**
		 * @param string $text The text to sanitize.
		 *
		 * @return string
		 */
		public static function sanitize_text( $text ) {
			return sanitize_text_field( $text );
		}

	}

	// Setup the Theme Customizer settings and controls.
	add_action( 'customize_register', array( 'MokiMe_Customize', 'register' ) );

}

/**
 * PARTIAL REFRESH FUNCTIONS
 * */
if ( ! function_exists( 'mokime_customize_partial_blogname' ) ) {
	/**
	 * Render the site title for the selective refresh partial.
	 */
	function mokime_customize_partial_blogname() {
		bloginfo( 'name' );
	}
}

if ( ! function_exists( 'mokime_customize_partial_blogdescription' ) ) {
	/**
	 * Render the site description for the selective refresh partial.
	 */
	function mokime_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}

if ( ! function_exists( 'mokime_customize_partial_site_logo' ) ) {
	/**
	 * Render the site logo for the selective refresh partial.
	 *
	 * Doing it this way so we don't have issues with `render_callback`'s arguments.
	 */
	function mokime_customize_partial_site_logo() {
		the_custom_logo();
	}
}


/**
 * Input attributes for cover overlay opacity option.
 *
 * @return array Array containing attribute names and their values.
 */
function mokime_customize_opacity_range() {
	/**
	 * Filter the input attributes for opacity
	 *
	 * @param array $attrs {
	 *     The attributes
	 *
	 *     @type int $min Minimum value
	 *     @type int $max Maximum value
	 *     @type int $step Interval between numbers
	 * }
	 */
	return apply_filters(
		'mokime_customize_opacity_range',
		array(
			'min'  => 0,
			'max'  => 90,
			'step' => 5,
		)
	);
}
