<article>

	<header class="article-header">
		<?php get_template_part( 'template-parts/entry/entry-header' ); ?>
	</header><!-- .article-header -->

    <?php the_ads( 'advertising_global_top' ); ?>

	<div class="entry-content">
		<?php

		/**
		 * Display the content from the static page
		 */
		if ( ! is_home() && is_front_page() && have_posts() ) {
			the_post();
			the_content();
		}

		if ( is_front_page() && is_home() || is_home() && ! is_front_page() ) {
			get_template_part( 'template-parts/entry/entry-posts' );
		}
		/**
		 * Display the last articles
		 */
		elseif ( is_home() && ! is_front_page() || (bool) get_theme_mod( 'homepage_last_posts', true ) ) {

			$recent_posts = get_the_last_posts();

			if ( $recent_posts ) {

				echo '<h2 class="title has-text-weight-light">' . esc_html__( 'Our last posts', 'mokime' ) . '</h2>';
				echo '<div class="wp-block-columns">';

				// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				foreach ( $recent_posts as $index => $post ) {

					if ( $index !== 0 && ( $index % 3 ) === 0 ) {
						echo '</div><!-- .wp-block-columns --><div class="wp-block-columns">';
					}

					setup_postdata( $post );
					get_template_part( 'template-parts/entry/entry-article' );
				}

				wp_reset_postdata();

				echo '</div><!-- .wp-block-columns -->';
			}

			wp_reset_postdata();
		}

		?>
	</div><!-- .entry-content -->
</article>
