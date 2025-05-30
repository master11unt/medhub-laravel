<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicinesController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();
        return view('Admin.Obat.indexO', compact('medicines'));
    }
    

    public function create()
    {
        return view('Admin.Obat.createO');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'composition' => 'required',
            'packaging' => 'required',
            'benefits' => 'required',
            'category' => 'required',
            'dose' => 'required',
            'presentation' => 'required',
            'storage' => 'required',
            'attention' => 'required',
            'side_effects' => 'required',
            'mims_standard_name' => 'required',
            'registration_number' => 'required|unique:medicines,registration_number',
            'drug_class' => 'required',
            'remarks' => 'nullable',
            'reference' => 'required',
            'k24_url' => 'nullable',
            'is_prescription' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'share_link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('obat', 'public');
        }

        Medicine::create($validated);

        return redirect()->route('index.obat')->with('Sukses', 'Obat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('Admin.Obat.editO', compact('medicine'));
    }

    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'composition' => 'required',
            'packaging' => 'required',
            'benefits' => 'required',
            'category' => 'required',
            'dose' => 'required',
            'presentation' => 'required',
            'storage' => 'required',
            'attention' => 'required',
            'side_effects' => 'required',
            'mims_standard_name' => 'required',
            'registration_number' => 'required|unique:medicines,registration_number,'.$medicine->id,
            'drug_class' => 'required',
            'remarks' => 'nullable',
            'reference' => 'required',
            'k24_url' => 'nullable',
            'is_prescription' => 'required|boolean',
            'image' => 'nullable|image',
            'share_link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($medicine->image) {
                Storage::disk('public')->delete($medicine->image);
            }
            $validated['image'] = $request->file('image')->store('obat', 'public');
        }

        $medicine->update($validated);

        return redirect()->route('index.obat')->with('Sukses', 'Obat berhasil diupdate!');
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        if ($medicine->image) {
            Storage::disk('public')->delete($medicine->image);
        }
        $medicine->delete();

        return redirect()->route('Admin.Obat.indexO')->with('Delete', 'Obat berhasil dihapus!');
    }
}