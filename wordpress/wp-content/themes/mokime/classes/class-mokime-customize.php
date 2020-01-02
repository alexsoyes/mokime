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

			/**
			 * Site Identity
			 */

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

			// Header & Footer Background Color.
			$wp_customize->add_setting(
				'header_footer_background_color',
				array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'header_footer_background_color',
					array(
						'label'   => __( 'Header &amp; Footer Background Color', 'mokime' ),
						'section' => 'colors',
					)
				)
			);

			// Enable picking an accent color.
			$wp_customize->add_setting(
				'accent_hue_active',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
					'transport'         => 'postMessage',
					'default'           => 'default',
				)
			);

			$wp_customize->add_control(
				'accent_hue_active',
				array(
					'type'    => 'radio',
					'section' => 'colors',
					'label'   => __( 'Primary Color', 'mokime' ),
					'choices' => array(
						'default' => __( 'Default', 'mokime' ),
						'custom'  => __( 'Custom', 'mokime' ),
					),
				)
			);

			/**
			 * Implementation for the accent color.
			 * This is different to all other color options because of the accessibility enhancements.
			 * The control is a hue-only colorpicker, and there is a separate setting that holds values
			 * for other colors calculated based on the selected hue and various background-colors on the page.
			 *
			 * @since 1.0.0
			 */

			// Add the setting for the hue colorpicker.
			$wp_customize->add_setting(
				'accent_hue',
				array(
					'default'           => 344,
					'type'              => 'theme_mod',
					'sanitize_callback' => 'absint',
					'transport'         => 'postMessage',
				)
			);

			// Add setting to hold colors derived from the accent hue.
			$wp_customize->add_setting(
				'accent_accessible_colors',
				array(
					'default'           => array(
						'content'       => array(
							'text'      => '#000000',
							'accent'    => '#cd2653',
							'secondary' => '#6d6d6d',
							'borders'   => '#dcd7ca',
						),
						'header-footer' => array(
							'text'      => '#000000',
							'accent'    => '#cd2653',
							'secondary' => '#6d6d6d',
							'borders'   => '#dcd7ca',
						),
					),
					'type'              => 'theme_mod',
					'transport'         => 'postMessage',
					'sanitize_callback' => array( __CLASS__, 'sanitize_accent_accessible_colors' ),
				)
			);

			// Add the hue-only colorpicker for the accent color.
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'accent_hue',
					array(
						'section'         => 'colors',
						'settings'        => 'accent_hue',
						'description'     => __( 'Apply a custom color for links, buttons, featured images.', 'mokime' ),
						'mode'            => 'hue',
						'active_callback' => function() use ( $wp_customize ) {
							return ( 'custom' === $wp_customize->get_setting( 'accent_hue_active' )->value() );
						},
					)
				)
			);

			// Update background color with postMessage, so inline CSS output is updated as well.
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

			/**
			 * Theme Options
			 */

			self::add_section_homepage( $wp_customize );
			self::add_section_header( $wp_customize );

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
		public static function add_section_header( &$wp_customize ) {

			// Add section
			$wp_customize->add_section(
				'options_header',
				array(
					'title'    => __( 'Header', 'mokime' ),
					'priority' => 10,
					'panel'    => 'options'
				)
			);

			// Add setting
			$wp_customize->add_setting(
				'header_image',
				array(
					'transport' => 'refresh',
					'height'    => 325,
				)
			);

			// Add control
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'logo',
					array(
						'label'    => __( 'Header image', 'mokime' ),
						'section'  => 'options_header',
						'settings' => 'header_image'
					)
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
				'homepage_description', array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_textarea_field'
			) );

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
