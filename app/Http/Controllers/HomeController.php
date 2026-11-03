<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $places = Place::orderBy('view_count', 'desc')->take(3)->get();
        $allPlaces = Place::all();
        return view('welcome', compact('places','allPlaces'));
    }
}
