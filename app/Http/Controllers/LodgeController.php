<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lodge;
use App\Models\LodgeAddress;
use App\Models\LodgeFeed;
use App\Models\LodgeList;

use App\Models\Company; 
use App\Models\Package;

class LodgeController extends Controller
{
    // Lodge

    public function get($id) {
        $lodge = Lodge::where('id', $id)->first();

        if ($lodge) {
            return response()->json([
                'message' => 'Success!',
                'id' => $lodge->id,
                'name' => $lodge->name,
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Lodge Not Found!',
            ], 404);
        }
    }

    public function get_all($id) {
        $lodges = Lodge::where('company_id', $id)->all();

        if ($lodges) {
            foreach ($lodges as $lodge) {
                return response()->json([
                    'message' => 'Success!',
                    'id' => $lodge->id,
                    'name' => $lodge->name,
                ], 200);
            }
        }

        else {
            return response()->json([
                'message' => 'Lodges Not Found!',
            ], 404);
        }
    }

    public function create(Request $request, $id) {
        $r1 = Lodge::where('name', request('name'))->count();
        $r2 = Lodge::where('desc', request('desc'))->count();

        $limit = Lodge::where('company_id', $id)->count();

        if ($r1 == 1 || $r2 == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            if ($limit == 1) {
                return response()->json([
                    'message' => 'Unavailable!',
                ], 400);
            }

            else {
                $data = [
                    'company_id' => $id,
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'clients_amount' => $request->clients_amount,
                    'kids' => $request->kids,
                    'pets' => $request->pets,
                    'breakfast' => $request->breakfast,
                    'gym' => $request->gym,
                    'pool' => $request->pool,
                    'rooms_amount' => $request->rooms_amount,
                    'price' => $request->price,
                    'status' => 1,
                ];

                Lodge::create($data);

                return response()->json([
                    'message' => 'Success!',
                ], 201);
            }
        }
    }

    public function update(Request $request, $id) {
        $r1 = Lodge::where('name', request('name'))->count();
        $r2 = Lodge::where('desc', request('desc'))->count();

        if ($r1 == 1 || $r2 == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            $data = [
                'name' => $request->name,
                'desc' => $request->desc,
                'clients_amount' => $request->clients_amount,
                'kids' => $request->kids,
                'pets' => $request->pets,
                'breakfast' => $request->breakfast,
                'gym' => $request->gym,
                'pool' => $request->pool,
                'rooms_amount' => $request->rooms_amount,
                'price' => $request->price,
            ];

            Lodge::update($data);
            
            return response()->json([
                'message' => 'Success!',
            ], 201);
        }
    }

    public function delete(Request $request, $id) {
        $data = [
            'status' => 0,
        ];

        Lodge::where('id', $id)->update($data);

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }

    // LodgeAddress

    public function get_address($id) {
        $address = LodgeAddress::where('lodge_id', $id)->first();

        if ($address) {
            return response()->json([
                'message' => 'Success!',
                'street' => $address->street,
                'number' => $address->number,
                'city' => $address->city,
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Address Not Found!',
            ], 404);
        }
    }

    public function create_address(Request $request, $id) {
        $data = [
            'lodge_id' => $id,
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
        ];

        LodgeAddress::create($data);

        return response()->json([
            'message' => 'Success!',
        ], 201);
    }

    public function update_address(Request $request, $id) {
        $data = [
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
        ];

        LodgeAddress::where('client_id', $id)->update($data);

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }

    // LodgeFeed

    public function get_all_feed($id) {
        $images = LodgeFeed::where('lodge_id', $id)->all();

        if ($images) {
            foreach ($images as $image) {
                return response()->json([
                    'message' => 'Success!',
                    'id' => $image->id,
                    'file' => $image->file,
                ], 200);
            }
        }

        else {
            return response()->json([
                'message' => 'Images Not Found!',
            ], 404);
        }
    }

    public function create_feed(Request $request, $id) {
        $limit = LodgeFeed::where('lodge_id', $id)->count();

       if ($limit == 3) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            $data = [
                'lodge_id' => $id,
                'file' => $request->file,
            ];

            LodgeFeed::create($data);

            return response()->json([
                'message' => 'Success!',
            ], 201);
        }
    }

    public function update_feed(Request $request, $id) {
        $data = [
            'file' => $request->file,
        ];

        LodgeFeed::update($data);
        
        return response()->json([
            'message' => 'Success!',
        ], 201);
    }

    public function delete_feed(Request $request, $id) {
        LodgeFeed::where('id', $id)->delete();

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }

    // LodgeList

    public function get_all_list($id) {
        $list = LodgeList::where('package_id', $id)->all();

        if ($list) {
            foreach ($list as $lodge) {
                return response()->json([
                    'message' => 'Success!',
                    'id' => $lodge->id,
                    'lodge_id' => $lodge->lodge_id,
                    'package_id' => $lodge->package_id,
                    'start_date' => $lodge->start_date,
                    'final_date' => $lodge->final_date,
                    'price' => $lodge->price,
                ], 200);
            }
        }

        else {
            return response()->json([
                'message' => 'LodgeList Not Found!',
            ], 404);
        }
    }

    public function create_list(Request $request, $id, $id_l) {
        $lodge = Lodge::where('id', $id_l)->first();
        $limit = LodgeList::where('package_id', $id)->count();

       if ($limit == 3) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            if ($lodge->rooms_amount == 0) {
                return response()->json([
                    'message' => 'No Rooms!',
                ], 400);
            }

            else {
                $data = [
                    'lodge_id' => $id_l,
                    'package_id' => $id,
                    'start_date' => $request->start_date,
                    'final_date' => $request->final_date,
                    'price' => $request->price,
                ];
    
                LodgeList::create($data);
    
                return response()->json([
                    'message' => 'Success!',
                ], 201);
            }
        }
    }

    public function delete_list(Request $request, $id) {
        LodgeList::where('lodge_id', $id)->delete();

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }
}