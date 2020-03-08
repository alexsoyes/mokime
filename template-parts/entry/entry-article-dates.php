<div class="section-inner__date">
    <p>
		<?php esc_html_e( 'Post published on ', 'mokime' ); ?>
        <time class="tag" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>">
			<?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
        </time>
    </p>
    <p>
		<?php esc_html_e( ' Last modified on ', 'mokime' ); ?>
        <time class="tag" datetime="<?php echo esc_html( get_the_modified_date( 'c' ) ); ?>">
			<?php echo esc_html( get_the_modified_date( 'j F Y' ) ); ?>
        </time>
    </p>
</div><!-- .section-inner__date -->
