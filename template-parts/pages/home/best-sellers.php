<section id="best-sellers" class="best-sellers bg-dark pt-0 md:pt-0 xl:pt-36 pb-28 -mt-1">
	<div class="theme-container">
		<div class="theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-start-4 xl:col-span-6 flex flex-col items-center gap-y-7 md:gap-y-12 mb-16">
				<p class="over-title text-accent"><?php echo esc_html( get_field( 'best_sellers_over_title' ) ); ?></p>
				<h1 class="text-blockTextLight text-center"><?php echo wp_kses_post( get_field( 'best_sellers_title' ) ); ?></h1>
				<?php
				$btn      = wc_get_page_permalink( 'shop' );
				$btn_text = get_field( 'best_sellers_button_text' );
				if ( $btn ) :
					?>
					<a class="btn btn-primary" href="<?php echo esc_url( $btn ); ?>" target="_self"><?php echo esc_html( ! empty( trim( (string) $btn_text ) ) ? $btn_text : __( 'zum Shop', 'aleandbread' ) ); ?></a>
					<?php
				endif;
				?>
			</div>
		</div>
		<div class="grid grid-cols-2 xl:grid-cols-4 gap-6">
			<?php
			$args = array(
				'limit'        => 4,
				'status'       => 'publish',
				'meta_key'     => 'total_sales',
				'orderby'      => 'meta_value_num',
				'order'        => 'DESC',
				'stock_status' => 'instock',
			);

			$best_sellers = wc_get_products( $args );

			if ( ! empty( $best_sellers ) ) :
				foreach ( $best_sellers as $product ) :
					$post_object = get_post( $product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					wc_get_template_part( 'content', 'product' );
				endforeach;
				wp_reset_postdata();
			else :
				echo '<p class="text-gray-600">No best sellers yet.</p>';
			endif;
			?>
		</div>
	</div>
</section>
