<?php

use Illuminate\Database\Seeder;
use App\Hospital;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hospital = new Hospital();
        
        $hospital->name = 'Chula';
        $hospital->address = Str::random(20);
        $hospital->numberOfBeds = 100;
        $hospital->numberOfDoctors = 10;

        $hospital->save();
    }
}
