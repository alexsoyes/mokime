<div class="wp-block-columns content">

    <article <?php post_class( 'post wp-block-column wp-block-column-70' ); ?> id="post-<?php the_ID(); ?>">

	    <?php get_template_part( 'template-parts/entry/entry-breadcrumb' ); ?>

	    <div class="post-inner">
		    <?php the_content(); ?>
	    </div><!-- .post-inner -->

	    <div class="section-inner post-metadata">
		    <div class="section-inner__date">
			    <?php _e( 'Post published on ', 'mokime' ); ?>
			    <time class="tag" datetime="<?php echo get_the_date( 'c' ); ?>">
				    <?php echo get_the_date( 'j F Y' ); ?>
			    </time>
			    <?php _e( ' Last modified on ', 'mokime' ); ?>
			    <time class="tag" datetime="<?php echo get_the_modified_date( 'c' ); ?>">
				    <?php echo get_the_modified_date( 'j F Y' ); ?>
			    </time>
		    </div><!-- .section-inner__date -->
		    <?php
		    if ( (bool) get_theme_mod( 'single_post_nav_posts', true ) ) {
			    get_template_part( 'template-parts/navigation' );
		    }
		    get_template_part( 'template-parts/entry/entry-author-bio' ); ?>
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

	<?php if  ( is_active_sidebar( 'sidebar-single' ) ) :  ?>
        <aside role="complementary" id="widget" class="widget-single wp-block-column wp-block-column-30">
            <div<?php if ( (bool) get_theme_mod( 'single_post_sidebar_sticky', false ) ) : ?> class="sticky"<?php endif ?>>
				<?php dynamic_sidebar( 'sidebar-single' ); ?>
            </div>
        </aside><!-- widget-single -->
	<?php endif; ?>
</div><!-- .content -->
