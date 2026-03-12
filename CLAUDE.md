# Ale and Bread — Project Context

## Stack
- WordPress custom theme
- WooCommerce
- Tailwind CSS + Laravel Mix
- PHP 8.0+

## Custom Post Types
- `blog` — artigos de blog e receitas (distinguidos por campo ACF `blog_post_format`)
- `event` — eventos com data/hora, local e descrição

## Plugins usados
- Atenção: alguns plugins são apenas usados localmente!
- advanced-custom-fields-pro 6.7.0.2
- age-gate 3.7.2
- contact-form-7 6.1.4
- flexible-coupons-pro 2.4.11
- mailchimp-for-wp 4.10.9
- woocommerce 10.4.2
- woocommerce-gateway-stripe 10.2.0
- woocommerce-multilingual 5.5.3.1
- sitepress-multilingual-cms 4.8.6 (WPML)
- wpml-string-translation 3.4.1
- wordpress-seo 26.6 (Yoast SEO)
- acfml 2.1.5

## ACF Field Groups

### CPT: `blog` — group `blog_cpt`
Acesso: `get_field('blog_cpt')` devolve array com todas as sub-fields.
- `blog_cpt['blog_post_format']` (radio: `'article'` | `'recipe'`)
- `blog_cpt['description']` (text)
- `blog_cpt['button']` (link, array)
- `blog_cpt['image']` (image, returns id)
- `blog_cpt['recipe']` (group, condicional se `blog_post_format = recipe`):
  - `['servings']` (text, ex: "1 Cocktail")
  - `['prep_time']` (number, minutos)
  - `['ingredients']` (repeater → `['ingredient']` text)
  - `['steps']` (repeater → `['step']` textarea)
  - `['set']` (repeater → `['item']` text — guarnição)
  - `['serving_suggestion']` (textarea)

### CPT: `event` — group `events_cpt`
Atenção: campos acedidos com chave achatada (flattened), não via array de grupo.
- `get_field('events_cpt_title')` (text)
- `get_field('events_cpt_description')` (textarea)
- `get_field('events_cpt_image')` (image, returns id)
- `get_field('events_cpt_event_date_start', $id, false)` (Y-m-d H:i:s)
- `get_field('events_cpt_event_date_end', $id, false)` (Y-m-d H:i:s)
- `get_field('events_cpt_place')` (text)
- `get_field('events_cpt_small_description')` (textarea)
- `get_field('events_cpt_button')` (link, array)
- `get_field('events_cpt_time')` / `get_field('events_cpt_date')` — legado, não usar
- `our_experiences` group: image, over_title, title, description

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
- Schema injectado via JSON-LD no `wp_head` (ficheiros dedicados em `inc/`), NÃO via Yoast Schema API
- Ficheiros de schema:
  - `inc/schema-blog.php` → CPT `blog`: Recipe (se `blog_post_format = recipe`); Article coberto pelo Yoast
  - `inc/schema-faq.php` → Page FAQ: FAQPage (todas as perguntas de todos os grupos achatadas)
  - `inc/schema-event.php` → CPT `event`: Event com startDate, endDate, location, organizer
- Para receitas, Yoast é instruído a usar `WebPage` em vez de `Article` via filtro `wpseo_schema_webpage_type`

## PHPDoc — Padrão obrigatório

Todo o ficheiro PHP deve ter file-level docblock e docblocks em todas as funções.

**File header:**
```php
<?php
/**
 * Breve descrição do ficheiro.
 *
 * @package AleanBread
 */
```

**Função:**
```php
/**
 * Breve descrição do que a função faz.
 *
 * @param int    $post_id The post ID.
 * @param array  $fields  The ACF field group values.
 * @return array The schema array ready for JSON encoding.
 */
function aleandbread_example( $post_id, $fields ) {}
```

**Tags mais usadas:** `@param type $name desc`, `@return type desc`, `@since 1.0.0`, `@see function_name()`

Tipos PHP válidos: `int`, `string`, `bool`, `float`, `array`, `null`, `void`, `WP_Post`, `WP_Query`

## Convenções
- Responder sempre em português de portugal no chat; comentários em código em inglês (en-GB)
- Não usar plugins desnecessários; preferir código no tema ou plugins já instalados
- Seguir PHP Coding Standards: https://github.com/PHPCSStandards/PHP_CodeSniffer/
- Seguir WordPress Coding Standards: https://github.com/WordPress/WordPress-Coding-Standards
- Prefixo de funções: `aleandbread_` (ex: `aleandbread_build_recipe_schema`)
- Usar `array()` em vez de `[]` em código PHP puro (WCS)
- Sanitizar outputs: `esc_html()`, `esc_url()`, `wp_kses_post()`, `sanitize_text_field()`
