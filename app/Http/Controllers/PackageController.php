<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Client;
use App\Models\Package;
use App\Models\Payments;
use App\Models\PayMethodType;

class PackageController extends Controller
{
    // Package

    public function get($id) {
        $package = Package::where('client_id', $id)->where('status', 1)->first();

        if ($package) {
            return response()->json([
                'message' => 'Success!',
                'id' => $package->id,
                'client_id' => $package->client_id,
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Package Not Found!',
            ], 404);
        }
    }

    public function create(Request $request, $id) {
        $package = Package::where('client_id', $id)->where('status', 1)->count();
        
        if ($package == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            $data = [
                'client_id' => $id,
                'start_datetime' => $request->start_datetime,
                'final_datetime' =>  $request->final_datetime,
                'price' =>  0,
                'status' => 1,
            ];
    
            Package::create($data);
    
            return response()->json([
                'message' => 'Success!',
            ], 201);   
        }
    }

    public function update(Request $request, $id) {
        $package = Payments::where('package_id', $id)->count();

        if ($package == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            $data = [
                'start_datetime' => $request->start_datetime,
                'final_datetime' => $request->final_datetime,
            ];
    
            Package::where('id', $id)->update($data);
    
            return response()->json([
                'message' => 'Success!',
            ], 200);
        }
    }

    public function delete(Request $request, $id) {
        $package = Payments::where('package_id', $id)->count();
        
        if ($package == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }
        
        else {
            Package::where('id', $id)->delete();

            return response()->json([
                'message' => 'Success!',
            ], 200);
        }
    }
}
