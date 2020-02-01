<?php get_header(); ?>

<div class="is-search container<?php if ( is_active_sidebar( 'sidebar-single' ) )
	echo ' container-hd' ?>">
	<?php
	global $wp_query;

	$archive_title = sprintf(
		'%1$s %2$s',
		'<span class="color-accent">' . __( 'Search:', 'mokime' ) . '</span>',
		'&ldquo;' . get_search_query() . '&rdquo;'
	);

	if ( $wp_query->found_posts ) {
		$archive_subtitle = sprintf(
		/* translators: %s: Number of search results */
			_n(
				'We found %s result for your search.',
				'We found %s results for your search.',
				$wp_query->found_posts,
				'mokime'
			),
			number_format_i18n( $wp_query->found_posts )
		);

		?>

        <div class="no-search-results-form section-inner thin">

			<?php
			get_search_form(
				array(
					'label' => __( 'search again', 'mokime' ),
				)
			);
			?>

        </div>

		<?php

		echo '<div class="row is-flex">';

		$i = 0;

		while ( have_posts() ) {
			$i ++;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/entry/entry-article' );

		}
		echo '</div>';
	} else {
		echo __( 'We could not find any results for your search. You can give it another try through the search form below.', 'mokime' );
	}

	?>

</div><!-- .is-single -->

<?php get_footer(); ?>
