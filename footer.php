</main><!-- #content -->

<footer id="site-footer" class="site-footer" role="contentinfo">

	<?php if ( is_active_sidebar( 'sidebar-pre-footer' ) ) : ?>
		<div id="prefooter" class="container">
			<?php dynamic_sidebar( 'sidebar-pre-footer' ); ?>
		</div><!-- #prefooter -->
	<?php endif; ?>

	<div class="header-footer-group wrapper">

		<?php get_template_part( 'template-parts/footer/menus-widgets' ); ?>

		<div class="section-inner">

			<div class="footer-credits">

				<p class="footer-copyright has-text-align-center">
					<small class="is-white">
						<a href="https://moki.me" title="Theme MokiMe" target="_blank" class="is-white">
							<?php esc_html_e( 'High performance theme', 'mokime' ); ?>
						</a>
						<?php esc_html_e( 'made by ', 'mokime' ); ?>
						<a href="https://www.security-helpzone.com" target="_blank" class="is-white">SHZ</a>.
					</small>
				</p>

			</div><!-- .footer-credits -->

		</div><!-- .section-inner -->

	</div><!-- .header-footer-group  -->

</footer><!-- #site-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
