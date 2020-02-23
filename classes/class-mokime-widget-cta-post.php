<?php

if ( ! class_exists( 'MokiMe_Widget_CTA_Post' ) ) {

	/**
	 * Adds MokiMe_Widget_CTA widget.
	 */
	class MokiMe_Widget_CTA_Post extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			parent::__construct(
				'mokime_widget_cta_post', // Base ID
				esc_html__( 'MokiMe : CTA for Single Posts', 'mokime' ), // Name
				array( 'description' => __( 'Create a beautiful call-to-action for your single posts.', 'mokime' ), ) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @param array $args Widget arguments.
		 * @param array $instance Saved values from database.
		 *
		 * @see WP_Widget::widget()
		 *
		 */
		public function widget( $args, $instance ) {
			extract( $args );
			$id = apply_filters( 'widget_title', $instance['id'] );

			/** @var WP_Post * */
			$post       = get_post( $id );
			$post_image = mokime_get_post_thumbnail_url( $post );

			if ( $post ) {
				ob_start();
				?>
				<div class="widget-cta-single">

					<div class="card">

						<div
							class="card-image"<?php if ( $post_image ): ?> style="<?php echo sprintf( " background-image: url('%s')", esc_html( $post_image ) ) ?>"<?php endif ?>></div>

						<div class="card-content">

							<p class="h3 card-title has-text-weight-bold">
								<a href="<?php echo esc_html( get_the_permalink( $id ) ); ?>">
									<?php echo esc_html( $post->post_title ); ?>
								</a>
							</p>

							<p class="description"><?php echo wp_kses_post( $post->post_excerpt ); ?></p>

							<div class="card-actions">

								<a href="<?php echo esc_html( get_the_permalink( $id ) ); ?>"
								   class="button"
								   title="<?php echo esc_html__( 'Read now', 'mokime' ) . " : " . wp_kses_post( $post->post_title ); ?>">
									<?php esc_html_e( 'Read now', 'mokime' ) ?>
								</a>

							</div><!-- .card-actions -->

						</div><!--.card-content -->

					</div><!-- .card -->

				</div><!-- .widget-cta-single -->
				<?php
				$output = ob_get_contents();
				ob_clean();
				echo wp_kses_post( $output );
			} else {
				printf( '<p>The following post id (%d) does not exist.</p>', esc_html( $id ) );
			}
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @see WP_Widget::form()
		 *
		 */
		public function form( $instance ) {
			if ( isset( $instance['id'] ) ) {
				$id = $instance['id'];
			} else {
				$id = '';
			}
			?>
			<p>
				<label
					for="<?php echo esc_html( $this->get_field_name( 'id' ) ); ?>"><?php esc_html_e( 'Single Post Id:', 'mokime' ); ?></label>
				<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'id' ) ); ?>"
				       name="<?php echo esc_html( $this->get_field_name( 'id' ) ); ?>" type="text"
				       value="<?php echo esc_attr( $id ); ?>"/>
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
		 *
		 */
		public function update( $new_instance, $old_instance ) {
			$instance          = array();
			$instance['id'] = ( ! empty( $new_instance['id'] ) && is_numeric($new_instance['id']) ) ? sanitize_text_field( $new_instance['id'] ) : '';

			return $instance;
		}

	} // class MokiMe_Widget_CTA_Post

}
