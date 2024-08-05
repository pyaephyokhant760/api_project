<?php

namespace App\Http\Controllers\Api;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Business::all();
        return ['data' => $data];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'opening_hours' => 'required',
            'status' => 'required',
        ]);
         $create = Business::create($data);
        return response()->json(['status' => true,'message'=> $create],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $searchId = Business::where('id',$id)->first();
        if(isset($searchId)) {
            $data = Business::where('id',$id)->first();
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
            'user_id' => 'required',
            'name' => 'required',
            'opening_hours' => 'required',
            'status' => 'required',
         ]);

         $searchId = Business::where('id',$id)->first();
         if(isset($searchId)) {
             $update = Business::where('id',$id)->update($data);
             return response()->json(['message' => 'Update Success'], 200);
         }
         return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $searchId = Business::where('id',$id)->first();
        if(isset($searchId)) {
            $data = Business::where('id',$id)->delete();
            return response()->json(['message' => True,], 200);
        }
        return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }
}
