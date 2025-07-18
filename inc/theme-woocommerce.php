<?php

// Remove default WooCommerce wrappers and breadcrumb hook
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


// Add custom wrappers
add_action('woocommerce_before_main_content', 'aleandbread_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'aleandbread_wrapper_end', 10);

// Custom wrapper start
function aleandbread_wrapper_start() {
    echo '<main id="main-content" class="main-content overflow-hidden mt-auto pt-[106px]">';
    echo '<div class="theme-container pb-[55px] md:pb-[92px] xl:pb-[192px] pt-[152px] md:pt-[194px] xl:pt-[170px]">';

    // Breadcrumbs now live here, *inside* the container
    if (function_exists('woocommerce_breadcrumb')) {
        woocommerce_breadcrumb(array(
            'delimiter'   => ' &raquo; ',
            'wrap_before' => '<div class="theme-grid"><div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-2 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full"><nav class="woocommerce-breadcrumb">',
            'wrap_after'  => '</nav></div></div>',
            'before'      => '',
            'after'       => '',
        ));
    }
}

// Custom wrapper end
function aleandbread_wrapper_end() {
    echo '</div></main>';
}



/**
 * This function closes the main content.
 */
function aleandbread_shop_categories() {
	// Mostra as categorias desejadas com ACF
	$shop_cats = get_field( 'shop_page_categories', 'option' );
	if ( $shop_cats ) :
		?>
		<ul class="shop-categories theme-grid">
			<?php
			foreach( $shop_cats as $shop_cat ) :
			?>
				<li class="card-category col-span-2 md:col-span-3 xl:col-span-4">
					<a href="<?php echo esc_url( get_term_link( $shop_cat ) ); ?>">
						<div class="card-category--content">
							<span class="overlay"></span>
							<p class="block-text"><?php echo esc_html( $shop_cat->description ); ?></p>
							<div class="card-category--title-wrapper flex justify-between items-center w-full">
								<h2 class="card-category--title"><?php echo esc_html( $shop_cat->name ); ?></h2>
								<i class="card-category--arrow"></i>
							</div>
						</div>
					</a>
				</li>
			<?php
			endforeach;
			?>
		</ul>
		<?php
	endif;
}

add_action( 'shop_categories', 'aleandbread_shop_categories', 10 );
