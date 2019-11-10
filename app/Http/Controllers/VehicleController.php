<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function readAll(Request $request)
    {
        $vehicles = Vehicle::filter($request->all());

        return response()->json($vehicles);
    }

    public function read($id){
        $vehicle = Vehicle::find($id);

        if($vehicle === null)
            return response('',404);

        return response()->json($vehicle);
    }
}
