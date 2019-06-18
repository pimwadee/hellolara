<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    protected function index() {
        return response()->json(['message' => 'hello']);
    }

    protected function color(Request $request) {
        if ($request->has('day')) {
            $dayIndex = intval($request->input('day'));
        } else {
            $dayIndex = date('w');
        }
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $colors = ['red', 'yellow', 'pink', 'green', 'orange', 'blue', 'purple'];
        $result = [
            'day' => ['index' => $dayIndex, 'name' => $days[$dayIndex]], 
            'recommendedColor' => $colors[$dayIndex]];
        return response()->json($result);
    }

    protected function ibw(Request $request) {
        
        if ($request->input('gender') == 'male') {
            $weight = intval(48 + 1.1 * ($request->input('height') - 150));
        } else {
            $weight = intval(45 + 0.9 * ($request->input('height') - 150));
        } 

        $result = [
            'gender' => $request->input('gender'), 
            'height' => $request->input('height'),
            'recommendedWeight' => $weight];
        return response()->xml($result);
    }

}
