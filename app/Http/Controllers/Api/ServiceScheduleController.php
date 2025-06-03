<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\ServiceSchedule;
use Illuminate\Http\Request;

class ServiceScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = ServiceSchedule::with('location')->get();
        return response()->json([
            'status' => 'Sukses',
            'data' => $schedules
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
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

        $schedule = ServiceSchedule::create($request->all());

        return response()->json([
            'status' => 'Sukses',
            'data' => $schedule
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = ServiceSchedule::with('location')->find($id);

        if (!$schedule) {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Jadwal layanan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $schedule
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
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

        $schedule = ServiceSchedule::findOrFail($id);
        $schedule->update($request->all());

        return response()->json([
            'status' => 'Sukses',
            'data' => $schedule
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = ServiceSchedule::findOrFail($id);
        $schedule->delete();

        return response()->json([
            'status' => 'Sukses',
            'message' => 'Jadwal layanan berhasil dihapus'
        ], 200);
    }

}
