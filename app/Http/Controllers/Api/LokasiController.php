<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return response()->json([
            'status' => 'Sukses',
            'data' => $locations
        ], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string',
        ]);

        $location = Location::create($request->only(['name', 'address']));

        return response()->json([
            'status' => 'Sukses',
            'data' => $location
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Lokasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $location
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string',
        ]);

        $location = Location::findOrFail($id);
        $location->update($request->only(['name', 'address']));

        return response()->json([
            'status' => 'Sukses',
            'data' => $location
        ], 200);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json([
            'status' => 'Sukses',
            'message' => 'Lokasi berhasil dihapus'
        ], 200);
    }

}
