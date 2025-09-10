<?php
get_header();
do_action( 'before_main_content' );
?>
<section id="404" class="pt-[100px] md:pt-[120px] xl:pt-[143px] pb-[158px]">
  <div class="theme-container">
	<div class="theme-grid">
	  <div class="container-wrapper col-start-1 col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-10 text-center bg-dark rounded-lg h-[693px] items-center flex flex-col justify-center">
		<div class="text-center pt-[70px]">
			<p class="text-background text-9xl font-barlowSemiCondensed font-bold uppercase"><?php echo __( '404', 'aleandbread' ); ?></p>
		</div>
		<div class="text-center pt-6">
			<h2 class="text-background "><?php echo __( 'nicht gefunden', 'aleandbread' ); ?></h2>
		</div>
		<div class="text-center capitalize -mt-2">
			<h4 class="text-background pt-2 max-w-[350px] md:max-w-[625px] font-medium"><?php esc_html_e( 'Die von Ihnen angeforderte Seite existiert nicht mehr oder hat unter dieser Adresse nie existiert.', 'aleandbread' ); ?></h4>
		</div>
		<div class="border-t-[2px] border-accent w-[300px] md:w-[550px] xl:w-[1140px] mt-[55px]  xl:mt-[116px]">
		</div>
		<div class="text-center pt-8 md:pt-[32px]">
			<h2 class="text-background max-w-[300px] md:max-w-full"><?php esc_html_e( 'Sieht aus, als hätten Sie zu viel Gin getrunken.', 'aleandbread' ); ?></h2>
		</div>
		<div class="text-center col-start-6 col-span-2 pt-[39px] pb-[61px]">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block w-[274px] bg-accent text-white font-barlow text-base font-semibold px-6 border-2 border-accent py-3 hover:bg-dark hover:border-accent hover:border-2 transition uppercase"><?php esc_html_e( 'Zurück zur Startseite', 'aleandbread' ); ?></a>
		</div>
	  </div>
</section>
<?php
do_action( 'after_main_content' );
get_footer();
