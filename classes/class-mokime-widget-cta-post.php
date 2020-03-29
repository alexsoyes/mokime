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
				array( 'description' => __( 'Create a beautiful call-to-action for your single posts.', 'mokime' ) ) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @param array $args Widget arguments.
		 * @param array $instance Saved values from database.
		 *
		 * @see WP_Widget::widget()
		 */
		public function widget( $args, $instance ) {
			extract( $args );

			$post_id = apply_filters( 'widget_title', $instance['post_id'] );
			$post_id = isset( $instance['post_id'] ) ? $instance['post_id'] : false;

			if ( ! $post_id ) {
				return;
			}

			$style_landscape = isset( $instance['style_landscape'] ) ? $instance['style_landscape'] : false;
			$post            = get_post( $post_id );
			$post_image      = mokime_get_post_thumbnail_url( $post );

			if ( $post ) {
				$this->the_widget( $post, $post_image );
			}
		}

		/**
		 * Display the widget on the page.
		 *
		 * @param WP_Post $post the post that will be shown on the widget.
		 * @param string  $post_image the image URL.
		 */
		private function the_widget( $post, $post_image ) {
			?>
			<div class="widget-cta-single">

				<div class="card">

					<div class="card-image"
						<?php
						if ( $post_image ) :
							?>
							style="<?php echo sprintf( " background-image: url('%s')", esc_html( $post_image ) ); ?>"<?php endif ?>></div>

					<div class="card-content">
						<?php
						/** @see https://support.google.com/analytics/answer/1033867?hl=fr */
						$post_link = sprintf(
							'%s?utm_source=%s&utm_medium=%s&utm_campaign=%s',
							get_the_permalink( $post->ID ),
							get_post()->post_name,
							'blog',
							gmdate( 'Y' )
						);
						?>
						<p class="h3 card-title">
							<a href="<?php echo esc_url( $post_link ); ?>">
								<?php echo wp_kses_post( $post->post_title ); ?>
							</a>
						</p>

						<?php if ( $post->post_excerpt ) : ?>
							<p class="description has-text-overflowed is-overflowed-3"><?php echo wp_kses_post( $post->post_excerpt ); ?></p>
						<?php else : ?>
							<?php
							$meta_description = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );
							if ( $meta_description ) :
								?>
								<p class="description has-text-overflowed is-overflowed-3"><?php echo wp_kses_post( $meta_description ); ?></p>
							<?php endif; ?>
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
			$post_id         = isset( $instance['post_id'] ) ? $instance['post_id'] : '';
			$style_landscape = isset( $instance['style_landscape'] ) ? (bool) $instance['style_landscape'] : false;
			?>
			<p>
				<label
					for="<?php echo esc_html( $this->get_field_name( 'post_id' ) ); ?>"><?php esc_html_e( 'Post Id:', 'mokime' ); ?></label>
				<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'post_id' ) ); ?>"
					   name="<?php echo esc_html( $this->get_field_name( 'post_id' ) ); ?>" type="text"
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
			$instance                    = array();
			$instance['post_id']         = ( ! empty( $new_instance['post_id'] ) && is_numeric( $new_instance['post_id'] ) ) ? sanitize_text_field( $new_instance['post_id'] ) : '';
			$instance['style_landscape'] = isset( $new_instance['style_landscape'] ) ? (bool) $new_instance['style_landscape'] : false;

			return $instance;
		}

	} // class MokiMe_Widget_CTA_Post

}
