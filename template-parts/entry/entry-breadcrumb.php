<?php if ( function_exists( 'yoast_breadcrumb' ) ): ?>
    <div class="wp-block-columns breadcrumb">
        <div class="wp-block-column wp-block-column-100">
			<?php yoast_breadcrumb( '<p class="breadcrumbs" id="breadcrumbs">', '</p>' ); ?>
        </div>
    </div><!-- .breadcrumb -->
<?php endif; ?>
