</main><!-- #content -->

<footer role="contentinfo">

	<?php mokime_the_ads( 'advertising_global_bottom' ); ?>

	<?php if ( is_active_sidebar( 'sidebar-pre-footer' ) ) : ?>
		<div id="prefooter" class="entry-content">
			<?php dynamic_sidebar( 'sidebar-pre-footer' ); ?>
		</div><!-- #prefooter -->
	<?php endif; ?>

	<div id="site-footer" class="site-footer">

		<?php get_template_part( 'template-parts/footer/menus-widgets' ); ?>

		<?php if ( get_site_url() !== 'https://www.security-helpzone.com' ) : ?>
		<div class="section-inner">

			<div class="footer-credits">

				<p class="footer-copyright has-text-align-center">
					<small>
						<a href="https://moki.me" rel="noopener" target="_blank">
							<?php esc_html_e( 'High performance theme', 'mokime' ); ?>
						</a>
						<?php esc_html_e( 'made by ', 'mokime' ); ?>
						<a href="https://www.security-helpzone.com" title="Security-HelpZone" rel="noopener" target="_blank"><?php esc_html_e( 'SHZ', 'mokime' ); ?></a>.
					</small>
				</p><!-- .footer-copyright -->

			</div><!-- .footer-credits -->

		</div><!-- .section-inner -->
		<?php endif; ?>

	</div><!-- .header-footer-group  -->

</footer><!-- #site-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
