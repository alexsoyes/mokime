<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

<?php if ( is_front_page() ) : ?>

	<?php

	if ( have_posts() ) {

		$i = 0;

		while ( have_posts() ) {
			$i ++;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		}

		$recent_posts = wp_get_recent_posts(array(
			'numberposts' => 4, // Number of recent posts thumbnails to display
			'post_status' => 'publish' // Show only the published posts
		));

		foreach($recent_posts as $post) : ?>
			<li>
				<a href="<?php echo get_permalink($post['ID']) ?>">
					<?php echo get_the_post_thumbnail($post['ID'], 'full'); ?>
					//Assuming that the slider support captions
					<p class="slider-caption-class"><?php echo $post['post_title'] ?></p>
				</a>
			</li>

		<?php endforeach; wp_reset_query();

		get_template_part( 'template-parts/pagination' );
	}
	?>

<?php endif; ?>

<?php
get_footer();

