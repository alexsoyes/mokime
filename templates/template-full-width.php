<?php
/**
 * Full width template, no header, no footer, no sidebar... just content
 * Template Name: Full Width Template
 * Template Post Type: page
 *
 * @package mokime
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11"/>
	<?php

	if ( (bool) get_theme_mod( 'performance_enable_only_page_contact_form_7', false ) ) {

		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
		}

		if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
	wp_head();
	$body_class = array();
	array_push( $body_class, 'template-full-width' );

	if ( has_post_thumbnail() ) {
		array_push( $body_class, 'overlay' );
		?>
		<style>
			html {
				background-image: url("<?php echo esc_url( get_the_post_thumbnail_url() ); ?>");
			}
		</style>
		<?php
	}
	?>
</head>

<body <?php body_class( $body_class ); ?>>
<?php wp_body_open(); ?>

<main>
	<div class="entry-content">
		<div class="hero">
			<div class="has-text-align-center ">
				<h1 class="hero-title"><?php the_title(); ?></h1>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
</main>

<?php
mokime_template_style();
wp_footer();
?>
</body>
</html>
