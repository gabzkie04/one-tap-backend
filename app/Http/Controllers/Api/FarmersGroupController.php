<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FarmersGroup;
use Exception;
use Illuminate\Http\Request;

class FarmersGroupController extends Controller
{
    //
    public function createFarm(Request $request){
        // validate
        try{
            $request->validate([
                "farm_name" => "required|unique:farm",
                "farm_description" => "required",
                "no_of_farmers" => "required",
            ]);

            // create user data + save
            $farm = new FarmersGroup();
            $farm->farm_name = $request->farm_name;
            $farm->farm_description = $request->farm_description;
            $farm->no_of_farmers = $request->no_of_farmers;
            $farm->save();

            // send response
            return response()->json([
                "status" => 1,
                "message" => "Farm Group registered successfully",
                "farm" => $farm->id
            ], 200);

        }catch(Exception $e){
            return response()->json([
                "status" => 0,
                "message" => "There was an erro occured, please contact the developers about this",
                "errors"=> $e->getMessage()
            ], 200);
        }
    }

    public function getFarms()
    {
        $farms = FarmersGroup::get();

        return response()->json([
            "status" => 1,
            "message" => "Listing Farms",
            "data" => $farms
        ], 200);
    }

    public function getFarm($id)
    {
        if (FarmersGroup::where("id", $id)->exists()) {
            $farm_detail = FarmersGroup::where("id", $id)->first();
            return response()->json([
                "status" => 1,
                "message" => "Farm Found",
                "data" => $farm_detail
            ], 200);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Farm not found"
            ], 404);
        }
    }

    public function updateFarm(Request $request, $id)
    {
        if (FarmersGroup::where("id", $id)->exists()) {
            $farm = FarmersGroup::find($id);
            $farm->farm_name = !empty($request->farm_name) ? $request->farm_name : $farm->farm_name;
            $farm->farm_description = !empty( $request->farm_description) ?  $request->farm_description : $farm->farm_name;
            $farm->no_of_farmers = !empty($request->no_of_farmers) ? $request->no_of_farmers : $farm->no_of_farmers;

            $farm->save();

            return response()->json([
                "status" => 1,
                "message" => "Farm updated successfully"
            ], 200);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Farm not found"
            ], 404);
        }
    }
}
