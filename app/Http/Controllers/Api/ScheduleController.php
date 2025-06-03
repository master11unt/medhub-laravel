<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function getSchedulesByDoctorId($doctorId)
    {
        try {
            Log::info("Fetching schedules for doctor ID: $doctorId");
            $schedules = Schedule::where('doctor_id', $doctorId)
                               ->orderBy('day')
                               ->orderBy('start_time')
                               ->get();

            Log::info("Found {$schedules->count()} schedules for doctor $doctorId");
            Log::info("Schedules data: " . $schedules->toJson());
            
            return response()->json([
                'status' => 'success',
                'data' => $schedules,
                'message' => "Found {$schedules->count()} schedules for doctor $doctorId",
                'doctor_id' => $doctorId
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error fetching schedules for doctor $doctorId: " . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch schedules: ' . $e->getMessage(),
                'data' => [],
                'doctor_id' => $doctorId
            ], 500);
        }
    }

    public function checkAvailability(Request $request)
    {
        try {
            $doctorId = $request->query('doctor_id');
            $date = $request->query('date');
            
            $schedule = Schedule::where('doctor_id', $doctorId)
                              ->whereDate('created_at', $date)
                              ->first();
            
            return response()->json([
                'status' => 'success',
                'available' => $schedule ? true : false
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to check availability: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function getAllSchedules()
    // {
    //     try {
    //         $schedules = Schedule::with('doctor')->get();
            
    //         return response()->json([
    //             'status' => 'success',
    //             'data' => $schedules,
    //             'total' => $schedules->count()
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
