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
		<h1 class="has-text-align-center"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
</main>

<?php
mokime_template_style();
wp_footer();
?>
</body>
</html>
