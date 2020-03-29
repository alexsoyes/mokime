<?php
global $wp_query;
global $header_description;

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

	$header_description = $archive_subtitle;
} else {
	$header_description = esc_html__( 'We could not find any results for your search. You can give it another try through the search form below.', 'mokime' );
}
?>

<article>

	<header class="article-header">
		<?php get_template_part( 'template-parts/entry/entry-header' ); ?>
	</header><!-- .article-header -->

	<div class="entry-content">
        <?php get_template_part( 'template-parts/entry/entry-breadcrumb' ); ?>
		<?php
		if ( ! $wp_query->found_posts ) {
			get_template_part( 'template-parts/entry/entry-last-posts' );
		}
		?>
		<?php get_template_part( 'template-parts/entry/entry-posts' ); ?>
	</div><!-- .entry-content -->

</article>


