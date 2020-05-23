<?php
global $header_class, $header_image, $header_title, $header_description, $has_background_image;

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

			<div class="hero-body<?php echo esc_attr( $header_class ); ?>">
				<?php if ( isset( $header_title ) && $header_title ) : ?>
				<h1 class="hero-title has-text-weight-bold">
					<?php echo wp_kses_post( $header_title ); ?>
				</h1>
				<?php endif; ?>
				<?php if ( isset( $header_description ) && $header_description ) : ?>
				<div class="hero-desc">
					<?php echo wp_kses_post( $header_description ); ?>
				</div><!-- .hero-desc -->
				<?php endif; ?>

				<?php
				if ( is_search() || is_404() ||
					 ( ( is_home() || is_front_page() )
					   && (bool) get_theme_mod( 'homepage_header_search', true ) ) ) {
					get_template_part( 'template-parts/header/search-form' );
				} elseif ( is_single() ) {

					if ( (bool) get_theme_mod( 'single_post_category_links', false ) ) {
						get_template_part( 'template-parts/entry/entry-article-categories' );
					} else {
						get_template_part( 'template-parts/entry/entry-article-categories-no-link' );
					}
					the_tags( '<ul><li class="hashtag">', '</li><li class="hashtag">', '</li></ul>' );
				}
				?>
			</div><!-- .hero-body -->

		</div><!-- .hero -->

	</div><!-- .entry-content -->

</div><!--.article-header__background-image -->
