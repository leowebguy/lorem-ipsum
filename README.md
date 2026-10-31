# Lorem Ipsum Generator for Craft CMS

Extending [PHP Lorem Ipsum](https://github.com/joshtronic/php-loremipsum) by @joshtronic.

Generates placeholder words, sentences, and paragraphs for your Craft CMS templates.

## Requirements

This plugin requires:
- **Craft CMS**: `^5.0.0`
- **PHP**: `^8.2 || ^8.3 || ^8.4 || ^8.5`

## Installation

Open your terminal, navigate to your Craft project root, and run:

```bash
composer require leowebguy/lorem-ipsum -w
php craft plugin/install lorem-ipsum
```

## Usage

The plugin exposes the `craft.lorem` variable with the following methods:

### Words

```twig
{{ craft.lorem.w() }}       {# Default: 5 words #}
{{ craft.lorem.w(1) }}      {# 1 word #}
{{ craft.lorem.w(10) }}     {# 10 words #}
```

### Sentences

```twig
{{ craft.lorem.s() }}           {# Default: 1 sentence #}
{{ craft.lorem.s(2) }}          {# 2 sentences #}
{{ craft.lorem.s(1, 'span') }}  {# 1 sentence wrapped in <span> #}
```

### Paragraphs

```twig
{{ craft.lorem.p() }}           {# Default: 1 paragraph #}
{{ craft.lorem.p(2) }}          {# 2 paragraphs #}
{{ craft.lorem.p(1, 'p') }}     {# 1 paragraph wrapped in <p> #}
{{ craft.lorem.p(1, ['p', 'em']) }} {# Wrapped in <p><em>...</em></p> #}
```

### Wrapping HTML

Use Craft/Twig's native `tag()` function to safely build elements with attributes:

```twig
{{ tag('p', { 
    text: craft.lorem.w(10), 
    class: 'text-center text-muted' 
}) }}

{# Output: <p class="text-center text-muted">lorem ipsum dolor sit amet...</p> #}
```

### Twig Filters

You can chain native Twig string filters:

```twig
{{ craft.lorem.w(10)|title }}   {# Title Case #}
{{ craft.lorem.w(10)|upper }}   {# UPPER CASE #}
{{ craft.lorem.w(10)|lower }}   {# lower case #}
{{ craft.lorem.w(10)|capitalize }} {# Capitalize first word #}
```

### Fallback Content in Templates

Ideal for scaffolding layouts before content is entered in the CMS:

```twig
{% set data = {
    heading: entry.heading ?? craft.lorem.w(6),
    copy: entry.copy ?? craft.lorem.p(1)
} %}

<div>
    <h2>{{ data.heading }}</h2>
    <p>{{ data.copy }}</p>
</div>
```
