<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::all();
        return ['data' => $data];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'business_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
         ]);
         $create = Service::create($data);
        return response()->json(['status' => true,'message'=> $create],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $searchId = Service::where('id',$id)->first();
        if(isset($searchId)) {
            $data = Service::where('id',$id)->first();
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
            'business_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
         ]);

         $searchId = Service::where('id',$id)->first();
         if(isset($searchId)) {
             $update = Service::where('id',$id)->update($data);
             return response()->json(['message' => 'Update Success'], 200);
         }
         return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $searchId = Service::where('id',$id)->first();
        if(isset($searchId)) {
            $data = Service::where('id',$id)->delete();
            return response()->json(['message' => True,], 200);
        }
        return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }
}
