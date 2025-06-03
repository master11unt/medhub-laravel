<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'schedule_id' => 'nullable|exists:schedules,id',
            'consultation_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Cek jika schedule sudah dipakai
        if ($request->schedule_id) {
            $existingConsultation = Consultation::where('schedule_id', $request->schedule_id)
                                              ->whereIn('status', ['pending', 'in_progress'])
                                              ->exists();
            
            if ($existingConsultation) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal sudah terpakai'
                ], 422);
            }
        }

        $consultation = Consultation::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'schedule_id' => $request->schedule_id,
            'consultation_date' => $request->consultation_date,
            'status' => 'pending'
        ]);

        $consultation->load(['doctor.user', 'schedule']);

        return response()->json([
            'status' => 'success',
            'message' => 'Konsultasi berhasil dibuat',
            'data' => $consultation
        ], 201);
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
