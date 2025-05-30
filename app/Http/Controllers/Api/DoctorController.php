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
        $doctors = Doctor::with('user') // relasi ke tabel users, sesuaikan dengan model
            ->when($request->specialization, function ($query) use ($request) {
                $query->where('specialization', 'like', "%{$request->specialization}%");
            })
            ->orderBy('is_online', 'desc')
            ->get();

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
    public function show(string $id)
    {
        $doctor = Doctor::with('user')->find($id);

        if (!$doctor) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Dokter tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $doctor
        ], 200);
    }

    // public function show($name)
    // {
    //     $doctor = Doctor::with('user')->where('name', $name)->first();

    //     if (!$doctor) {
    //         return response()->json([
    //             'status' => 'Gagal',
    //             'pesan' => 'Dokter tidak ditemukan'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'status' => 'Sukses',
    //         'data' => $doctor
    //     ], 200);
    // }

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
