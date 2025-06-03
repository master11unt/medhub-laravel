<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Illuminate\Http\Request;

class RegistrantApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Registrant::all()
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'address' => 'required',
            'phone_number' => 'required|max:20',
            'identity_number' => 'nullable|max:30',
            'special_notes' => 'nullable',
            'has_medical_history' => 'required|in:Ya,Tidak',
            'agreement' => 'accepted',
        ]);

        $registrant = Registrant::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftar berhasil ditambahkan.',
            'data' => $registrant
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registrant = Registrant::find($id);

        if (!$registrant) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $registrant
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $registrant = Registrant::find($id);

        if (!$registrant) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'address' => 'required',
            'phone_number' => 'required|max:20',
            'identity_number' => 'nullable|max:30',
            'special_notes' => 'nullable',
            'has_medical_history' => 'required|in:Ya,Tidak',
            'agreement' => 'accepted',
        ]);

        $registrant->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $registrant
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registrant = Registrant::find($id);

        if (!$registrant) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $registrant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

}
