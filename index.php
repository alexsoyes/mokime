<?php

get_header();

if ( is_home() || is_front_page() ) { ?>
    <div class="is-none container">
		<?php get_template_part( 'template-parts/content/content-home' ); ?>
    </div><!-- .is-none -->
	<?php
}

get_footer();

