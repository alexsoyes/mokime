<div class="header-navigation-wrapper">

	<?php
	if ( has_nav_menu( 'primary' ) ) {
		?>

		<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">

			<ul class="primary-menu reset-list-style">

				<?php
				if ( has_nav_menu( 'primary' ) ) {

					wp_nav_menu(
						array(
							'container'  => '',
							'items_wrap' => '%3$s',
							'theme_location' => 'primary',
						)
					);

				}
				?>

			</ul>

		</nav><!-- .primary-menu-wrapper -->

		<?php
	}
	?>

</div>