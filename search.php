<?php get_header(); ?>

<div class="is-search entry-content">

    <div class="section-inner">
		<?php get_search_form( array( 'label' => esc_html__( 'Search again', 'mokime' ) ) ); ?>
    </div><!-- .section-inner -->

	<?php
	global $wp_query;

	$archive_title = sprintf(
		'%1$s %2$s',
		'<span class="color-accent">' . esc_html_e( 'Search:', 'mokime' ) . '</span>',
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

		<?php

		get_template_part( 'template-parts/entry/entry-posts' );

	} else {
		printf(
			'<div>%s</div>',
			esc_html__( 'We could not find any results for your search. You can give it another try through the search form below.', 'mokime' )
		);
	}

	?>

</div><!-- .is-search -->

<?php get_footer(); ?>
