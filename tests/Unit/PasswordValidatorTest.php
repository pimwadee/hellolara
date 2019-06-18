<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\PasswordValidator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordValidatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $validator;

    protected function setUp(): void {
        parent::setUp();
        $this->validator = new PasswordValidator;
    }
    
     public function testValidPassword()
    {
        // Arrange
        // $validator =  new PasswordValidator;

        // Act
        $result = $this->validator->check('TheBigC0d');

        // Assert
        $this->assertTrue($result);
    }

    public function testInvalidLessThan8Chars(){
        // Arrange
        // $validator =  new PasswordValidator;

        // Act
        $result = $this->validator->check('The8igC');

        // Assert
        $this->assertFalse($result);
    }

    public function testInvalidLessThan1Digit(){
        // Arrange
        // $validator =  new PasswordValidator;

        // Act
        $result1 = $this->validator->check('TheBigC');
        $result2 = $this->validator->check('TheBigCod');

        // Assert
        $this->assertFalse($result1);
        $this->assertFalse($result2);
    }

    public function testInvalid1thru8() {
        // Act
        $result = $this->validator->check('12345678');

        // Assert
        $this->assertFalse($result);
    }

    public function test1Upper1Lower() {
        // Act
        $result1 = $this->validator->check('11111111');
        $result2 = $this->validator->check('1AAAAAAA');
        $result3 = $this->validator->check('1aaaaaaa');
        $result4 = $this->validator->check('1Aaaaaaa');

        // Assert
        $this->assertFalse($result1);
        $this->assertFalse($result2);
        $this->assertFalse($result3);
        $this->assertTrue($result4); 
    }

    public function testAdmin10chars() {
        // Act
        $result1 = $this->validator->check('1234AaAa', true);
        $result2 = $this->validator->check('1234AaAam,', true);

        // Assert
        $this->assertFalse($result1);
        $this->assertTrue($result2);
    }
}
