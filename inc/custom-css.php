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
	 * @param bool   $echo Echo the styles.
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

		// first level, get the $color_key which matches mod id.
		foreach ( $colors as $theme_mod_id => $color ) {
			// second level, loop into the classes for the given mod id.
			foreach ( $color as $color_values ) {
				$hex_color = get_theme_mod( $theme_mod_id );
				mokime_generate_css( $color_values['elements'], $color_values['type'], $hex_color, $color_values['prefix'], $color_values['suffix'] );
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
			'primary_color'                      => array(
				array(
					'type'     => 'color',
					'elements' => '.color-primary',
					'prefix'   => '',
					'suffix'   => '',
				),
				array(
					'type'     => 'background-color',
					'elements' => '.button, button, input[type="button"], input[type="reset"], input[type="submit"], .hero-title::before',
					'prefix'   => '',
					'suffix'   => '',
				),
				array(
					'type'     => 'border',
					'elements' => '.button, button, input[type="button"], input[type="reset"], input[type="submit"]',
					'prefix'   => '0.1rem solid ',
					'suffix'   => '',
				),
				array(
					'type'     => 'border-color',
					'elements' => "input[type='email']:focus, input[type='number']:focus, input[type='password']:focus, input[type='search']:focus, input[type='tel']:focus, input[type='text']:focus, input[type='url']:focus, textarea:focus, select:focus, input[type='email']:hover, input[type='number']:hover, input[type='password']:hover, input[type='search']:hover, input[type='tel']:hover, input[type='text']:hover, input[type='url']:hover, textarea:hover, select:hover",
					'prefix'   => '',
					'suffix'   => '',
				),
				array(
					'type'     => 'fill',
					'elements' => '.site-footer .svg-icon:hover',
					'prefix'   => '',
					'suffix'   => '',
				),
			),
			'secondary_color'                    => array(
				array(
					'type'     => 'color',
					'elements' => '.color-secondary',
					'prefix'   => '',
					'suffix'   => '',
				),
				array(
					'type'     => 'background-color',
					'elements' => '.card .card-image, .button:focus, .button:hover, button:focus, button:hover, input[type="button"]:focus, input[type="button"]:hover, input[type="reset"]:focus, input[type="reset"]:hover, input[type="submit"]:focus, input[type="submit"]:hover',
					'prefix'   => '',
					'suffix'   => '',
				),
			),
			'footer_background_color'            => array(
				array(
					'type'     => 'background-color',
					'elements' => '.site-footer',
					'prefix'   => '',
					'suffix'   => '',
				),
			),
			'footer_text_color'                  => array(
				array(
					'type'     => 'fill',
					'elements' => '.site-footer .svg-icon',
					'prefix'   => '',
					'suffix'   => '',
				),
				array(
					'type'     => 'background-color',
					'elements' => ' .site-footer a[target=_blank]::before',
					'prefix'   => '',
					'suffix'   => '',
				),
                array(
					'type'     => 'color',
					'elements' => '.site-footer p, .site-footer a, .site-footer li, .site-footer input[type="text"], .site-footer input[type="search"]',
					'prefix'   => '',
					'suffix'   => '',
				),
				array(
					'type'     => 'border-color',
					'elements' => '.site-footer input[type="text"], .site-footer input[type="search"]',
					'prefix'   => '',
					'suffix'   => '',
				),
			),
			'header_textcolor'                   => array(
				array(
					'type'     => 'color',
					'elements' => 'a.navbar-item, .navbar-link, .navbar-dropdown .navbar-item, a.navbar-item.is-active, .navbar-link.is-active, .navbar-item, .navbar-link, .navbar-burger, .logo-text',
					'prefix'   => '#',
					'suffix'   => '',
				),
				array(
					'type'     => 'border-color',
					'elements' => '.navbar-link:not(.is-arrowless)::after',
					'prefix'   => '#',
					'suffix'   => '',
				),
			),
			'header_background_color'            => array(
				array(
					'type'     => 'background-color',
					'elements' => '.article-header, .navbar-menu.is-active',
					'prefix'   => '',
					'suffix'   => '',
				),
			),
			'header_hero_text_color'             => array(
				array(
					'type'     => 'color',
					'elements' => '.hero-title, .hero-desc, .hero input, .hashtag, .hashtag a',
					'prefix'   => '',
					'suffix'   => '',
				),
				array(
					'type'     => 'border-color',
					'elements' => '.hero input[type="search"]',
					'prefix'   => '',
					'suffix'   => '',
				),
			),
			'single_post_featured_image_opacity' => array(
				array(
					'type'     => 'background',
					'elements' => '.article-header .has-gradient-image',
					'prefix'   => 'linear-gradient(to bottom,rgba(0,0,0,',
					'suffix'   => '),transparent)',
				),
			),
		);

		/**
		 * Filters Twenty Twenty theme elements
		 *
		 * @param array Array of elements
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'mokime_get_colors_array', $colors );
	}
}
