<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Company;

class CompanyController extends Controller
{
    // Company

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
        $r2 = Company::where('cnpj', request('cnpj'))->count();

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
                    'status' => 0,
                ];
    
                User::create($data);

                $company_data = [
                    'id' => User::where('email', request('email'))->first()->id,
                    'cnpj' => Hash::make($request->cnpj),
                    'inn' => 0,
                    'attraction' => 0,
                    'restaurant' => 0,
                    'guide' => 0,
                    'car_rental' => 0,
                ];            

                Company::create($company_data);

                return response()->json([
                    'message' => 'Success!',
                ], 201);
            }
        }
    }

    public function update(Request $request, $id) {
        $r1 = User::where('email', request('email'))->count();
        $r2 = Company::where('cnpj', request('cnpj'))->count();
        
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
                    'message' => 'CNPJ Unavailable!',
                ], 200);
            }

            else {
                if ($r1 == 1 && $r2 != 1) {
                    $data = [
                        'name' => $request->name,
                    ];
        
                    User::where('id', $id)->update($data);
        
                    $company_data = [
                        'cnpj' => Hash::make($request->cnpj),
                    ];            
        
                    Company::where('id', $id)->update($company_data);
        
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
        
                    $company_data = [
                        'cnpj' => Hash::make($request->cnpj),
                    ];            
        
                    Company::where('id', $id)->update($company_data);
        
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
}