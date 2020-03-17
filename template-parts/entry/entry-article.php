<article class="wp-block-column is-flex" id="post-<?php the_ID(); ?>">

	<div class="card card--gapped">
		<?php $post_image = mokime_get_post_thumbnail_url( get_post() ); ?>
		<div class="card-image"
			<?php
			if ( $post_image ) :
				?>
				style="<?php echo sprintf( " background-image: url('%s')", esc_html( $post_image ) ); ?>"<?php endif ?>></div>

		<div class="card-content">

			<?php get_template_part( 'template-parts/entry/entry-article-categories' ); ?>

			<h3 class="card-title has-text-weight-bold">
				<a href="<?php the_permalink(); ?>" class="color-secondary">
					<?php the_title(); ?>
				</a>
			</h3><!-- .card-title -->

			<p class="has-text-overflowed is-overflowed-3"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>

			<div class="card-metadata">

				<div class="metadata">

					<img src="<?php the_asset('icon', 'calendar-outline.svg' ); ?>"
					     class="card-icons  icon"
					     alt="<?php esc_html_e('Published date', 'mokime'); ?>" />

					<span class="card-date">
						<a href="<?php the_permalink(); ?>" class="color-secondary">
							<time datetime="<?php echo get_the_date( 'c' ); ?>">
								<small><?php echo get_the_date( 'j F Y' ); ?></small>
							</time>
						</a>
					</span><!-- .card-date -->

				</div><!-- .metadata -->

				<div class="metadata">

					<img src="<?php the_asset('icon', '/chatbox-ellipses-outline.svg' ); ?>"
					     class="card-icons icon"
					     alt="<?php esc_html_e('Comments number', 'mokime'); ?>">

					<small class="card-comments color-secondary">
						<?php
						$comments_number = get_comments_number();
						echo wp_kses_post(
							sprintf(
							/* translators: 1: number of comments */
								_nx(
									'%1$s comment',
									'%1$s comments',
									$comments_number,
									'comments count',
									'mokime'
								),
								number_format_i18n( $comments_number )
							)
						);
						?>
					</small><!-- .card-comments -->

				</div><!-- .metadata -->

			</div><!-- .card-metadata -->

		</div><!-- .card-content -->

	</div><!-- .card -->

</article><!-- #post-<?php the_ID(); ?> -->
