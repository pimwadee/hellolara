<?php

namespace Tests\Unit;
namespace App;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\FizzBuzz;

class FizzBuzzTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testShouldProcess2(){
        $fizzBuzz = new FizzBuzz;

        $this->assertEquals("2", $fizzBuzz->processNumber(2));
    }
    
     public function testExample()
    {
        $this->assertTrue(true);
    }
}
