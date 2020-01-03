</div>

<footer id="site-footer" role="contentinfo"
        class="header-footer-group container is-fluid has-padding-0 has-background-darker">

	<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

    <div class="section-inner">

        <div class="footer-credits">

            <p class="footer-copyright">&copy;
				<?php
				echo date_i18n(
				/* translators: Copyright date format, see https://secure.php.net/date */
					_x( 'Y', 'copyright date format', 'twentytwenty' )
				);
				?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
            </p>

        </div>

    </div>

</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
