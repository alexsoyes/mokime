<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package    WordPress
 * @subpackage MokiMe
 * @from       Twenty_Twenty
 * @since      1.0.0
 */

$next_post = get_next_post();
$prev_post = get_previous_post();

if ( $next_post || $prev_post ) {
	$pagination_classes = '';

	if ( ! $next_post ) {
		$pagination_classes = ' only-one only-prev';
	} elseif ( ! $prev_post ) {
		$pagination_classes = ' only-one only-next';
	} ?>

	<nav class="pagination-single section-inner<?php echo esc_attr( $pagination_classes ); ?>"
		 itemscope itemtype="http://schema.org/SiteNavigationElement"
		 aria-label="<?php esc_attr_e( 'Post', 'mokime' ); ?>" role="navigation">

		<hr aria-hidden="true"/>

		<div class="pagination-single-inner wp-block-columns">

			<?php
			if ( $prev_post ) {
				?>

				<div class="wp-block-column">
					<p class="title-navigation h4 has-text-weight-bold">
						<span class="arrow"
							  aria-hidden="true">&larr;</span> <?php esc_html_e( 'Previous post', 'mokime' ); ?>
					</p>
					<a itemprop="url" class="previous-post h4" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
						<span class="title">
							<span class="title-inner"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span>
						</span>
					</a>
					<div class="excerpt">
						<span class="excerpt-inner has-text-overflowed is-overflowed-3">
						<?php echo wp_kses_post( get_the_excerpt( $prev_post->ID ) ); ?>
						</span>
					</div>
				</div>

				<?php
			}

			if ( $next_post ) {
				?>

				<div class="wp-block-column has-text-align-right">
					<p class="title-navigation h4 has-text-weight-bold"><?php esc_html_e( 'Next post', 'mokime' ); ?>
						<span class="arrow" aria-hidden="true">&rarr;</span>
					</p>
					<a itemprop="url" class="next-post h4" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
						<span class="title">
							<span class="title-inner"><?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?></span>
						</span>
					</a>
					<div class="excerpt">
						<span class="excerpt-inner has-text-overflowed is-overflowed-3">
							<?php echo wp_kses_post( get_the_excerpt( $prev_post->ID ) ); ?>
						</span>
					</div>
				</div>
				<?php
			}
			?>

		</div><!-- .pagination-single-inner -->

		<hr class="styled-separator is-style-wide" aria-hidden="true"/>

	</nav><!-- .pagination-single -->

	<?php
}
