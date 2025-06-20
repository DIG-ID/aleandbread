<?php

// Remove default WooCommerce wrappers and add custom ones
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'aleandbread_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'aleandbread_wrapper_end', 10);

function aleandbread_wrapper_start() {
	echo '<main id="main-content" class="main-content overflow-hidden mt-auto">';
}

function aleandbread_wrapper_end() {
	echo '</main>';
}

/**
 * This function closes the main content.
 */
function aleandbread_shop_categories() {
	// Mostra as categorias desejadas com ACF
	$shop_cats = get_field( 'shop_page_categories', 'option' );
	if ( $shop_cats ) :
		?>
		<ul class="shop-categories grid grid-cols-3 gap-x-5">
			<?php
			foreach( $shop_cats as $shop_cat ) :
			?>
				<li class="card-category">
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
