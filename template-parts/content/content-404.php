<?php
/**
 * 404 not found page.
 *
 * @package mokime
 */
global $header_description;

$header_description = esc_html__( 'We could not find any results for your search. You can give it another try through the search form below.', 'mokime' );
?>

<article>

	<header class="article-header">
		<?php get_template_part( 'template-parts/entry/entry-header' ); ?>
	</header><!-- .article-header -->

	<div class="entry-content">
		<?php get_template_part( 'template-parts/entry/entry-last-posts' ); ?>
	</div><!-- .entry-content -->

</article>


