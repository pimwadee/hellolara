<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Hospital;

class HospitalController extends Controller
{
    public function index() {
        $hospitals = Hospital::all();

        //$hospitals = DB::select('select * from hospitals');
        return response()->json($hospitals);
        
    }

    public function show($id) {
        //$id = $request->input('id');
        //$hospitals = DB::select('select * from hospitals where id = :id', ['id' => $id]);
        $hospitals = Hospital::where('id',$id)
                    ->get();
        if(sizeof($hospitals) == 0) {
            return response('Not found',404);
        }
        return response()->json(($hospitals[0]));
        
    }

    public function store(Request $request) {

        $hospital = new Hospital;

        $hospital->name = $request -> input('name');
        $hospital->address = $request -> input('address');
        $hospital->numberOfBeds = $request -> input('numberOfBeds');
        $hospital->numberOfDoctors = $request -> input('numberOfDoctors');

        //$hospital = DB::insert('insert into hospitals (name, address, numberOfBeds, numberOfDoctors) values (?, ?, ?, ?)', [$name, $address, $numberOfBeds, $numberOfDoctors]);
        $hospital->save();

        $headers = ['Location' => '/hospitals/',$hospital];
        return response()->json([], 201, $headers);
    }

    public function destroy($id) {
        Hospital::destroy($id);
    }

}
