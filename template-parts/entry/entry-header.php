<?php
global $header_class, $header_image, $header_title, $header_description, $has_background_image;

$header_image = get_the_post_thumbnail_url( null, 'large' );

$has_background_image = isset( $header_image ) && ( $header_image && 'remove-header' !== $header_image );
?>

<div class="article-header__background-image"
	<?php
	if ( $has_background_image ) :
		?>
		style="background-image: url('<?php echo esc_url( $header_image ); ?>');"<?php endif; ?>>

	<div class="entry-content
	<?php
	if ( $has_background_image ) :
		?>
		 has-gradient-image<?php endif; ?>">

		<div class="hero">

			<div class="hero-body<?php echo esc_html( $header_class ); ?>">
				<h1
					<?php
					if ( is_single() ) :
						?>
						itemprop="name headline"<?php endif; ?> class="hero-title has-text-weight-bold h2">
					<?php echo wp_kses_post( $header_title ); ?>
				</h1>
				<?php if ( isset( $header_description ) && $header_description ) : ?>
				<div
					<?php
					if ( is_single() ) :
						?>
					 itemprop="description"<?php endif; ?> class="hero-desc h6">
					<?php echo wp_kses_post( $header_description ); ?>
				</div><!-- .hero-desc -->
				<?php endif; ?>

				<?php
				if ( is_search() ||
					 ( ( is_home() || is_front_page() )
					   && (bool) get_theme_mod( 'homepage_header_search', true ) ) ) {
					get_template_part( 'template-parts/header/search-form' );
				} elseif ( is_single() ) {
					get_template_part( 'template-parts/entry/entry-article-categories' );
					the_tags( '<ul><li class="hashtag">', '</li><li class="hashtag">', '</li></ul>' );
				}
				?>
			</div><!-- .hero-body -->

		</div><!-- .hero -->

	</div><!-- .entry-content -->

</div><!--.article-header__background-image -->
