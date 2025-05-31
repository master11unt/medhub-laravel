<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Schedule::query();
        if ($request->doctor_id) {
            $query->where('doctor_id', $request->doctor_id);
        }
        $schedules = $query->orderBy('date')->get();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Jadwal tidak ditemukan'
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
