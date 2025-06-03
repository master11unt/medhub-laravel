<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Illuminate\Http\Request;

class RegistrantController extends Controller
{
    // Tampilkan daftar pendaftar
    public function index()
    {
        $registrants = Registrant::all();
        return view('Admin.Registrants.index', compact('registrants'));
    }

    // Tampilkan form tambah pendaftar
    public function create()
    {
        return view('Admin.Registrants.create');
    }

    // Simpan data pendaftar baru
    public function store(Request $request)
    {
        $request->validate([
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

        Registrant::create($request->all());

        return redirect()->route('index.pendaftar')->with('success', 'Pendaftaran berhasil disimpan.');
    }

    // Tampilkan form edit
    public function edit(Registrant $registrant)
    {
        return view('Admin.Registrants.edit', compact('registrant'));
    }

    // Update data pendaftar
    public function update(Request $request, Registrant $registrant)
    {
        // dd($request->all(), $registrant);
        $request->validate([
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

        $registrant->update($request->all());

        return redirect()->route('index.pendaftar')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data pendaftar
    public function destroy(Registrant $registrant)
    {
        $registrant->delete();

        return redirect()->route('index.pendaftar')->with('success', 'Data berhasil dihapus.');
    }
}