<?php

if ( ! class_exists( 'MokiMe_Widget_Recent_Posts' ) ) {

	/**
	 * Core class used to implement a Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @see WP_Widget
	 */
	class MokiMe_Widget_Recent_Posts extends WP_Widget {

		/**
		 * Sets up a new Recent Posts widget instance.
		 *
		 * @since 2.8.0
		 */
		public function __construct() {
			parent::__construct(
				'mokime_widget_recent_entries',
				esc_html__( 'MokiMe : Recent posts per cat', 'mokime' ),
				array(
					'classname'                   => 'mokime_widget_recent_entries',
					'description'                 => __( 'Display the last posts from the current category (SEO power).', 'mokime' ),
					'customize_selective_refresh' => true,
				)
			);
			$this->alt_option_name = 'mokime_widget_recent_entries';
		}

		/**
		 * Outputs the content for the current Recent Posts widget instance.
		 *
		 * @param array $args Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current Recent Posts widget instance.
		 *
		 * @since 2.8.0
		 */
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Posts from category', 'mokime' );

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
			if ( ! $number ) {
				$number = 5;
			}
			$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

			/** @var WP_Post $current_post */
			$current_post = get_queried_object();

			if ( $current_post ) {
				/** @var WP_Term $post_category */
				$post_category = get_post_category_primary( $current_post->ID );

				if ( ! $post_category ) {
					return;
				}
			} else {
				return;
			}

			/**
			 * Filters the arguments for the Recent Posts widget.
			 *
			 * @param array $args An array of arguments used to retrieve the recent posts.
			 * @param array $instance Array of settings for the current widget.
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @since 3.4.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 */
			$wp_query_args = array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			);

			if ( isset( $post_category ) ) {
				$wp_query_args['cat'] = $post_category->term_id;
			}

			$r = new WP_Query( apply_filters( 'widget_posts_args', $wp_query_args, $instance ) );

			if ( ! $r->have_posts() ) {
				return;
			}
			?>

            <nav class="widget-cta-categories"
                 aria-label="<?php esc_html_e( 'Articles from the same category', 'mokime' ); ?>" role="navigation">>

				<?php

				echo wp_kses_post( $args['before_widget'] );

				if ( $title ) {
					printf(
						'%s<span class="is-small-text has-text-weight-light is-block">%s</span>%s%s',
						wp_kses_post( $args['before_title'] ),
						wp_kses_post( $title ),
						wp_kses_post( $post_category->name ),
						wp_kses_post( $args['after_title'] )
					);
				}
				?>
                <ul>
					<?php foreach ( $r->posts as $recent_post ) : ?>
						<?php if ( get_queried_object_id() !== $recent_post->ID ) : ?>
							<?php
							$post_title   = get_the_title( $recent_post->ID );
							$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)', 'mokime' );
							$aria_current = '';
							?>
                            <li class="has-text-overflowed is-overflowed-1">
								<?php if ( $show_date ) : ?>
                                    <span class="post-date">
									<?php echo esc_html( get_the_date( 'd/m/Y', $recent_post->ID ) ); ?> -
							</span>
								<?php endif; ?>
								<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                <a href="<?php the_permalink( $recent_post->ID ); ?>"<?php echo $aria_current; ?>>
									<?php echo wp_kses_post( $title ); ?>
                                </a>
                            </li>
						<?php endif; ?>
					<?php endforeach; ?>
                </ul>

				<?php echo wp_kses_post( $args['after_widget'] ); ?>

            </nav>

			<?php
		}

		/**
		 * Handles updating the settings for the current Recent Posts widget instance.
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            WP_Widget::form().
		 * @param array $old_instance Old settings for this instance.
		 *
		 * @return array Updated settings to save.
		 * @since 2.8.0
		 */
		public function update( $new_instance, $old_instance ) {
			$instance              = $old_instance;
			$instance['title']     = sanitize_text_field( $new_instance['title'] );
			$instance['number']    = (int) $new_instance['number'];
			$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

			return $instance;
		}

		/**
		 * Outputs the settings form for the Recent Posts widget.
		 *
		 * @param array $instance Current settings.
		 *
		 * @since 2.8.0
		 */
		public function form( $instance ) {
			$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
			?>
            <p>
                <label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>">
					<?php esc_html_e( 'Title:', 'mokime' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo wp_kses_post( $this->get_field_name( 'title' ) ); ?>" type="text"
                       value="<?php echo wp_kses_post( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_html( $this->get_field_id( 'number' ) ); ?>">
					<?php esc_html_e( 'Number of posts to show:', 'mokime' ); ?>
                </label>
                <input class="tiny-text" id="<?php echo esc_html( $this->get_field_id( 'number' ) ); ?>"
                       name="<?php echo esc_html( $this->get_field_name( 'number' ) ); ?>" type="number" step="1"
                       min="1"
                       value="<?php echo esc_html( $number ); ?>" size="3"/>
            </p>
            <p>
                <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?>
                       id="<?php echo esc_html( $this->get_field_id( 'show_date' ) ); ?>"
                       name="<?php echo esc_html( $this->get_field_name( 'show_date' ) ); ?>"/>
                <label for="<?php echo esc_html( $this->get_field_id( 'show_date' ) ); ?>">
					<?php esc_html_e( 'Display post date?', 'mokime' ); ?>
                </label>
            </p>
			<?php
		}
	}
}
