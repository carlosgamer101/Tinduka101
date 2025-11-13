<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }
}