<?php
// Server-side enforcement for age verification (WooCommerce contexts).
add_action(
	'template_redirect',
	function () {
		if ( is_admin() || wp_doing_ajax() ) return;

		// Permitir endpoints essenciais (SEO/APIs).
		$uri = $_SERVER['REQUEST_URI'] ?? '';
		foreach ( ['/robots.txt', '/sitemap.xml', '/sitemap_index.xml', '/wp-json/'] as $path) {
			if ( stripos( $uri, $path ) === 0 ) return;
		}

		// Bypass crawlers (SEO).
		$ua = strtolower( $_SERVER['HTTP_USER_AGENT'] ?? '' );
		if ( preg_match( '/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|linkedinbot|pinterest|embedly/i', $ua ) ) {
			return;
		}

		// Já verificado?.
		$verified = ! empty( $_COOKIE['age_gate'] ) && $_COOKIE['age_gate'] === 'verified';
		if ( $verified ) return;

		// Aplicar apenas na loja (afina se quiseres: só categoria "alcool", etc.).
		if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_product() || is_shop() ) ) {
			// Evitar cache desta resposta de bloqueio:
			nocache_headers(); // envia Cache-Control/Pragma/Expires adequados.
			status_header( 200 );
			wp_die(
				'<h1>Acesso restrito a maiores de 18</h1><p>Ativa o JavaScript para confirmar a tua idade ou usa o método alternativo (sem JS) disponível no site.</p>',
				'Verificação de idade',
				[ 'response' => 200 ]
			);
		}
	}
);


// Inline modal markup - será aberto com Fancybox se não houver cookie.
add_action(
	'wp_body_open',
	function () {
		?>
		<div id="age-gate-inline" class="hidden">
			<div
				role="dialog"
				aria-modal="true"
				aria-labelledby="age-gate-title"
				aria-describedby="age-gate-desc"
				class="max-w-md rounded-2xl bg-white p-6 shadow-xl text-neutral-900"
			>
				<h2 id="age-gate-title" class="text-xl font-semibold">Confirma a tua idade</h2>
				<p id="age-gate-desc" class="mt-2 text-neutral-700">
					Este website é apenas para maiores de 18 anos.
				</p>

				<div class="mt-6 flex gap-3">
					<button type="button"
						class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 focus-visible:outline-none focus-visible:ring"
						data-age-accept>
						Tenho 18 ou mais
					</button>
					<a href="https://www.google.com"
						class="px-4 py-2 rounded-xl bg-neutral-200 text-neutral-900 hover:bg-neutral-300 focus-visible:outline-none focus-visible:ring">
						Não tenho
					</a>
				</div>

				<p class="sr-only">O diálogo não fecha com a tecla Esc por requisito legal.</p>
				<noscript><p class="mt-4 text-sm text-neutral-600">Sem JavaScript? Visita a página “Verificação de Idade” para confirmação manual.</p></noscript>
			</div>
		</div>
		<?php
	}
);