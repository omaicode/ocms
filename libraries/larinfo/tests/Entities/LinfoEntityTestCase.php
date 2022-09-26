<?php

namespace Omaicode\Larinfo\Tests\Entities;

use Omaicode\Larinfo\Wrapper\LinfoWrapperContract;
use Mockery;
use PHPUnit\Framework\TestCase;

abstract class LinfoEntityTestCase extends TestCase
{
    /**
     * @param  mixed                $parser
     * @return LinfoWrapperContract
     */
    protected function setLinfo($parser): LinfoWrapperContract
    {
        return Mockery::mock(LinfoWrapperContract::class, [
            'getParser' => $parser,
        ]);
    }
}
