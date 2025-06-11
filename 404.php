<?php
get_header();
do_action( 'before_main_content' );
?>
<section class="page-header bg-blue-shade-5 text-blue-shade-1 pt-28 lg:pt-64">
	<div class="theme-container flex flex-col w-full text-center">
		<h2 class="text-title-h3 !font-light text-blue-shade-2 mb-12"><?php esc_html_e( 'Seite nicht gefunden.', 'aleandbread' ); ?></h2>
		<h1 class="font-miller font-light text-[10rem] xl:text-[15.625rem] text-blue-shade-2 leading-none relative xl:-bottom-7"><?php esc_html_e( '404', 'aleandbread' ); ?></h1>
	</div>
</section>
<section class="section-error-404 not-found bg-blue-shade-4 text-blue-shade-1 pt-12 lg:pt-32 pb-12 lg:pb-48">
	<div class="theme-container text-center">
		<h3 class="text-title-h3 !font-light text-blue-shade-2 mb-12"><?php esc_html_e( 'Die von Ihnen gesuchte Seite existiert nicht oder wurde verschoben.', 'aleandbread' ); ?></h3>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-internal btn-internal--shade-4 !py-3 !lg:px-32 !font-light tracking-[0.2px]"><?php esc_html_e( 'zurück zur Startseite', 'aleandbread' ); ?></a>
	</div>
</section>
<?php
do_action( 'after_main_content' );
get_footer();
