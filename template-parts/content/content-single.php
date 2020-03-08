<div class="wp-block-columns content">

	<?php $column_width = is_active_sidebar( 'sidebar-single' ) ? '70' : '100'; ?>

    <article <?php post_class( "post wp-block-column-$column_width" ); ?> id="post-<?php the_ID(); ?>">

		<?php get_template_part( 'template-parts/entry/entry-breadcrumb' ); ?>

        <div class="post-inner">
			<?php the_content(); ?>
        </div><!-- .post-inner -->

        <div class="section-inner post-metadata">
			<?php
			get_template_part( 'template-parts/entry/entry-article-dates' );
			if ( (bool) get_theme_mod( 'single_post_nav_posts', true ) ) {
				get_template_part( 'template-parts/navigation' );
			}
			get_template_part( 'template-parts/entry/entry-author-bio' );
			?>
        </div><!-- .post-metadata -->

		<?php

		if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
			?>
            <div class="comments-wrapper section-inner">
				<?php comments_template(); ?>
            </div><!-- .comments-wrapper -->
			<?php
		}
		?>
    </article><!-- .post -->

	<?php if ( is_active_sidebar( 'sidebar-single' ) ) : ?>

        <aside role="complementary" id="widget" class="widget-single wp-block-column wp-block-column-30">

            <div
				<?php
				if ( (bool) get_theme_mod( 'single_post_sidebar_sticky', false ) ) :
					?>
                    class="sticky"<?php endif ?>>

				<?php dynamic_sidebar( 'sidebar-single' ); ?>

            </div>

        </aside><!-- widget-single -->

	<?php endif; ?>

</div><!-- .content -->
