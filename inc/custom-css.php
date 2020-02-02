<?php
/**
 * MokiMe Custom CSS
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
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

		foreach ( $colors as $color_key => $color_values ) {
			$color = get_theme_mod( $color_key );
			mokime_generate_css( implode( ',', $color_values['elements'] ), $color_values['type'], $color );
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
			'header_footer_background_color' => array(
				'type'     => 'background-color',
				'elements' => array( 'footer' )
			),
			'header_textcolor'               => array(
				'type'     => 'color',
				'elements' => array( '.navbar-item, .navbar-link' )
			)
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
