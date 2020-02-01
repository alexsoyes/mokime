<?php get_header(); ?>

    <div class="is-single entry-content">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-single' ); ?>
    </div><!-- .entry-content -->

<?php get_footer(); ?>