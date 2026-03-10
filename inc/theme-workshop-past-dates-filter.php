<?php


/**
 * Parse German date term labels like:
 * Donnerstag, 20. August 2026, 17:30 Uhr
 */
function dig_parse_german_datum_term_to_datetime($term_name) {
    $term_name = trim(wp_strip_all_tags($term_name));

    if ($term_name === '') {
        return false;
    }

    $term_name = preg_replace('/^[^,]+,\s*/u', '', $term_name); // remove weekday
    $term_name = preg_replace('/\s*Uhr\s*$/u', '', $term_name); // remove Uhr

    $months = [
        'januar'    => 1,
        'februar'   => 2,
        'märz'      => 3,
        'maerz'     => 3,
        'april'     => 4,
        'mai'       => 5,
        'juni'      => 6,
        'juli'      => 7,
        'august'    => 8,
        'september' => 9,
        'oktober'   => 10,
        'november'  => 11,
        'dezember'  => 12,
    ];

    if (!preg_match('/(\d{1,2})\.\s+([^\s]+)\s+(\d{4}),\s+(\d{1,2}):(\d{2})/u', $term_name, $m)) {
        return false;
    }

    $day        = (int) $m[1];
    $month_name = mb_strtolower($m[2], 'UTF-8');
    $year       = (int) $m[3];
    $hour       = (int) $m[4];
    $minute     = (int) $m[5];

    if (!isset($months[$month_name])) {
        return false;
    }

    try {
        $dt = new DateTime('now', wp_timezone());
        $dt->setDate($year, $months[$month_name], $day);
        $dt->setTime($hour, $minute, 0);
        return $dt;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Check whether product belongs to "erlebnisse" category
 * or any child of it.
 */
function dig_product_is_in_erlebnisse_tree($product_id) {
    $terms = get_the_terms($product_id, 'product_cat');

    if (empty($terms) || is_wp_error($terms)) {
        return false;
    }

    foreach ($terms as $term) {
        if ($term->slug === 'erlebnisse') {
            return true;
        }

        $ancestors = get_ancestors($term->term_id, 'product_cat');

        if (!empty($ancestors)) {
            foreach ($ancestors as $ancestor_id) {
                $ancestor = get_term($ancestor_id, 'product_cat');
                if ($ancestor && !is_wp_error($ancestor) && $ancestor->slug === 'erlebnisse') {
                    return true;
                }
            }
        }
    }

    return false;
}

/**
 * Remove expired pa_datum options from the variation dropdown.
 */
add_filter('woocommerce_dropdown_variation_attribute_options_args', function($args) {
    if (is_admin()) {
        return $args;
    }

    if (empty($args['attribute']) || $args['attribute'] !== 'pa_datum') {
        return $args;
    }

    if (empty($args['product']) || !is_a($args['product'], 'WC_Product')) {
        return $args;
    }

    $product = $args['product'];

    if (!dig_product_is_in_erlebnisse_tree($product->get_id())) {
        return $args;
    }

    if (empty($args['options']) || !is_array($args['options'])) {
        return $args;
    }

    $now = new DateTime('now', wp_timezone());

    $args['options'] = array_values(array_filter($args['options'], function($option_slug) use ($now) {
        $term = get_term_by('slug', $option_slug, 'pa_datum');

        if (!$term || is_wp_error($term)) {
            return true; // keep if term not found
        }

        $dt = dig_parse_german_datum_term_to_datetime($term->name);

        if (!$dt) {
            return true; // keep if parsing fails
        }

        return $dt >= $now;
    }));

    return $args;
}, 10, 1);