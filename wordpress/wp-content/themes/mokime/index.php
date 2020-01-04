<?php

get_header();

if ( is_home() || is_front_page() ) { ?>
    <div class="container">
		<?php get_template_part( 'template-parts/content/content-home' ); ?>
    </div>
	<?php
} else if ( is_page() ) { ?>
    <div class="container">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-page' ); ?>
    </div>
	<?php
} else if ( is_single() ) { ?>
    <div class="container">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-single' ); ?>
    </div>
	<?php

}

get_footer();

