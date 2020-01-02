<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
<footer id="site-footer" role="contentinfo" class="header-footer-group">

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
            </p><!-- .footer-copyright -->
            <!---->
            <!--            <p class="powered-by-wordpress">-->
            <!--                <a href="-->
			<?php //echo esc_url( __( 'https://wordpress.org/', 'twentytwenty' ) ); ?><!--">-->
            <!--					--><?php //_e( 'Powered by WordPress', 'twentytwenty' ); ?>
            <!--                </a>-->
            <!--            </p>-->

        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
