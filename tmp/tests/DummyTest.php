<?php

namespace Ht7\Base\Tests\Unit;

use \Ht7\Base\Dummy;
use \PHPUnit\Framework\TestCase;

class DummyTest extends TestCase
{

    public function testGetDummy()
    {
        $dummy = new Dummy();

        $this->assertTrue($dummy->getDummy());
    }

}
