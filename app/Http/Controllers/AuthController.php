<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),200);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
         ]);

        return response()->json(['message' => 'Create Success','user' => $user], 200);
    }


    // Login
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email|exists:users,email',
            'password'=>'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),200);
        }

        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check( $request->password,$user->password)){
            return response()->json([
                'message'=>"The provided credentials are incorrect"
            ]);
        }
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(['token' => $token]);
    }
}
