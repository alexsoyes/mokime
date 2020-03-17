<nav itemscope="itemscope" itemtype="http://www.schema.org/SiteNavigationElement" class="navbar is-transparent" role="navigation" aria-label="main navigation">

	<div class="navbar-brand">

		<?php
        if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
            echo sprintf(
                '<a href="%s" class="logo-text"><span class="h1 has-text-weight-bold">%s</span></a>',
                esc_html( get_home_url() ),
                esc_html( get_bloginfo('name') )
            );
        }
        ?>

		<div role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
			 onclick="toggleMobileMenu(this);"
			 data-target="navbarMobile">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</div>
	</div>

	<div id="navbarMobile" class="navbar-menu">
		<?php
		if ( has_nav_menu( 'primary' ) ) {

			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu'           => '',
					'walker'         => new MokiMe_Walker_Nav_Menu(),
					'container'      => false,
					'items_wrap'     => '<div class="navbar-end">%3$s</div><!-- .navbar-end -->',
				)
			);
		}
		?>
	</div><!-- . navbar-menu -->

</nav><!-- .navbar -->
