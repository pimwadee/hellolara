<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class ChildSourceController extends Controller
{
    public function schools()
    {
        return view('schools');
    }

    public function parents()
    {
        return view('parents');
    }

    public function hospitals()
    {
        return view('hospitals');
    }
}