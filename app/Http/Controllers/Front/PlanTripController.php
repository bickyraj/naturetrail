<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanTripController extends Controller
{
    public function index()
    {
        return view('front.trips.plan');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
