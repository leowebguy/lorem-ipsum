<?php

/**
 * Lorem Ipsum Generator for Craft
 *
 * @author     Leo Leoncio
 * @see        https://github.com/leowebguy
 * @copyright  Copyright (c) 2024, leowebguy
 */

namespace leowebguy\loremipsum\variables;

use joshtronic\LoremIpsum;

class Variable
{
    private LoremIpsum $lorem;

    public function __construct()
    {
        $this->lorem = new LoremIpsum();
    }

    public function w(int $count = 5): string
    {
        $words = $this->lorem->words($count);

        return is_string($words) ? $words : '';
    }

    /**
     * @param string|string[]|bool $tag
     */
    public function s(int $count = 1, string|array|bool $tag = false): string
    {
        $sentences = $this->lorem->sentences($count, $tag);

        return is_string($sentences) ? $sentences : '';
    }

    /**
     * @param string|string[]|bool $tag
     */
    public function p(int $count = 1, string|array|bool $tag = false): string
    {
        $paragraphs = $this->lorem->paragraphs($count, $tag);

        return is_string($paragraphs) ? $paragraphs : '';
    }
}
