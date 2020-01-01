<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">

		<?php if ( has_custom_logo() ) :
			$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			$site_name = get_bloginfo( 'name' );
			?>

            <a class="navbar-item" href="<?php get_site_url(); ?>">
                <img src="<?php echo $image[0]; ?>" alt="<?php echo $site_name; ?>" title="<?php echo $site_name; ?>" />
            </a>

		<?php endif; ?>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">

		<?php
		if ( has_nav_menu( 'primary' ) ) {

			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'menu'            => '',
					'walker'          => new Mokime_Walker_Nav_Menu(),
					'container'       => false,
					'items_wrap'      => '<div class="navbar-end">%3$s</div>',
				)
			);
		}
		?>
    </div>
</nav>
