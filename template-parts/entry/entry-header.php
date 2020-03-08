<?php
global $header_class, $header_image, $header_title, $header_description, $has_background_image;
?>

<div 
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
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '<h1 itemprop="name headline" class="hero-title has-text-weight-bold h2">' . $header_title . '</h1>';
				if ( isset( $header_description ) && $header_description ) {
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo '<div itemprop="description" class="hero-desc h6">' . $header_description . '</div>';
				}

				if ( ( is_home() || is_front_page() ) && (bool) get_theme_mod( 'homepage_header_search', true ) ) {
					get_template_part( 'template-parts/header/search-form' );
				} elseif ( is_single() ) {
					get_template_part( 'template-parts/entry/entry-article-categories' );
					the_tags( '<ul><li class="hashtag">', '</li><li class="hashtag">', '</li></ul>' );
				}
				?>
			</div><!-- .hero-body -->

		</div><!-- .hero -->

	</div><!-- .entry-content -->

</div><!--.wrapper -->
