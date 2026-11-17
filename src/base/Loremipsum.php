<?php

namespace leowebguy\loremipsum\base;

class Loremipsum
{
    private const FIRST_WORDS = [
        'lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
    ];

    private const REST_WORDS = [
        'accumsan', 'ad', 'aenean', 'aliquam', 'aliquet', 'ante',
        'aptent', 'arcu', 'at', 'auctor', 'augue', 'bibendum', 'blandit',
        'class', 'commodo', 'condimentum', 'congue', 'consequat', 'conubia',
        'convallis', 'cras', 'cubilia', 'curabitur', 'curae', 'cursus',
        'dapibus', 'diam', 'dictumst', 'dignissim', 'dis', 'donec',
        'dui', 'duis', 'efficitur', 'egestas', 'eget', 'eleifend',
        'enim', 'erat', 'eros', 'est', 'et', 'etiam', 'eu', 'euismod', 'ex',
        'facilisi', 'facilisis', 'fames', 'faucibus', 'felis', 'fermentum',
        'feugiat', 'finibus', 'fringilla', 'gravida', 'habitant',
        'habitasse', 'hac', 'hendrerit', 'himenaeos', 'iaculis', 'id',
        'imperdiet', 'in', 'inceptos', 'integer', 'interdum', 'justo',
        'lacinia', 'lacus', 'laoreet', 'lectus', 'libero', 'ligula',
        'litora', 'lobortis', 'luctus', 'maecenas', 'magna', 'magnis',
        'malesuada', 'massa', 'mattis', 'maximus', 'metus', 'mi',
        'molestie', 'mollis', 'montes', 'morbi', 'mus', 'nascetur',
        'natoque', 'nec', 'neque', 'netus', 'nibh', 'nisi', 'nisl', 'non',
        'nostra', 'nulla', 'nullam', 'nunc', 'odio', 'orci', 'ornare',
        'parturient', 'pellentesque', 'penatibus', 'per', 'pharetra',
        'placerat', 'platea', 'porta', 'porttitor', 'posuere',
        'potenti', 'praesent', 'pretium', 'primis', 'proin', 'pulvinar',
        'purus', 'quam', 'quis', 'quisque', 'rhoncus', 'ridiculus', 'risus',
        'rutrum', 'sagittis', 'sapien', 'scelerisque', 'sed', 'sem',
        'senectus', 'sociosqu', 'sodales', 'sollicitudin', 'suscipit',
        'suspendisse', 'taciti', 'tellus', 'tempor', 'tincidunt',
        'torquent', 'tortor', 'turpis', 'ullamcorper', 'ultrices',
        'ultricies', 'urna', 'ut', 'vehicula', 'vel', 'velit',
        'venenatis', 'vestibulum', 'vivamus', 'viverra', 'volutpat'
    ];

    private const ALL_WORDS = [
        ...self::FIRST_WORDS,
        ...self::REST_WORDS,
    ];

    private bool $first = true;

    public function words(int $count = 1, string|array|bool $tags = false): string
    {
        return $this->output($this->getWords(max(1, $count)), $tags, ' ');
    }

    public function sentences(int $count = 1, string|array|bool $tags = false): string
    {
        $sentences = [];
        $count = max(1, $count);

        for ($i = 0; $i < $count; $i++) {
            $wordCount = max(1, $this->gauss(24.46, 5.08));
            $sentences[] = $this->punctuate($this->getWords($wordCount));
        }

        return $this->output($sentences, $tags, ' ');
    }

    public function paragraphs(int $count = 1, string|array|bool $tags = false): string
    {
        $paragraphs = [];
        $count = max(1, $count);

        for ($i = 0; $i < $count; $i++) {
            $sentenceCount = max(1, $this->gauss(5.8, 1.93));
            $sentences = [];

            for ($j = 0; $j < $sentenceCount; $j++) {
                $wordCount = max(1, $this->gauss(24.46, 5.08));
                $sentences[] = $this->punctuate($this->getWords($wordCount));
            }

            $paragraphs[] = implode(' ', $sentences);
        }

        return $this->output($paragraphs, $tags, "\n\n");
    }

    private function getWords(int $count): array
    {
        $words = [];
        $wordCount = 0;

        while ($wordCount < $count) {
            if ($this->first) {
                $rest = self::REST_WORDS;
                shuffle($rest);
                $chunk = [...self::FIRST_WORDS, ...$rest];
                $this->first = false;
            } else {
                $chunk = self::ALL_WORDS;
                shuffle($chunk);

                if ($wordCount > 0 && $words[$wordCount - 1] === $chunk[0]) {
                    continue;
                }
            }

            $words = array_merge($words, $chunk);
            $wordCount = count($words);
        }

        return array_slice($words, 0, $count);
    }

    private function punctuate(array $words): string
    {
        $count = count($words);

        if ($count > 4) {
            $mean = log($count, 6);
            $commas = $this->gauss($mean, $mean / 6);

            for ($i = 1; $i <= $commas; $i++) {
                $index = (int) round($i * $count / ($commas + 1));

                if ($index > 0 && $index < ($count - 1)) {
                    $words[$index] .= ',';
                }
            }
        }

        return ucfirst(implode(' ', $words)) . '.';
    }

    private function output(array $strings, string|array|bool $tags, string $delimiter): string
    {
        if ($tags) {
            $tagList = is_array($tags) ? array_reverse($tags) : [$tags];

            foreach ($strings as &$string) {
                foreach ($tagList as $tag) {
                    if (is_string($tag) && $tag !== '') {
                        if ($tag[0] === '<') {
                            $string = str_replace('$1', $string, $tag);
                        } else {
                            $string = "<{$tag}>{$string}</{$tag}>";
                        }
                    }
                }
            }
            unset($string);
        }

        return implode($delimiter, $strings);
    }

    private function gauss(float $mean, float $stdDev): int
    {
        $x = max(1e-10, mt_rand() / mt_getrandmax());
        $y = mt_rand() / mt_getrandmax();
        $z = sqrt(-2.0 * log($x)) * cos(2.0 * M_PI * $y);

        return (int) round($z * $stdDev + $mean);
    }
}
