<?php get_template_part( 'template-parts/entry/entry-breadcrumb' ); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

        <div class="entry-content">

			<?php the_content( __( 'Continue reading', 'mokime' ) ); ?>

        </div><!-- .entry-content -->

    </div><!-- .post-inner -->

    <div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'mokime' ) . '"><span class="label">' . __( 'Pages:', 'mokime' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
    </div><!-- .section-inner -->

	<?php
	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

        <div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

        </div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
