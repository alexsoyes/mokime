<article>

	<header class="article-header">
		<?php get_template_part( 'template-parts/entry/entry-header' ); ?>
	</header><!-- .article-header -->

	<?php mokime_the_ads( 'advertising_global_top' ); ?>

	<div class="entry-content">
        <?php get_template_part( 'template-parts/entry/entry-breadcrumb' ); ?>
		<?php get_template_part( 'template-parts/entry/entry-posts' ); ?>
	</div><!-- .entry-content -->

</article>
