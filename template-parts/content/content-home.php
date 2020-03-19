<article>

	<header class="article-header">
		<?php get_template_part( 'template-parts/entry/entry-header' ); ?>
	</header><!-- .article-header -->

	<?php mokime_the_ads( 'advertising_global_top' ); ?>

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
			get_template_part( 'template-parts/entry/entry-last-posts' );
		}
		?>
	</div><!-- .entry-content -->

</article>
