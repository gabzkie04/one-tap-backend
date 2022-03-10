<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmerController extends Controller
{
    //
    public function getFarmers(){
        $farmers = Farmer::select('name', 'email', 'contact', 'gender', 'birthdate', 'role', 'farm_name')
        ->join('users', 'farmer.user_id', 'users.id')
        ->join('farm', 'farm.id', 'farmer.farm_id')
        ->get();

        return response()->json([
            "status" => 1,
            "message" => "Listing Farmers",
            "data" => $farmers
        ], 200);
    }

    public function getTotalFarmers(){
        $farmers = Farmer::select(DB::raw('count(farmer.id) as total_farmers'))
        ->join('users', 'farmer.user_id', 'users.id')->first();

        return response()->json([
            "status" => 1,
            "message" => "Total Farmers",
            "total_farmers" => $farmers->total_farmers
        ], 200);
    }

    public function getFarmersByFarm($farm_id)
    {
        $farmers = Farmer::select('name', 'email', 'contact', 'gender', 'birthdate', 'role')
        ->join('users', 'farmer.user_id', 'users.id')
        ->where('farmer.farm_id', $farm_id)
        ->get();

        return response()->json([
            "status" => 1,
            "message" => "Listing Farmers",
            "data" => $farmers
        ], 200);
    }

    public function getFarmer(){

    }
}
