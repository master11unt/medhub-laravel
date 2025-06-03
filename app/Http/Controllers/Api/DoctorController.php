<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::with('user', 'schedules')
            ->when($request->specialization, function ($query) use ($request) {
                $query->where('specialization', 'like', "%{$request->specialization}%");
            })
            ->get()
            ->map(function ($doctor) {
                $data = $doctor->toArray();
                $data['average_rating'] = round($doctor->average_rating, 2);
                $data['is_in_consultation'] = $doctor->is_in_consultation;

                // Tambahkan URL lengkap untuk gambar user
                if (isset($data['user']['image']) && !empty($data['user']['image'])) {
                    // Jika gambar sudah berupa URL lengkap, biarkan apa adanya
                    if (!str_starts_with($data['user']['image'], 'http')) {
                        // Jika hanya path relatif, tambahkan base URL
                        $data['user']['image'] = url('storage/' . $data['user']['image']);
                    }
                }
                return $data;
            });

        return response()->json([
            'status' => 'Sukses',
            'data' => $doctors
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
    public function show($id)
    {
        $doctor = Doctor::with('user', 'schedules')->find($id);

        if (!$doctor) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Dokter tidak ditemukan'
            ], 404);
        }

        $data = $doctor->toArray();
        $data['average_rating'] = round($doctor->average_rating, 2);
        $data['is_in_consultation'] = $doctor->is_in_consultation;

        // Tambahkan URL lengkap untuk gambar user
        if (isset($data['user']['image']) && !empty($data['user']['image'])) {
            if (!str_starts_with($data['user']['image'], 'http')) {
                $data['user']['image'] = url('storage/' . $data['user']['image']);
            }
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $data
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
