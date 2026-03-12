# Ale and Bread — Project Context

## Stack
- WordPress custom theme
- WooCommerce
- Tailwind CSS + Laravel Mix
- PHP 8.0+

## Custom Post Types
- `blog` — artigos de blog
- `event` — eventos com data/hora, local e descrição

## Plugins usados
- Atenção Alguns plugins sao apenas usado localmente!
- +------------------------------------+--------+-----------+---------+----------------+-------------+
| name                               | status | update    | version | update_version | auto_update |
+------------------------------------+--------+-----------+---------+----------------+-------------+
| acf-content-analysis-for-yoast-seo | active | none      | 3.2     |                | off         |
| acfml                              | active | none      | 2.1.5   |                | off         |
| advanced-custom-fields-pro         | active | available | 6.7.0.2 | 6.7.1          | off         |
| age-gate                           | active | none      | 3.7.2   |                | off         |
| alttext-ai                         | active | available | 1.10.15 | 1.10.30        | off         |
| contact-form-7                     | active | available | 6.1.4   | 6.1.5          | off         |
| debug-bar                          | active | available | 1.1.7   | 1.1.8          | off         |
| flexible-coupons-sending           | active | available | 2.0.7   | 2.0.9          | off         |
| flexible-coupons-shortcodes        | active | available | 1.0.31  | 1.1.0          | off         |
| flexible-coupons-pro               | active | available | 2.4.11  | 2.5.1          | off         |
| google-listings-and-ads            | active | available | 3.5.1   | 3.5.3          | off         |
| log-deprecated-notices             | active | none      | 0.4.1   |                | off         |
| wpml-mailchimp-for-wp              | active | none      | 0.1.0   |                | off         |
| mailchimp-for-wp                   | active | available | 4.10.9  | 4.12.0         | off         |
| query-monitor                      | active | none      | 3.20.2  |                | off         |
| regenerate-thumbnails              | active | none      | 3.1.6   |                | off         |
| safe-svg                           | active | none      | 2.4.0   |                | off         |
| woo-variation-swatches             | active | available | 2.2.2   | 2.2.3          | off         |
| woocommerce                        | active | available | 10.4.2  | 10.6.0         | off         |
| woo-update-manager                 | active | none      | 1.0.3   |                | off         |
| woocommerce-gateway-stripe         | active | available | 10.2.0  | 10.5.0         | off         |
| wordpress-importer                 | active | none      | 0.9.5   |                | off         |
| woocommerce-multilingual           | active | none      | 5.5.3.1 |                | off         |
| sitepress-multilingual-cms         | active | none      | 4.8.6   |                | off         |
| contact-form-7-multilingual        | active | none      | 1.3.3   |                | off         |
| wp-seo-multilingual                | active | none      | 2.2.4   |                | off         |
| wpml-string-translation            | active | none      | 3.4.1   |                | off         |
| duplicate-post                     | active | available | 4.5     | 4.6            | off         |
| wordpress-seo                      | active | available | 26.6    | 27.1.1         | off         |
+------------------------------------+--------+-----------+---------+----------------+-------------+

## ACF Field Groups

### CPT: `blog` — group `blog_cpt`
- `blog_cpt.description` (text)
- `blog_cpt.button` (link, array)
- `blog_cpt.image` (image, returns id)

### CPT: `event` — group `events_cpt`
- `events_cpt.title` (text)
- `events_cpt.description` (textarea)
- `events_cpt.image` (image, returns id)
- `events_cpt.time` (text — legado, preferir event_date)
- `events_cpt.date` (text — legado, preferir event_date)
- `events_cpt.event_date.start` (date_time_picker, formato `Y-m-d H:i:s`)
- `events_cpt.event_date.end` (date_time_picker, formato `Y-m-d H:i:s`)
- `events_cpt.place` (text)
- `events_cpt.small_description` (textarea)
- `events_cpt.button` (link, array)
- `our_experiences.image` / `over_title` / `title` / `description` (group para card de experiências)

### Page Template: `page-templates/page-faq.php` — FAQ CF
- `title` (text)
- `faq` (repeater) → `title` + `faq_accordion` (repeater nested) → `question` + `response`

### Page Template: `page-templates/page-distellerie.php` — Distellerie CF
- `hero` group: background, background_tablet, title, description, button
- `craftmanship` group: image_1–4, title, sub_title, description, button, gallery_title, gallery_title_2, gallery
- `gin_makes_history` group: title, subtitle, image, image_title, image_description

### Page Template: `page-templates/distillery-Aktienmühle.php` — Distillery Aktienmühle CF
- `distillery_aktienmuhle` group: title, subtitle, description, subtitle2, description2, contact, address, swiper (gallery)
- `our_experience` group: over_title, title, description, background_image_desktop/tablet/mobile, button

### Page Template: `page-templates/page-experiences.php` — Erlebnisse CF
- `hero` group: title, background, description
- `events` group: background_image, over_title, title, description

## Schema / SEO
- Plugin instalado: **Yoast SEO** (`wordpress-seo` v26.6)
- Para schema customizado usar a **Yoast Schema API** (filtros `wpseo_schema_graph_pieces` e `wpseo_schema_*`)
- Referências:
  - https://yoast.com/help/implementing-schema-with-yoast-seo/
  - https://yoast.com/features/structured-data/
- Schema por contexto:
  - CPT `event` → `schema.org/Event` (usar `event_date.start`, `event_date.end`, `place`)
  - CPT `blog` → `schema.org/Article` (já coberto pelo Yoast por omissão)
  - Page FAQ → `schema.org/FAQPage` (mapear repeater `faq` → `faq_accordion` → `question`/`response`)

## Convenções
- Responder sempre em português de portugal no chat, mas comentários em codigo pode e devem ser em ingles(en-en)
- Não usar plugins desnecessários, preferir código no tema ou plugins já instalados.
- Responder sempre que a resposta for codigo escrever o codigo seguindo PHP Coding Standarts https://github.com/PHPCSStandards/PHP_CodeSniffer/ e Wordpress Coding Standarts: https://github.com/WordPress/WordPress-Coding-Standards
