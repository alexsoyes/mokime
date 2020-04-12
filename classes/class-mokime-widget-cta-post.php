<?php
/**
 * Display a beautiful CTA Post.
 *
 * @package mokime
 */

if ( ! class_exists( 'MokiMe_Widget_CTA_Post' ) ) {

	class MokiMe_Widget_CTA_Post extends WP_Widget {

		public function __construct() {
			parent::__construct(
				'mokime_widget_cta_post',
				esc_html__( 'MokiMe : CTA for Single Posts', 'mokime' ),
				array( 'description' => esc_html__( 'Create a beautiful call-to-action for your single posts.', 'mokime' ) )
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @param array $args Widget arguments.
		 * @param array $instance Saved values from database.
		 *
		 * @return string|void
		 * @see WP_Widget::widget()
		 */
		public function widget( $args, $instance ) {

			$post_id = isset( $instance['post_id'] ) ? absint( $instance['post_id'] ) : 0;

			if ( ! $post_id || 0 === $post_id ) {
				return;
			}

			$style_landscape     = isset( $instance['style_landscape'] ) ? (bool) $instance['style_landscape'] : false;
			$post                = get_post( $post_id );
			$post_image          = mokime_get_post_thumbnail_url( $post );
			$only_parent_cat_ids = isset( $instance['only_parent_cat_ids'] ) ? esc_attr( $instance['only_parent_cat_ids'] ) : null;

			if ( null !== $only_parent_cat_ids ) {

				$only_parent_cat_ids = str_replace( ' ', '', $only_parent_cat_ids );
				$only_parent_cat_ids = explode( ',', $only_parent_cat_ids );

				// Could be either 128 or [ 158, 1024, 1567 ].
				if ( is_numeric( $only_parent_cat_ids ) ) {
					$only_parent_cat_ids = array( $only_parent_cat_ids );
				}

				// Now all cat IDs are in a array.
				if ( is_array( $only_parent_cat_ids ) ) {

					/** @var array $categories */
					$categories = get_the_category();

					if ( is_array( $categories ) && ! empty( $categories ) ) {

						/** @var WP_Term $category */
						$category = $categories[0];

						if ( ! in_array( $category->term_id, $only_parent_cat_ids ) ) {
							return '';
						}
					}
				}
			}

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $post->post_title;

			if ( $post ) {
				$this->the_widget( $title, $post, $post_image, $style_landscape );
			}
		}

		/**
		 * Display the widget on the page.
		 *
		 * @param string  $title Custom title if chosen, post title otherwise.
		 * @param WP_Post $post the post that will be shown on the widget.
		 * @param string  $post_image the image URL.
		 * @param bool    $style_landscape If the style is landscape mode.
		 */
		public function the_widget( $title, $post, $post_image, $style_landscape ) {

			/** @see https://support.google.com/analytics/answer/1033867?hl=fr */
			$post_link = sprintf(
				'%s?utm_source=%s&utm_medium=%s&utm_campaign=%s',
				get_the_permalink( $post->ID ),
				wp_strip_all_tags( $title ),
				get_bloginfo( 'name' ),
				gmdate( 'Y' )
			);

			$post_description = $post->post_excerpt;

			if ( ! $post_description ) {

				$meta_description = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );

				if ( $meta_description ) {
					$post_description = $meta_description;
				}
			}

			if ( $style_landscape ) {
				$this->the_widget_landscape( $title, $post_description, $post_image, $post_link );
			} else {
				$this->the_widget_card( $title, $post_description, $post_image, $post_link );
			}
		}

		/**
		 * Display the CTA post as a landscape style.
		 *
		 * @param string $title The custom or post title.
		 * @param string $post_description The excerpt or meta description.
		 * @param string $post_image The featured image URL.
		 * @param string $post_link The post link.
		 */
		private function the_widget_landscape( $title, $post_description, $post_image, $post_link ) {
			?>
			<div class="landscape hero has-text-align-center"
				<?php
				if ( $post_image ) :
					?>
					style="<?php echo sprintf( " background-image: url('%s')", esc_html( $post_image ) ); ?>"<?php endif ?>>

				<div class="hero-body hero-body--medium hero-body--filtered">

					<div class="hero-container">
						<h2>
							<a href="<?php echo esc_url( $post_link ); ?>" class="hero-title h2">
								<?php echo wp_kses_post( $title ); ?>
							</a>
						</h2>

						<?php if ( $post_description ) : ?>
							<p class="hero-desc"><?php echo wp_kses_post( $post_description ); ?></p>
						<?php endif; ?>
					</div><!-- .hero-container -->

					<a href="<?php echo esc_url( $post_link ); ?>#cta" class="button button-outline-white">
						<?php esc_html_e( 'Read now', 'mokime' ); ?>
					</a>

				</div><!-- .hero-body--medium -->

			</div><!-- .widget-landscape -->
			<?php
		}

		/**
		 * Display the CTA post as a simple card.
		 *
		 * @param string $title The custom or post title.
		 * @param string $post_description The excerpt or meta description.
		 * @param string $post_image The featured image URL.
		 * @param string $post_link The post link.
		 */
		private function the_widget_card( $title, $post_description, $post_image, $post_link ) {
			?>
			<div class="widget-cta-single">

				<div class="card">

					<div class="card-image"
						<?php
						if ( $post_image ) :
							?>
							style="<?php echo sprintf( " background-image: url('%s')", esc_html( $post_image ) ); ?>"<?php endif ?>></div>

					<div class="card-content">

						<h2 class="h3 card-title">
							<a href="<?php echo esc_url( $post_link ); ?>">
								<?php echo wp_kses_post( $title ); ?>
							</a>
						</h2>

						<?php if ( $post_description ) : ?>
							<p class="card-description has-text-overflowed is-overflowed-3"><?php echo wp_kses_post( $post_description ); ?></p>
						<?php endif; ?>

						<div class="card-actions">

							<a href="<?php echo esc_url( $post_link ); ?>#cta" class="button">
								<?php esc_html_e( 'Read now', 'mokime' ); ?>
							</a>

						</div><!-- .card-actions -->

					</div><!--.card-content -->

				</div><!-- .card -->

			</div><!-- .widget-cta-single -->
			<?php
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @see WP_Widget::form()
		 */
		public function form( $instance ) {
			$title               = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$post_id             = isset( $instance['post_id'] ) ? absint( $instance['post_id'] ) : '';
			$style_landscape     = isset( $instance['style_landscape'] ) ? (bool) $instance['style_landscape'] : false;
			$only_parent_cat_ids = isset( $instance['only_parent_cat_ids'] ) ? esc_attr( $instance['only_parent_cat_ids'] ) : false;
			?>
			<p>
				<label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>">
					<?php esc_html_e( 'Title:', 'mokime' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"
					   name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text"
					   value="<?php echo wp_kses_post( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_html( $this->get_field_id( 'only_parent_cat_ids' ) ); ?>">
					<?php esc_html_e( 'Only child of category IDs (optional):', 'mokime' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'only_parent_cat_ids' ) ); ?>"
					   name="<?php echo esc_html( $this->get_field_name( 'only_parent_cat_ids' ) ); ?>" type="text"
					   value="<?php echo esc_html( $only_parent_cat_ids ); ?>"/>
			</p>
			<p>
				<label
						for="<?php echo esc_html( $this->get_field_name( 'post_id' ) ); ?>"><?php esc_html_e( 'Post Id:', 'mokime' ); ?></label>
				<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'post_id' ) ); ?>"
					   name="<?php echo esc_html( $this->get_field_name( 'post_id' ) ); ?>" type="number"
					   value="<?php echo esc_attr( $post_id ); ?>"/>
			</p>
			<p>
				<input class="checkbox" type="checkbox"<?php checked( $style_landscape ); ?>
					   id="<?php echo esc_html( $this->get_field_id( 'style_landscape' ) ); ?>"
					   name="<?php echo esc_html( $this->get_field_name( 'style_landscape' ) ); ?>"/>
				<label for="<?php echo esc_html( $this->get_field_id( 'style_landscape' ) ); ?>">
					<?php esc_html_e( 'Landscape style', 'mokime' ); ?>
				</label>
			</p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 * @see WP_Widget::update()
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                        = array();
			$instance['title']               = sanitize_text_field( $new_instance['title'] );
			$instance['post_id']             = ( ! empty( $new_instance['post_id'] ) && is_numeric( $new_instance['post_id'] ) ) ? absint( $new_instance['post_id'] ) : '';
			$instance['style_landscape']     = isset( $new_instance['style_landscape'] ) ? (bool) $new_instance['style_landscape'] : false;
			$instance['only_parent_cat_ids'] = sanitize_text_field( $new_instance['only_parent_cat_ids'] );

			return $instance;
		}

	} // class MokiMe_Widget_CTA_Post

}
