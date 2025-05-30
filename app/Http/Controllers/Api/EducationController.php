<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $educations = Education::with('category') // relasi ke kategori edukasi, sesuaikan dengan model
            ->when($request->type, function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'Sukses',
            'data' => $educations
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
    // public function show(string $id)
    // {
    //     $education = Education::with('category')->find($id);

    //     if (!$education) {
    //         return response()->json([
    //             'status' => 'Gagal',
    //             'pesan' => 'Edukasi tidak ditemukan'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'status' => 'Sukses',
    //         'data' => $education
    //     ], 200);
    // }

    public function show($title)
    {
        $education = Education::with('category')->where('title', $title)->first();

        if (!$education) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Edukasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $education
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
