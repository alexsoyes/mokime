<?php
/**
 * Display a beautiful CTA Post.
 *
 * @package mokime
 */

if ( ! class_exists( 'MokiMe_Widget_TOC' ) ) {

	class MokiMe_Widget_TOC extends WP_Widget {

		public function __construct() {
			parent::__construct(
				'mokime_widget_toc',
				esc_html__( 'MokiMe : Table of contents', 'mokime' ),
				array( 'description' => esc_html__( 'Creates a table of contents (TOC).', 'mokime' ) )
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

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : null;

			if ( $title ) {
				echo "<p class='h2 toc_title'>$title</p>";
			}

			global $post;
			echo wp_kses_post( $post->post_toc );
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @see WP_Widget::form()
		 */
		public function form( $instance ) {
			$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			?>
			<p>
				<label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>">
					<?php esc_html_e( 'Title:', 'mokime' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"
					   name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text"
					   value="<?php echo wp_kses_post( $title ); ?>"/>
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
			$instance          = array();
			$instance['title'] = sanitize_text_field( $new_instance['title'] );

			return $instance;
		}

	} // class MokiMe_Widget_TOC

}
