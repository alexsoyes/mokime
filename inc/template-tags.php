<?php

/**
 * @param $limit int
 *
 * @return int[]|WP_Post[]
 */
function get_the_last_posts( $limit = 12 ) {

	return get_posts( array(
		'posts_per_page' => $limit,
		'offset'         => 0,
		'post_status'    => 'publish'
	) );
}

/**
 * @param $post_id int The post ID to look categories into
 *
 * @return WP_Term|null The primary category ID or null is none
 */
function get_post_category_primary( $post_id ) {

	$term_list = wp_get_post_terms( $post_id, 'category', [ 'fields' => 'all' ] );

	/** @var WP_Term $term */
	foreach ( $term_list as $term ) {
		// Yoast SEO main category
		if ( get_post_meta( $post_id, '_yoast_wpseo_primary_category', true ) == $term->term_id ) {
			return $term;
		}
	}

	// get the first one if at least one exists
	if ( ! empty( $term_list ) ) {
		return $term_list[0];
	}

	return null;
}

/**
 * @param $post WP_Post the post ID to use
 * @param string $size the thumbnail size to use
 *
 * @return string the URL of the post thumbnail
 */
function mokime_get_post_thumbnail_url( $post, $size = 'full' ) {

	if ( has_post_thumbnail( $post ) ) {

		$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );

		if ( $post_image ) {
			return $post_image[0];
		}
	}

	return '';
}

/**
 * Comments
 */
/**
 * Check if the specified comment is written by the author of the post commented on.
 *
 * @param object $comment Comment data.
 *
 * @return bool
 */
function mokime_is_comment_by_post_author( $comment = null ) {

	if ( is_object( $comment ) && $comment->user_id > 0 ) {

		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );

		if ( ! empty( $user ) && ! empty( $post ) ) {

			return $comment->user_id === $post->post_author;

		}
	}
	return false;

}

/**
 * Filter comment reply link to not JS scroll.
 * Filter the comment reply link to add a class indicating it should not use JS slow-scroll, as it
 * makes it scroll to the wrong position on the page.
 *
 * @param string $link Link to the top of the page.
 *
 * @return string $link Link to the top of the page.
 */
function mokime_filter_comment_reply_link( $link ) {

	$link = str_replace( 'class=\'', 'class=\'do-not-scroll ', $link );

	return $link;

}

add_filter( 'comment_reply_link', 'mokime_filter_comment_reply_link' );

/**
 * Post Meta
 */

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function mokime_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		$svg = MokiMe_SVG_Icons::get_social_link_svg( $item->url );
		if ( empty( $svg ) ) {
			$svg = mokime_get_theme_svg( 'link' );
		}
		$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'mokime_nav_menu_social_icons', 10, 4 );

/**
 * Classes
 */
/**
 * Add No-JS Class.
 * If we're missing JavaScript support, the HTML element will have a no-js class.
 */
function mokime_no_js_class() {

	?>
    <script>document.documentElement.className = document.documentElement.className.replace('no-js', 'js');</script>
	<?php

}

add_action( 'wp_head', 'mokime_no_js_class' );
