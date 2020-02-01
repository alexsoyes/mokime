<?php get_header(); ?>

    <div class="is-single entry-content<?php if ( is_active_sidebar( 'sidebar-single' ) )
		echo ' container-hd' ?>">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-single' ); ?>
    </div><!-- .entry-content -->

<?php get_footer(); ?>