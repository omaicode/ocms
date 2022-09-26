<?php

namespace Omaicode\Repository\Traits;

/**
 * Class TransformableTrait
 * @package Omaicode\Repository\Traits
 * @author Anderson Andrade <contato@andersonandra.de>
 */
trait TransformableTrait
{
    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }
}
