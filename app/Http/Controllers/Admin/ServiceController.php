<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\ServiceSchedule;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceSchedules = ServiceSchedule::with('location')->get();

        $locations = Location::all();

        return view('Admin.Layanan.layanan', compact('serviceSchedules', 'locations'));
    }


    public function create()
    {
        $locations = Location::all();
        return view('Admin.Layanan.createlayanan', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:100',
            'service_place' => 'required|string|max:255',
            'service_description' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'location_id' => 'required|exists:locations,id',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
        ]);

        ServiceSchedule::create([
            'service_name' => $request->service_name,
            'service_place' => $request->service_place, 
            'service_description' => $request->service_description,
            'terms_and_conditions' => $request->terms_and_conditions,
            'location_id' => $request->location_id,
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);

        return redirect()->route('index.layanan')->with('Sukses', 'Layanan berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $serviceSchedule = ServiceSchedule::findOrFail($id);
        $locations = Location::all();
        return view('Admin.Layanan.editlayanan', compact('serviceSchedule', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|string|max:100',
            'service_place' => 'required|string|max:255',
            'service_description' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'location_id' => 'required|exists:locations,id',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
        ]);

        $serviceSchedule = ServiceSchedule::findOrFail($id);
        $serviceSchedule->update($request->all());
        return redirect()->route('index.layanan')->with('Sukses', 'Layanan berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $serviceSchedule = ServiceSchedule::findOrFail($id);
        $serviceSchedule->delete();

        return redirect()->route('index.layanan')->with('Delete', 'Layanan berhasil dihapus!');
    }
}