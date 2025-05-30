<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // List semua resep milik user yang login
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $prescriptions = Prescription::with(['consultation', 'items'])
            ->whereHas('consultation', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'Sukses',
            'data' => $prescriptions
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // Detail resep
    public function show($id, Request $request)
    {
        $userId = $request->user()->id;
        $prescription = Prescription::with(['consultation', 'items'])
            ->where('id', $id)
            ->whereHas('consultation', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->first();

        if (!$prescription) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Resep tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $prescription
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
