(function ($) {
    let currentPage = 1;
    let loading = false;

    // Sentinel element — sits below the product grid, triggers load when visible
    const $sentinel = $('<div id="scroll-sentinel" style="height:1px"></div>');
    const $loader = $('<div id="scroll-loader" class="block-text font-semibold text-blockText text-center py-10 hidden">Loading...</div>');

    $('.grid.grid-cols-1.xl\\:grid-cols-3.gap-6').after($sentinel).after($loader);

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting && !loading) {
                loadMore();
            }
        });
    }, { rootMargin: '200px' }); // start loading 200px before reaching the bottom

    observer.observe($sentinel[0]);

    function loadMore() {
        if (currentPage >= infiniteScroll.max_pages) {
            observer.disconnect();
            $sentinel.remove();
            $loader.hide();
            return;
        }

        loading = true;
        currentPage++;
        $loader.show();

        $.post(infiniteScroll.ajaxurl, {
            action: 'load_more_products',
            nonce:  infiniteScroll.nonce,
            page:   currentPage,
        })
        .done(function (response) {
            if (response.success) {
                $('.grid.grid-cols-1.xl\\:grid-cols-3.gap-6').append(response.data.html);

                // Re-observe sentinel after appending
                observer.unobserve($sentinel[0]);
                observer.observe($sentinel[0]);
            }
        })
        .always(function () {
            loading = false;
            $loader.hide();
        });
    }

})(jQuery);