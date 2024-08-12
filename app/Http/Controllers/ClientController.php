<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Client;
use App\Models\ClientAddress;

class ClientController extends Controller
{
    // Client

    public function get($id) {
        $user = User::where('id', $id)->first();

        if ($user) {
            return response()->json([
                'message' => 'Success!',
                'id' => $user->id,
                'name' => $user->name,
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'User Not Found!',
            ], 404);
        }
    }

    public function create(Request $request) {
        $r1 = User::where('email', request('email'))->count();
        $r2 = Client::where('cpf', request('cpf'))->count();

        if ($r1 == 1 || $r2 == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            if (request('password') != request('cpassword')) {
                return response()->json([
                    'message' => 'Pass Dont Match!',
                ], 400);
            }

            else {
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'status' => 1,
                ];
    
                User::create($data);

                $client_data = [
                    'id' => User::where('email', request('email'))->first()->id,
                    'cpf' => Hash::make($request->cpf),
                ];            

                Client::create($client_data);

                return response()->json([
                    'message' => 'Success!',
                ], 201);
            }
        }
    }

    public function update(Request $request, $id) {
        $r1 = User::where('email', request('email'))->count();
        $r2 = Client::where('cpf', request('cpf'))->count();
        
        if ($r1 == 1 && $r2 == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            if ($r1 != 1 && $r2 == 1) {
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                ];
    
                User::where('id', $id)->update($data);
    
                return response()->json([
                    'message' => 'CPF Unavailable!',
                ], 200);
            }

            else {
                if ($r1 == 1 && $r2 != 1) {
                    $data = [
                        'name' => $request->name,
                    ];
        
                    User::where('id', $id)->update($data);
        
                    $client_data = [
                        'cpf' => Hash::make($request->cpf),
                    ];            
        
                    Client::where('id', $id)->update($client_data);
        
                    return response()->json([
                        'message' => 'Email Unavailable!',
                    ], 200);   
                }

                else {
                    $data = [
                        'name' => $request->name,
                        'email' => $request->email,
                    ];
        
                    User::where('id', $id)->update($data);
        
                    $client_data = [
                        'cpf' => Hash::make($request->cpf),
                    ];            
        
                    Client::where('id', $id)->update($client_data);
        
                    return response()->json([
                        'message' => 'Success!',
                    ], 200);   
                }
            }
        }
    }

    public function update_pass(Request $request, $id) {
        if (request('password') != request('cpassword')) {
            return response()->json([
                'message' => 'Pass Dont Match!',
            ], 400);
        }

        else {
            $data = [
                'password' => Hash::make($request->password),
            ];

            User::where('id', $id)->update($data);

            return response()->json([
                'message' => 'Success!',
            ], 200);
        }
    }

    public function delete(Request $request, $id) {
        $data = [
            'status' => 0,
        ];

        User::where('id', $id)->update($data);

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }

    // ClientAddress

    public function get_address($id) {
        $address = ClientAddress::where('client_id', $id)->first();

        if ($address) {
            return response()->json([
                'message' => 'Success!',
                'street' => $address->street,
                'number' => $address->number,
                'city' => $address->city,
                'state' => $address->state,
                'country' => $address->country,
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
            'client_id' => $id,
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ];

        ClientAddress::create($data);

        return response()->json([
            'message' => 'Success!',
        ], 201);
    }

    public function update_address(Request $request, $id) {
        $data = [
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ];

        ClientAddress::where('client_id', $id)->update($data);

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }
}