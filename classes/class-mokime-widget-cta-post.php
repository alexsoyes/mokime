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
				array( 'description' => __( 'Create a beautiful call-to-action for your single posts.', 'mokime' ) )
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

			$post_id = isset( $instance['post_id'] ) ? $instance['post_id'] : false;

			if ( ! $post_id ) {
				return;
			}

			$style_landscape    = isset( $instance['style_landscape'] ) ? $instance['style_landscape'] : false;
			$post               = get_post( $post_id );
			$post_image         = mokime_get_post_thumbnail_url( $post );
			$only_parent_cat_id = isset( $instance['only_parent_cat_id'] ) ? absint( $instance['only_parent_cat_id'] ) : 0;

			if ( 0 !== $only_parent_cat_id ) {

				/** @var array $categories */
				$categories = get_the_category();

				if ( is_array( $categories ) && ! empty( $categories ) ) {

					/** @var WP_Term $category */
					$category = $categories[0];

					if ( $only_parent_cat_id !== $category->term_id ) {
						return '';
					}
				}
			}

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $post->post_title;

			if ( $post ) {
				$this->the_widget( $title, $post, $post_image );
			}
		}

		/**
		 * Display the widget on the page.
		 *
		 * @param $title string Custom title if choosen, post title otherwise
		 * @param WP_Post                                                    $post the post that will be shown on the widget.
		 * @param string                                                     $post_image the image URL.
		 */
		public function the_widget( $title, $post, $post_image ) {
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
			?>
			<div class="widget-cta-single">

				<div class="card">

					<div class="card-image"
						<?php
						if ( $post_image ) :
							?>
							style="<?php echo sprintf( " background-image: url('%s')", esc_html( $post_image ) ); ?>"<?php endif ?>></div>

					<div class="card-content">
						
						<p class="h3 card-title">
							<a href="<?php echo esc_url( $post_link ); ?>">
								<?php echo wp_kses_post( $title ); ?>
							</a>
						</p>

						<?php if ( $post_description ) : ?>
							<p class="description has-text-overflowed is-overflowed-3"><?php echo wp_kses_post( $post_description ); ?></p>
						<?php endif; ?>

						<div class="card-actions">

							<a href="<?php echo esc_url( $post_link ); ?>#cta"
							   class="button"
							   title="<?php echo esc_html__( 'Read now', 'mokime' ) . ' : ' . esc_html( wp_strip_all_tags( $post->post_title ) ); ?>">
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
			$title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$post_id            = isset( $instance['post_id'] ) ? absint( $instance['post_id'] ) : '';
			$style_landscape    = isset( $instance['style_landscape'] ) ? (bool) $instance['style_landscape'] : false;
			$only_parent_cat_id = isset( $instance['only_parent_cat_id'] ) ? absint( $instance['only_parent_cat_id'] ) : false;
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
				<label for="<?php echo esc_html( $this->get_field_id( 'only_parent_cat_id' ) ); ?>">
					<?php esc_html_e( 'Only child of category ID (optional):', 'mokime' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'only_parent_cat_id' ) ); ?>"
					   name="<?php echo esc_html( $this->get_field_name( 'only_parent_cat_id' ) ); ?>" type="number"
					   value="<?php echo absint( $only_parent_cat_id ); ?>"/>
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
			$instance                       = array();
			$instance['title']              = sanitize_text_field( $new_instance['title'] );
			$instance['post_id']            = ( ! empty( $new_instance['post_id'] ) && is_numeric( $new_instance['post_id'] ) ) ? absint( $new_instance['post_id'] ) : '';
			$instance['style_landscape']    = isset( $new_instance['style_landscape'] ) ? (bool) $new_instance['style_landscape'] : false;
			$instance['only_parent_cat_id'] = ( ! empty( $new_instance['only_parent_cat_id'] ) && is_numeric( $new_instance['only_parent_cat_id'] ) ) ? absint( $new_instance['only_parent_cat_id'] ) : '';

			return $instance;
		}

	} // class MokiMe_Widget_CTA_Post

}
