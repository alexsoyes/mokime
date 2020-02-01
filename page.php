<?php get_header(); ?>

    <div class="is-page entry-content">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-page' ); ?>
    </div><!-- .entry-content -->

<?php get_footer(); ?>