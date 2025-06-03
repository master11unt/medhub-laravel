<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('Admin.Layanan.lokasi', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string',
        ]);

        Location::create($request->only(['name', 'address']));
        return back()->with('Sukses', 'Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string',
        ]);

        $locations = Location::findOrFail($id);
        $locations->update($request->only(['name', 'address']));
        return back()->with('Sukses', 'Lokasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $locations = Location::findOrFail($id);
        $locations->delete();
        return back()->with('Delete', 'Lokasi berhasil dihapus!');
    }
}