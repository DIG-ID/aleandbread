<?php
/**
 * Template for displaying the sidebar of the shop.
 *
 * @package Ale and Bread
 */

if ( is_active_sidebar( 'shop-sidebar' ) ) :
	?>
	<div class="woocommerce-sidebar w-full bg-white border border-black px-14 pt-12">
		<?php dynamic_sidebar( 'shop-sidebar' ); ?>
	</div>
	<?php
endif;