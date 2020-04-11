<?php
/**
 * This class contains MokiMe's shortcodes
 *
 * @package mokime
 */

/**
 * Display a CTA Post from shortcode.
 *
 * @param array $attributes attributes needed.
 * @return string HTML figure.
 */
function mokime_cta_post_shortcode( $attributes ) {

	if ( ! is_array( $attributes ) || ! array_key_exists( 'post_id', $attributes ) ) {
		return '';
	}

	$cta_post_widget = new MokiMe_Widget_CTA_Post();

	ob_start();
	$cta_post_widget->widget( null, $attributes );
	$output = ob_get_contents();
	ob_get_clean();

	return $output;
}

add_shortcode( 'mokime_cta_post', 'mokime_cta_post_shortcode' );
