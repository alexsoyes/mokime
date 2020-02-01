<article class="wp-block-column is-flex" id="post-<?php the_ID(); ?>" itemscope
         itemtype="http://schema.org/BlogPosting">
	<div class="card has-margin-top-3">
		<?php $post_image = mokime_get_post_thumbnail_url( get_post() ); ?>
		<div
			class="card-image"<?php if ( $post_image ): ?> style="<?php echo sprintf( " background-image: url('%s')", $post_image ) ?>"<?php endif ?>>
			<div>
				<time class="is-small-text has-text-grey-dark" datetime="<?php echo get_the_date( 'c' ); ?>"
				      itemprop="datePublished">
					<small><?php echo get_the_date( 'j F Y' ); ?></small>
				</time>
			</div>
		</div>

		<div class="card-content">
			<h3 class="title is-4 has-text-weight-bold has-margin-top-1 has-margin-bottom-075" itemprop="headline">
				<a href="<?php the_permalink() ?>" class="has-text-black has-text-900">
					<?php the_title(); ?>
				</a>
			</h3><!-- .title -->

			<?php get_template_part( 'template-parts/entry/entry-article-categories' ); ?>

			<p class="subtitle is-6 has-text-justified has-text-overflowed has-margin-bottom-1"><?php echo get_the_excerpt(); ?></p>


		</div><!-- .card-content -->

	</div><!-- .card -->
</article>
