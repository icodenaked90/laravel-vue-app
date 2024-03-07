<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserVehicle;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function getVehicles(Request $request)
    {
        $vehicles = Vehicle::all();

        return response()->json(['data' => $vehicles], 200);
    }

    public function getUserVehicles(Request $request)
    {
        $user = Auth::user();

        $vehicles = UserVehicle::where('owner', $user->id)->get();

        return response()->json(['data' => $vehicles], 200);
    }

    public function buyVehicle(Request $request)
    {
        $request->validate([
            'vehname' => 'required|string',
            'vehiclecost' => 'required|numeric',
        ]);

        $user = Auth::user();

        $vehicle = new UserVehicle();
        $vehicle->owner = $user->id;
        $vehicle->vehname = $request->input('vehname');
        $vehicle->vehiclecost = $request->input('vehiclecost');
        $vehicle->save();

        return response()->json(['message' => 'Vehicle purchased successfully', 'data' => $vehicle], 201);
    }
}
