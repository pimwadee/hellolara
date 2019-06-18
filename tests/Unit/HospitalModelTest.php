<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hospital;
use App\Exceptions\ValidationException;

class HospitalModelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreateModel() {
        // Arrange
        $name = 'My Hospital';
        $address = 'My Address';
        $numberOfBeds = 500;
        $numberOfDoctors = 50;

        // Act
        $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);
        
        // Assert
        $this->assertEquals($name, $hospital->name, 'Incorrect Hospital Name');
        $this->assertEquals($address, $hospital->address, 'Incorrect Hospital Address');
        $this->assertEquals($numberOfBeds, $hospital->numberOfBeds, 'Incorrect No. of Beds');
        $this->assertEquals($numberOfDoctors, $hospital->numberOfDoctors, 'Incorrect No. of Doctors');
        
    }

    public function testNonNumericBedsAndDoctors() {
        // Act
        $hospital = Hospital::create('Vibhavadi', 'Vibhavadi Rangsit', null, 'unknown');

        // Assert
        $this->assertEquals(0, $hospital->numberOfBeds, 'Null numberOfBeds should be 0');
        $this->assertEquals(0, $hospital->numberOfDoctors, 'String numberOfDoctors should be 0');
    }

    public function testInvalidNumericBedsAndDoctors() {
        // Act
        $hospital = Hospital::create('BCare', 'Phahol Yothin', -50, 4.4);

        // Assert
        $this->assertEquals(0, $hospital->numberOfBeds, 'Negative numberOfBeds should be 0');
        $this->assertEquals(4, $hospital->numberOfDoctors, 'Float numberofDoctors cast to int');
    }

    public function testEmptyNameThrows() {
        // Arrange
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid Name');
        $this->expectExceptionMessageRegExp('/Name/');

        // Act
        $hospital = Hospital::create('', 'Don Muang', 100, 10);
    }
}
