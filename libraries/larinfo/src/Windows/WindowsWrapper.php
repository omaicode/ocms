<?php

namespace Omaicode\Larinfo\Windows;

use Linfo\OS\OS;
use Linfo\OS\Windows;
use Omaicode\Larinfo\Wrapper\LinfoWrapperContract;

class WindowsWrapper implements LinfoWrapperContract
{
    /**
     * @var Windows
     */
    private Windows $windows;

    /**
     * @param Windows $windows
     */
    public function __construct(Windows $windows)
    {
        $this->windows = $windows;
    }

    /**
     * @return OS|null
     */
    public function getParser(): ?OS
    {
        return $this->windows;
    }
}
