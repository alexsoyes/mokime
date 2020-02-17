<?php

if ( have_posts() ) {

	$i = 0;
	echo '<div class="wp-block-columns">';

	while ( have_posts() ) {
		if ( $i !== 0 && ( $i % 3 ) === 0 ) {
			echo '</div><div class="wp-block-columns">';
		}
		$i ++;
		the_post();

		get_template_part( 'template-parts/entry/entry-article' );
	}

	echo '</div><!-- .wp-block-columns -->';

	get_template_part( 'template-parts/pagination' );
}
