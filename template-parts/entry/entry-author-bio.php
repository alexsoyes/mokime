<?php

if ( (bool) get_the_author_meta( 'description' ) && (bool) get_theme_mod( 'single_post_author_bio', true ) ) : ?>
    <div class="author-box">
        <div class="has-text-centered">
            <figure class="author-image is-64x64">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 160, '', '', array( 'class' => 'is-circle' ) ); ?>
            </figure><!-- .author-image -->

            <div class="media-content-center">
                <div class="content">
                    <p class="h3 has-text-weight-bold"><?php echo esc_html( get_the_author() ); ?></p>
                    <div class="author-description">
				        <?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
                        <a class="author-link"
                           href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                           rel="author">
					        <?php esc_html_e( 'View Archive <span aria-hidden="true">&rarr;</span>', 'mokime' ); ?>
                        </a>
                    </div><!-- .author-description -->
                </div>
            </div><!-- .media-content-center -->
        </div>
    </div><!-- .author-box -->
<?php endif; ?>
