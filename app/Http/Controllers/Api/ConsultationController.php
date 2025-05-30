<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // List semua konsultasi user yang login
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $consultations = Consultation::with(['user', 'doctor', 'prescriptions'])
            ->where('user_id', $userId)
            ->orderBy('consultation_date', 'desc')
            ->get();

        return response()->json([
            'status' => 'Sukses',
            'data' => $consultations
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
    // Detail konsultasi
    public function show($id, Request $request)
    {
        $userId = $request->user()->id;
        $consultation = Consultation::with(['user', 'doctor', 'prescriptions'])
            ->where('user_id', $userId)
            ->find($id);

        if (!$consultation) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Konsultasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $consultation
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
