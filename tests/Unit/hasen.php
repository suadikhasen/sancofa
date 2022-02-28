<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Sancofa\Service\AddressDetector;
class hasen extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {   
    	$hasen = new AddressDetector;
        $this->assertFalse($hasen->trace('ch'));
    }
}
