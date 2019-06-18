<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hospital;


class HospitalController extends Controller
{
    public function index() {
        $hospitals = Hospital::all();
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
}