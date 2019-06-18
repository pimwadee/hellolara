<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hospital;

class HospitalDatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        factory(Hospital::class, 10)->create();

        // for($i = 0; $i < 10; $i++) {
        //     $name = $this->faker()->words(4,true);
        //     $address = $this->faker()->streetAddress;
        //     $numberOfBeds = $this->faker()->numberBetween(1,1000);
        //     $numberOfDoctors = $this->faker()->numberBetween(1,1000);;
        //     $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);
        //     $hospital->save();
        // }
    }

    public function testSaveModel()
    {
        // Arrange
        $name = 'TU Hospital';
        $address = 'TU';
        $numberOfBeds = 100;
        $numberOfDoctors = 20;
        $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);

        // Act
        $hospital->save();

        // Assert
        $this->assertDatabaseHas('hospitals',[
            'name' => $name,
            'address' => $address,
            'numberOfBeds' => $numberOfBeds,
            'numberOfDoctors' => $numberOfDoctors
        ]);

    }

    public function testUpdateModel() {
        // Arrange
        $name = 'Chulalongkorn King Memorial Hospital';
        $address = 'CKMH';
        $numberOfBeds = 100;
        $numberOfDoctors = 20;
        $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);
        $hospital->save();

        // Act
        $hospital->name = 'CU Hospital';
        $hospital->save();

        // Assert
        $this->assertDatabaseHas('hospitals', ['name' => 'CU Hospital']);
        $this->assertDatabaseMissing('hospitals', ['name' => $name]);
    }

    public function testGetModel() {
        // Arrange
        $expected = factory(Hospital::class)->create();
        factory(Hospital::class, 5)->create();

        // Act
        $actual = Hospital::find($expected->id);

        // Assert
        $this->assertEquals($expected->id, $actual->id);
        $this->assertEquals($expected->name, $actual->name);
    }

    public function testSaveIncrementsRowCount() {
        // Arrange
        $previousRows = Hospital::count();
        $hospital = factory(Hospital::class)->make();

        // Act
        $hospital->save();

        // Assert
        $currentRows = Hospital::count();
        $this->assertEquals($previousRows + 1, $currentRows);
    }

}
