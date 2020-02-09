<div class="wp-block-columns breadcrumb">
	<?php if ( function_exists( 'yoast_breadcrumb' ) ): ?>
        <div class="wp-block-column wp-block-column-100 entry-content">
			<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
        </div>
	<?php endif; ?>
</div><!-- .breadcrumb -->

<div class="wp-block-columns content">
    <article <?php post_class( 'wp-block-column wp-block-column-66' ); ?> id="post-<?php the_ID(); ?>">
        <div class="post-inner">
            <div class="entry-content">
				<?php the_content(); ?>
            </div><!-- .entry-content -->
        </div><!-- .post-inner -->

        <div class="section-inner">
            <div class="section-inner__date">
				<?php _e( 'Post published on ', 'mokime' ); ?>
                <time class="is-small-text" datetime="<?php echo get_the_date( 'c' ); ?>">
					<?php echo get_the_date( 'j F Y' ); ?>
                </time>
				<?php _e( ' Last modified on ', 'mokime' ); ?>
                <time class="is-small-text" datetime="<?php echo get_the_modified_date( 'c' ); ?>">
					<?php echo get_the_modified_date( 'j F Y' ); ?>
                </time>
            </div>
			<?php
			if ( (bool) get_theme_mod( 'single_post_nav_posts', true ) ) {
				get_template_part( 'template-parts/navigation' );
			}
			get_template_part( 'template-parts/entry/entry-author-bio' ); ?>
        </div><!-- .section-inner -->

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

	<?php if  ( is_active_sidebar( 'sidebar-single' ) ) :  ?>
		<aside role="complementary" id="widget" class="widget-single wp-block-column wp-block-column-33">
			<div class="sticky">
				<?php dynamic_sidebar( 'sidebar-single' ); ?>
			</div>
		</aside><!-- widget-single -->
	<?php endif; ?>
</div><!-- .content -->
