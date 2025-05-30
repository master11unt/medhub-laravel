<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrescriptionItem;
use Illuminate\Http\Request;

class PrescriptionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = PrescriptionItem::with('prescription')->get();
        return response()->json([
            'status' => 'Sukses',
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prescription_id' => 'required|exists:prescriptions,id',
            'medicine_name'   => 'required|string|max:255',
            'quantity'        => 'required|sting|min:1',
            'instructions'    => 'nullable|string',
        ]);

        $item = PrescriptionItem::create($request->all());

        return response()->json([
            'status' => 'Sukses',
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = PrescriptionItem::with('prescription')->find($id);
        if (!$item) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Item resep tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'status' => 'Sukses',
            'data' => $item
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = PrescriptionItem::find($id);
        if (!$item) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Item resep tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'medicine_name'   => 'sometimes|required|string|max:255',
            'quantity'        => 'sometimes|required|string|min:1',
            'instructions'    => 'nullable|string',
        ]);

        $item->update($request->all());

        return response()->json([
            'status' => 'Sukses',
            'data' => $item
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = PrescriptionItem::find($id);
        if (!$item) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Item resep tidak ditemukan'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'status' => 'Sukses',
            'pesan' => 'Item resep berhasil dihapus'
        ], 200);
    }
}
