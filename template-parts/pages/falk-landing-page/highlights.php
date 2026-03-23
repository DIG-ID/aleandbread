<section id="highlights" class="highlights bg-white pt-24 md:pt-20 pb-24 md:pb-64">
	<div class="theme-container woocommerce">
		<div class="theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-4 xl:pb-24">
				<h1 class="text-blockText"><?php echo wp_kses_post( get_field( 'highlights_title' ) ); ?></h1>
            </div>
            <div class="col-span-2 md:col-span-4 xl:col-start-6 xl:col-span-4 pt-7 md:pt-14 xl:pt-0">
				<p class="text-blockText"><?php echo wp_kses_post( get_field( 'highlights_description' ) ); ?></p>
            </div>
            <div class="col-span-1 md:col-span-3 xl:col-start-11 xl:col-span-2 pt-7 md:pt-12 xl:pt-0 pb-20 xl:pb-0">
				<?php
				$btn      = wc_get_page_permalink( 'shop' );
				$btn_text = get_field( 'highlights_button' );
				if ( $btn ) :
					?>
					<a class="btn btn-primary-2" href="<?php echo esc_url( $btn ); ?>" target="_self"><?php echo esc_html( ! empty( trim( (string) $btn_text ) ) ? $btn_text : __( 'Zu allen Produkten', 'aleandbread' ) ); ?></a>
					<?php
				endif;
				?>
			</div>
		</div>
		<div class="products grid grid-cols-2 xl:grid-cols-4 gap-6">
			<?php
			$highlight_products = get_field( 'highlights_products' );

			if ( ! empty( $highlight_products ) ) :
				foreach ( $highlight_products as $post_object ) :
					setup_postdata( $post_object );
					wc_setup_product_data( $post_object );

					wc_get_template_part( 'content', 'product' );
				endforeach;
				wp_reset_postdata();
				wc_reset_loop();
			else :
				echo '<p class="text-gray-600">' . esc_html__( 'No highlights selected.', 'aleandbread' ) . '</p>';
			endif;
			?>
		</div>
	</div>
</section>