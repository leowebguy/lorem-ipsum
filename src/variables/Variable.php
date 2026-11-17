<?php

/**
 * Lorem Ipsum Generator for Craft
 *
 * @author     Leo Leoncio
 * @see        https://github.com/leowebguy
 * @copyright  Copyright (c) 2026, leowebguy
 */

namespace leowebguy\loremipsum\variables;

use leowebguy\loremipsum\base\Loremipsum;

class Variable
{
    private Loremipsum $lorem;

    public function __construct()
    {
        $this->lorem = new Loremipsum();
    }

    public function w(int $count = 5): string
    {
        return $this->lorem->words($count);
    }

    /**
     * @param string|string[]|bool $tag
     */
    public function s(int $count = 1, string|array|bool $tag = false): string
    {
        return $this->lorem->sentences($count, $tag);
    }

    /**
     * @param string|string[]|bool $tag
     */
    public function p(int $count = 1, string|array|bool $tag = false): string
    {
        return $this->lorem->paragraphs($count, $tag);
    }
}
