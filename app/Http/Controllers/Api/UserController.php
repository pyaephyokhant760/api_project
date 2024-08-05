<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return ['data' => $data];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $searchId = User::where('id',$id)->first();
        if(isset($searchId)) {
            $data = User::where('id',$id)->first();
            return response()->json($data, 200);
        }
        return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8',
         ]);

         $searchId = User::where('id',$id)->first();
         if(isset($searchId)) {
             $update = User::where('id',$id)->update($data);
             return response()->json(['message' => 'Update Success'], 200);
         }
         return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $searchId = User::where('id',$id)->first();
        if(isset($searchId)) {
            $data = User::where('id',$id)->delete();
            return response()->json(['message' => True,], 200);
        }
        return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }
}
