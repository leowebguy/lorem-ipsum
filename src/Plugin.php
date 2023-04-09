<?php
/**
 * Lorem Ipsum Generator for Craft
 *
 * @author     Leo Leoncio
 * @see        https://github.com/leowebguy
 * @copyright  Copyright (c) 2023, leowebguy
 */

namespace leowebguy\loremipsum;

use Craft;
use craft\base\Plugin as BasePlugin;
use craft\web\twig\variables\CraftVariable;
use leowebguy\loremipsum\variables\Variable;
use yii\base\Event;

class Plugin extends BasePlugin
{
    // Properties
    // =========================================================================

    public bool $hasCpSection = false;

    public bool $hasCpSettings = false;

    // Methods
    // =========================================================================

    /**
     * @return void
     */
    public function init(): void
    {
        parent::init();

        if (!$this->isInstalled) {
            return;
        }

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('lorem', Variable::class);
            }
        );

        Craft::info(
            'Lorem Ipsum plugin loaded',
            __METHOD__
        );
    }
}
