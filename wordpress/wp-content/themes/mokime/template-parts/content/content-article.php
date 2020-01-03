
<article class="column is-4" id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
    <div class="card">
		<?php
		$the_post_image = '';
		if ( has_post_thumbnail() ) {
			$post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			if ( $post_image ) {
				$the_post_image = sprintf( " background-image: url('%s')",
					$post_image[0]
				);
			}
		}
		?>
        <div class="card-image"<?php if ( $post_image ): ?> style="<?php echo $the_post_image ?>"<?php endif ?>></div>
        <div class="card-content">

            <h3 class="title has-margin-0 is-uppercase" itemprop="headline">
                <a href="<?php the_permalink() ?>" class="has-text-black has-text-900">
					<?php the_title(); ?>
                </a>
            </h3>

            <div class="content">
				<?php
				the_excerpt();
				get_template_part('template-parts/content/content-article-categories');
				?>
                <div class="has-margin-top-4">
                    <time class="is-small-text has-text-grey-dark" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                        <?php echo get_the_date( 'j F Y' ); ?>
                    </time>
                </div>
            </div>
        </div>
    </div>
</article>
