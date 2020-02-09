<?php get_header(); ?>

    <div class="is-page entry-content">
		<?php
		the_post();
		get_template_part( 'template-parts/content/content-page' ); ?>
    </div><!-- .entry-content -->

<?php
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
	wpcf7_enqueue_scripts();
}

if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
	wpcf7_enqueue_styles();
}
?>
<?php get_footer(); ?>