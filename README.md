## Lorem Ipsum Generator for Craft

Extending [PHP Lorem Ipsum](https://github.com/joshtronic/php-loremipsum) by @joshtronic

### Installation

Open your terminal and go to your Craft project:

```bash
composer require leowebguy/lorem-ipsum -w && php craft plugin/install lorem-ipsum
```

### Usage

The plugin exposes these methods to Twig:

#### Words

```twig
{{ craft.lorem.w(1) }} >> 1 word
{{ craft.lorem.w(5) }} >> 5 words
```

#### Sentences

```twig
{{ craft.lorem.s(1) }} >> 1 sentence
{{ craft.lorem.s(2) }} >> 2 sentences
```

#### Paragraphs

```twig
{{ craft.lorem.p(1) }} >> 1 paragraph
{{ craft.lorem.p(2) }} >> 2 paragraphs
```

&nbsp;

#### Need it wrapped ? Just use Twig `{{ tag }}`

```twig
{{ tag('p', { 
  text: craft.lorem.w(10), 
  class: 'text-center' }) 
}}

output >> <p class="text-center">lorem ipsum...</p>
```

#### With twig utils

```twig
craft.lorem.w(10)|title << Uppercases the first character of each word in a string.
craft.lorem.w(10)|upper << Formats a string into “UPPER CASE”.
craft.lorem.w(10)|ucfirst << Capitalizes the first character of a string.
craft.lorem.w(10)|lower << Formats a string into “lower case”.
```

#### You may also provide a `tag` for `sentences` and `paragraphs`

```twig
{{ craft.lorem.s(2, 'p') 

output >> <p>lorem ipsum...</p><p>lorem ipsum...</p>
```

&nbsp;

### Great for data templating fallback!

```twig
{% set data = {
    heading: entry.heading ?? craft.lorem.w(6),
    copy: entry.copy ?? craft.lorem.w(32)
} %}

<div>
  <h2>{{ data.heading }}</h2>
  <p>{{ data.copy }}</p>
</div>
```
