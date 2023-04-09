<?php
/**
 * Lorem Ipsum Generator for Craft
 *
 * @author     Leo Leoncio
 * @see        https://github.com/leowebguy
 * @copyright  Copyright (c) 2023, leowebguy
 */

namespace leowebguy\loremipsum\variables;

use joshtronic\LoremIpsum;

class Variable
{
    // Properties
    // =========================================================================

    private LoremIpsum $lorem;

    // Construct
    // =========================================================================

    public function __construct()
    {
        $this->lorem = new LoremIpsum();
    }

    // Methods
    // =========================================================================

    public function w($count = 5)
    {
        return $this->lorem->words($count);
    }

    public function s($count = 1, $tag = false)
    {
        return $this->lorem->sentences($count, $tag);
    }

    public function p($count = 1, $tag = false)
    {
        return $this->lorem->paragraphs($count, $tag);
    }
}
