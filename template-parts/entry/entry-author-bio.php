<?php

if ( (bool) get_theme_mod( 'single_post_author_bio', true ) ) : ?>

	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="url" content="<?php echo esc_html( get_custom_logo_url() ); ?>">
		</div>
		<meta itemprop="name" content="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>">
	</div>

	<div itemprop="author" itemscope itemtype="https://schema.org/Person" class="author-box has-text-align-center">

		<figure class="author-image is-64x64">
			<?php
			echo get_avatar(
				get_the_author_meta( 'ID' ),
				160,
				'',
				'',
				array(
					'class'    => 'is-circle',
					'itemprop' => 'image',
				)
			);
			?>
		</figure><!-- .author-image -->

		<div class="media-content-center content">

			<p itemprop="name" class="h3 has-text-weight-bold"><?php echo esc_html( get_the_author() ); ?></p>

			<div class="author-description">
				<span itemprop="description">
					<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
				</span>
				<a class="author-link"
				   itemprop="url"
				   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
				   rel="author">
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction
					_e( 'View Archive <span aria-hidden="true">&rarr;</span>', 'mokime' );
					?>
				</a>
			</div><!-- .author-description -->

		</div><!-- .media-content-center -->

	</div><!-- .author-box -->

<?php endif; ?>
