<div class="row">

	<article class="column column-66 post" <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<div class="post-inner">

			<div class="entry-content">

				<?php the_content(); ?>

			</div><!-- .entry-content -->

		</div><!-- .post-inner -->

		<div class="section-inner">
			<?php
			wp_link_pages(
				array(
					'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
					'after'       => '</nav>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			);

			get_template_part( 'template-parts/entry/author-bio' );
			?>

		</div><!-- .section-inner -->

		<?php

		get_template_part( 'template-parts/navigation' );

		if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
			?>

			<div class="comments-wrapper section-inner">

				<?php comments_template(); ?>

			</div><!-- .comments-wrapper -->

			<?php
		}
		?>

	</article><!-- .post -->

	<?php if  ( is_active_sidebar( 'sidebar-single' ) ) :  ?>
		<aside id="widget" class="widget-single column column-33">
			<?php dynamic_sidebar('sidebar-single'); ?>
		</aside><!-- widget-single -->
	<?php endif; ?>

</div>
