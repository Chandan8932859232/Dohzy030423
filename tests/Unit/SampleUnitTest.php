<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SampleUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function addOnePlusOne():bool {
        if((1+1)===2){
            return true;
        }
        return false;
    }
    public function testExample()
    {

        $this->assertTrue($this->addOnePlusOne());
    }
}
