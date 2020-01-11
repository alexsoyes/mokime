<?php

get_header();

if ( is_home() || is_front_page() ) { ?>
    <div class="is-home container">
		<?php get_template_part( 'template-parts/content/content-home' ); ?>
    </div><!-- .is-home -->
	<?php
} else if ( is_page() ) { ?>
    <div class="is-page container">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-page' ); ?>
    </div><!-- .is-page -->
	<?php
} else if ( is_single() ) { ?>
    <div class="is-single container<?php if ( is_active_sidebar( 'sidebar-single' ) )
		echo ' container-hd' ?>">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-single' ); ?>
    </div><!-- .is-single -->
	<?php

}

get_footer();

