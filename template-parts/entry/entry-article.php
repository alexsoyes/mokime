<article class="wp-block-column is-flex" id="post-<?php the_ID(); ?>" itemscope
         itemtype="http://schema.org/BlogPosting">
    <div class="card has-margin-top-3">
		<?php $post_image = mokime_get_post_thumbnail_url( get_post() ); ?>
        <div class="card-image"<?php if ( $post_image ): ?> style="<?php echo sprintf( " background-image: url('%s')", $post_image ) ?>"<?php endif ?>></div>
        <!-- .card--image -->

        <div class="card-content">

			<?php get_template_part( 'template-parts/entry/entry-article-categories' ); ?>

            <h3 class="card-title has-text-weight-bold has-margin-bottom-075" itemprop="headline">
                <a href="<?php the_permalink() ?>" class="color-secondary">
					<?php the_title(); ?>
                </a>
            </h3><!-- .title -->

            <p class="subtitle is-6 has-text-justified has-text-overflowed has-margin-bottom-1"><?php echo get_the_excerpt(); ?></p>

            <div class="card-date">
                <time class="is-small-text" datetime="<?php echo get_the_date( 'c' ); ?>"
                      itemprop="datePublished">
                    <small><?php echo get_the_date( 'j F Y' ); ?></small>
                </time>
            </div><!-- .card-date -->

        </div><!-- .card-content -->

    </div><!-- .card -->

</article><!-- .wp-block-column -->
