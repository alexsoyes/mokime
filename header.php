<?php
/**
 * @package WordPress
 * @subpackage MokiMe
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php
	if ( is_single() && has_post_thumbnail() ) {
		$header_image       = mokime_get_post_thumbnail_url( get_post() );
		$header_title       = get_the_title();
		$header_description = get_the_excerpt();
	} elseif ( is_page() && ( ! is_home() && ! is_front_page() ) ) {
		$header_title = get_the_title();
		$header_image = mokime_get_post_thumbnail_url( get_post() );
	} elseif ( is_archive() ) {
		$header_image       = get_theme_mod( 'header_image' );
		$header_title       = get_the_archive_title();
		$header_description = get_the_archive_description();
	} elseif ( is_404() ) {
		$header_image       = get_theme_mod( 'header_image' );
		$header_title       = __( 'Page Not Found', 'mokime' );
		$header_description = __( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'mokime' );
	} elseif ( is_search() ) {
		$header_image       = get_theme_mod( 'header_image' );
		$header_title       = sprintf( __( '<span class="has-text-weight-bold">Searching for</span> "%s"', 'mokime' ), get_search_query() );
		$header_description = '';
	} else {
		$header_image       = get_theme_mod( 'header_image' );
		$header_title       = get_theme_mod( 'homepage_title' );
		$header_description = get_theme_mod( 'homepage_description' );
	}

	$has_background_image = ( $header_image && $header_image != 'remove-header' );
	?>

	<div id="site-header" class="wrapper is-fluid site-header has-padding-0"
	     <?php if ( $has_background_image ) : ?>style="background-image: url('<?php echo esc_url( $header_image ); ?>');"<?php endif; ?>>
		<div class="pre-entry-content<?php if ( $has_background_image ) {
			echo ' filtered-black';
		} ?>">
			<div class="entry-content">
				<header id="masthead" role="banner">
					<?php get_template_part( 'template-parts/header/menu' ); ?>
				</header>

				<div class="hero is-medium has-padding-bottom-5">
					<div class="hero-body has-text-align-center">
						<?php
						echo '<h1 class="hero-title has-huge-font-size has-margin-bottom-0">' . $header_title . '</h1>';
						if ( isset( $header_description ) && $header_description ) {
							echo '<div class="hero-desc h6 has-text-centered">' . $header_description . '</div>';
						}

						if ( ( is_home() || is_front_page() ) && (bool) get_theme_mod( 'homepage_header_search', true ) ) {
							get_template_part( 'template-parts/header/search-form' );
						} elseif ( is_single() ) {
							get_template_part( 'template-parts/entry/entry-article-categories' );
						}
						?>
                    </div><!-- .hero-body -->
                </div><!-- .hero -->
            </div><!-- .container -->
        </div><!-- .filtered-black -->
    </div><!--.wrapper -->

    <main id="site-content" role="main">
