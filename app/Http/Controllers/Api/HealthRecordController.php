<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HealthRecord;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = $request->user()->id;

        $request->validate([
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'blood_type' => 'nullable|string|max:5',
            'birth_date' => 'nullable|date',
            'age' => 'nullable|integer',
            'allergies' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'current_conditions' => 'nullable|string',
            'medical_document' => 'nullable|string', // jika upload file, sesuaikan
        ]);

        // Cek jika sudah ada, update saja
        $healthRecord = HealthRecord::where('user_id', $userId)->first();
        if ($healthRecord) {
            $healthRecord->update($request->all());
        } else {
            $healthRecord = HealthRecord::create(array_merge(
                $request->all(),
                ['user_id' => $userId]
            ));
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $healthRecord
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    // Tampilkan data rekam medis user yang login
    public function show(Request $request)
    {
        $userId = $request->user()->id;
        $healthRecord = HealthRecord::where('user_id', $userId)->first();

        if (!$healthRecord) {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Data rekam medis tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $healthRecord
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = $request->user()->id;
        $healthRecord = HealthRecord::where('id', $id)->where('user_id', $userId)->first();

        if (!$healthRecord) {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Data rekam medis tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'blood_type' => 'nullable|string|max:5',
            'birth_date' => 'nullable|date',
            'age' => 'nullable|integer',
            'allergies' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'current_conditions' => 'nullable|string',
            'medical_document' => 'nullable|string', // jika upload file, sesuaikan
        ]);

        $healthRecord->update($request->all());

        return response()->json([
            'status' => 'Sukses',
            'data' => $healthRecord
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function me(Request $request)
    {
        $userId = $request->user()->id;
        $healthRecord = HealthRecord::where('user_id', $userId)->first();

        if (!$healthRecord) {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Data rekam medis tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $healthRecord
        ], 200);
    }

    public function updateMe(Request $request)
    {
        $user = $request->user();
        $healthRecord = HealthRecord::where('user_id', $user->id)->first();

        if (!$healthRecord) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data medis tidak ditemukan'
            ], 404);
        }

        $healthRecord->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data medis berhasil diupdate',
            'data' => $healthRecord
        ]);
    }
}
