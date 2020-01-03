<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
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

    <div class="container is-fluid site-header has-padding-0"
	     <?php $header_image = get_theme_mod( 'header_image' );
	     if ( $header_image ) : ?>style="background-image: url('<?php echo esc_url( $header_image ); ?>');"<?php endif; ?>>

        <div class="container">

            <header id="masthead">
		        <?php get_template_part( 'template-parts/header/menu' ); ?>
            </header>

            <div class="hero is-large">
                <div class="hero-body">
                    <div class="container">
                        <div class="columns">
                            <div class="column is-9 is-offset-1">
                                <p class="title is-white is-2"><?php echo get_theme_mod( 'homepage_title' ); ?></p>
                                <p class="subtitle is-white is-6"><?php echo get_theme_mod( 'homepage_description' ); ?></p>

						        <?php
						        if ( (bool) get_theme_mod( 'homepage_header_search', true ) ) {
							        get_template_part( 'template-parts/header/search-form' );
						        }
						        ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="content" class="container site-content">
