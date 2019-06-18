<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hospital;

class HospitalApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    use WithFaker;

    // protected function setUp(): void
    // {
    //     parent::setUp();

    //     factory(Hospital::class, 10)->create();

    // }

    public function testGetAllHospitals()
    {
        // Arrange - create 10 hospitals
        factory(Hospital::class, 10)->create();

        // Act - make a json call to /api/hospitals
        
        $response = $this->get('/api/hospitals');

        // Assert - check that status 200
        //        - check that there are 10 objects in the array
        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

    public function testGetHospital() {

        // Arrange - create a hospital, get the id
        $expected = factory(Hospital::class)->create();

        // Act - make a json call to api/hospitals/{id}       
        $response = $this->get('/api/hospitals/'.$expected->id);

        // Assert - check that status 200
        //        - check that the data matches (name, address, etc)
        $response->assertStatus(200);
        $response->assertJson(["name"=>$expected->name, "address"=>$expected->address, "numberOfBeds"=>$expected->numberOfBeds, "numberOfDoctors"=>$expected->numberOfDoctors]);
        
    }

    public function testWhenHospitalNotFound() {
        // Arrange - create 10 hospitals - generate random id > 10
        factory(Hospital::class, 10)->create();
        $randomid = rand(11,getrandmax());

        // Act - make a json call to /api/hospitals/{id}
        $response = $this->get('/api/hospitals/'.$randomid);

        // Assert - check that status 404
        $response->assertStatus(404);
    }
}
