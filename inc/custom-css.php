<?php
/**
 * MokiMe Custom CSS
 *
 * @package WordPress
 * @subpackage MokiMe
 * @since 1.0.0
 */

if ( ! function_exists( 'mokime_generate_css' ) ) {

	/**
	 * Generate CSS.
	 *
	 * @param string $selector The CSS selector.
	 * @param string $style The CSS style.
	 * @param string $value The CSS value.
	 * @param string $prefix The CSS prefix.
	 * @param string $suffix The CSS suffix.
	 * @param bool $echo Echo the styles.
	 *
	 * @return string|void
	 */
	function mokime_generate_css( $selector, $style, $value, $prefix = '', $suffix = '', $echo = true ) {

		$return = '';

		/*
		 * Bail early if we have no $selector elements or properties and $value.
		 */
		if ( ! $value || ! $selector ) {

			return;
		}

		$return = sprintf( '%s{%s:%s;}', $selector, $style, $prefix . $value . $suffix );

		if ( $echo ) {

			echo $return; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;)

		}

		return $return;

	}
}

if ( ! function_exists( 'mokime_get_customizer_css' ) ) {

	/**
	 * Get CSS Built from Customizer Options.
	 * Build CSS reflecting colors, fonts and other options set in the Customizer, and return them for output.
	 *
	 * @param string $type Whether to return CSS for the "front-end", "block-editor" or "classic-editor".
	 *
	 * @return false|string
	 */
	function mokime_get_customizer_css() {

		ob_start();

		/**
		 * Note – Styles are applied in this order:
		 * 1. Element specific
		 * 2. Helper classes
		 *
		 * This enables all helper classes to overwrite base element styles,
		 * meaning that any color classes applied in the block editor will
		 * have a higher priority than the base element styles.
		 */

		// Auto-calculated colors.
		$colors = mokime_get_colors_array();

		// first level, get the $color_key which matches mod id
		foreach ( $colors as $theme_mod_id => $color ) {
			// second level, loop into the classes for the given mod id
			foreach ( $color as $color_values ) {
				$hex_color = get_theme_mod( $theme_mod_id );
				mokime_generate_css( $color_values['elements'], $color_values['type'], $hex_color, $color_values['prefix'] );
			}
		}

		// Return the results.
		return ob_get_clean();
	}

	/**
	 * Get an array of elements.
	 *
	 * @return array
	 * @since 1.0
	 *
	 */
	function mokime_get_colors_array() {

		/**
		 * @var $colors array
		 *
		 * key: the theme_mod key containing the choosen color from editor
		 * value: array of
		 * - Type: the type value (color, background-color)
		 * - CSS elements: that must be generated with the current item
		 */
		$colors = array(
			'footer_background_color' => array(
				array(
					'type'     => 'background-color',
					'elements' => 'footer',
					'prefix'   => ''
				)
			),
			'header_textcolor'        => array(
				array(
					'type'     => 'color',
					'elements' => '.navbar-item, .navbar-link',
					'prefix'   => '#'
				)
			),
			'primary_color'           => array(
				array(
					'type'     => 'color',
					'elements' => '.color-primary, a, a.navbar-item.is-active, .navbar-link.is-active',
					'prefix'   => ''
				),
				array(
					'type'     => 'background-color',
					'elements' => '.button, button, input[type="button"], input[type="reset"], input[type="submit"]',
					'prefix'   => ''
				),
				array(
					'type'     => 'border',
					'elements' => '.button, button, input[type="button"], input[type="reset"], input[type="submit"]',
					'prefix'   => '0.1rem solid '
				),
				array(
					'type'     => 'border-color',
					'elements' => 'input[type="email"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus, input[type="url"]:focus, textarea:focus, select:focus',
					'prefix'   => ''
				),
				array(
					'type'     => 'fill',
					'elements' => '.site-footer .svg-icon:hover',
					'prefix'   => ''
				),
			),
			'secondary_color'         => array(
				array(
					'type'     => 'color',
					'elements' => '.color-secondary, .navbar-item, .navbar-link',
					'prefix'   => ''
				),
				array(
					'type'     => 'background-color',
					'elements' => '.button:focus, .button:hover, button:focus, button:hover, input[type="button"]:focus, input[type="button"]:hover, input[type="reset"]:focus, input[type="reset"]:hover, input[type="submit"]:focus, input[type="submit"]:hover',
					'prefix'   => ''
				),
				array(
					'type'     => 'border-color',
					'elements' => 'hr, td, th, .navbar-link:not(.is-arrowless)::after, blockquote, input[type="email"], input[type="number"], input[type="password"], input[type="search"], input[type="tel"], input[type="text"], input[type="url"], textarea, select',
					'prefix'   => ''
				),
			),
			'footer_text_color'       => array(
				array(
					'type'     => 'fill',
					'elements' => '.site-footer .svg-icon',
					'prefix'   => ''
				),
				array(
					'type'     => 'color',
					'elements' => '.site-footer p, .site-footer a, .site-footer li',
					'prefix'   => ''
				)
			),
			'header_background_color' => array(
				array(
					'type'     => 'background-color',
					'elements' => '.site-header',
					'prefix'   => ''
				)
			),
			'header_hero_text_color'  => array(
				array(
					'type'     => 'color',
					'elements' => '.hero-title, .hero-desc',
					'prefix'   => ''
				)
			),
		);

		/**
		 * Filters Twenty Twenty theme elements
		 *
		 * @param array Array of elements
		 *
		 * @since 1.0.0
		 *
		 */
		return apply_filters( 'mokime_get_colors_array', $colors );
	}

}
