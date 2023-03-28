<?php

namespace Modules\Appearance\Events;

class ThemeDisabled
{
    /**
     * @var array|string
     */
    public $theme;

    /**
     * @param $theme
     */
    public function __construct($theme)
    {
        $this->theme = $theme;
    }
}
