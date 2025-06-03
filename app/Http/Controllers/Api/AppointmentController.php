<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Jika admin, tampilkan semua appointment
        if ($user->is_admin) {
            $appointments = Appointment::with(['doctor.user', 'schedule', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Jika user biasa, hanya tampilkan appointment miliknya
            $appointments = Appointment::with(['doctor.user', 'schedule'])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }
            
        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Cek apakah schedule tersebut milik doctor yang dipilih
        $schedule = Schedule::where('id', $request->schedule_id)
                       ->where('doctor_id', $request->doctor_id)
                       ->first();

        if (!$schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'Schedule tidak valid untuk doctor yang dipilih'
            ], 422);
        }

        // Cek apakah schedule sudah terpakai
        $existingAppointment = Appointment::where('schedule_id', $request->schedule_id)
                                    ->exists();

        if ($existingAppointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jadwal sudah terisi, silakan pilih waktu lain'
            ], 422);
        }

        // Buat appointment baru
        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'schedule_id' => $request->schedule_id,
            'status' => 'pending'
        ]);

        // Load relasi untuk response
        $appointment->load(['doctor.user', 'schedule']);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil membuat janji temu',
            'data' => $appointment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $appointment = Appointment::with(['doctor.user', 'schedule'])
            ->findOrFail($id);
            
        // Cek authorization - user hanya boleh melihat appointment miliknya
        if (Auth::id() !== $appointment->user_id && !Auth::user()->is_admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }
            
        return response()->json([
            'status' => 'success',
            'data' => $appointment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Cek authorization - user hanya boleh mengubah appointment miliknya
        if (Auth::id() !== $appointment->user_id && !Auth::user()->is_admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }
        
        // Appointment hanya bisa diubah jika statusnya masih pending
        if ($appointment->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment tidak dapat diubah karena statusnya bukan pending'
            ], 422);
        }
        
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'sometimes|exists:doctors,id',
            'schedule_id' => 'sometimes|exists:schedules,id',
            'status' => 'sometimes|in:pending,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Jika mengubah doctor atau schedule
        if ($request->has('doctor_id') || $request->has('schedule_id')) {
            $doctorId = $request->doctor_id ?? $appointment->doctor_id;
            $scheduleId = $request->schedule_id ?? $appointment->schedule_id;
            
            // Cek apakah schedule tersebut milik doctor yang dipilih
            $schedule = Schedule::where('id', $scheduleId)
                           ->where('doctor_id', $doctorId)
                           ->first();

            if (!$schedule) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Schedule tidak valid untuk doctor yang dipilih'
                ], 422);
            }

            // Cek apakah schedule sudah terpakai oleh appointment lain
            $existingAppointment = Appointment::where('schedule_id', $scheduleId)
                                        ->where('id', '!=', $id)
                                        ->exists();

            if ($existingAppointment) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal sudah terisi, silakan pilih waktu lain'
                ], 422);
            }
            
            $appointment->doctor_id = $doctorId;
            $appointment->schedule_id = $scheduleId;
        }

        // Update status jika ada
        if ($request->has('status')) {
            $appointment->status = $request->status;
        }
        
        $appointment->save();
        
        // Load relasi untuk response
        $appointment->load(['doctor.user', 'schedule']);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah janji temu',
            'data' => $appointment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Cek authorization - user hanya boleh menghapus appointment miliknya
        if (Auth::id() !== $appointment->user_id && !Auth::user()->is_admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }
        
        // Appointment hanya bisa dihapus jika statusnya masih pending
        if ($appointment->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment tidak dapat dihapus karena statusnya bukan pending'
            ], 422);
        }
        
        $appointment->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menghapus janji temu'
        ]);
    }

    /**
     * Update status appointment (khusus untuk admin/doctor)
     */
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Hanya admin atau doctor yang bersangkutan yang bisa mengubah status
        if (!Auth::user()->is_admin && Auth::id() !== $appointment->doctor->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }
        
        $appointment->status = $request->status;
        $appointment->save();
        
        $appointment->load(['doctor.user', 'schedule', 'user']);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Status appointment berhasil diubah',
            'data' => $appointment
        ]);
    }

    /**
     * Get current user appointments
     */
    public function getCurrentUserAppointments()
    {
        $appointments = Appointment::with(['doctor.user', 'schedule'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ]);
    }

    /**
     * Get appointments by doctor
     */
    public function getAppointmentsByDoctor($doctorId)
    {
        // Cek apakah user adalah admin atau doctor yang bersangkutan
        $user = Auth::user();
        if (!$user->is_admin) {
            $doctor = Doctor::where('user_id', Auth::id())->first();
            if (!$doctor || $doctor->id != $doctorId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 403);
            }
        }

        $appointments = Appointment::with(['user', 'schedule'])
            ->where('doctor_id', $doctorId)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ]);
    }

    /**
     * Cancel appointment
     */
    public function cancelAppointment(Appointment $appointment)
    {
        // Cek authorization
        if (Auth::id() !== $appointment->user_id && !Auth::user()->is_admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }

        // Hanya bisa cancel jika status pending
        if (!$appointment->canBeCancelled()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment tidak dapat dibatalkan karena statusnya bukan pending'
            ], 422);
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        $appointment->load(['doctor.user', 'schedule']);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment berhasil dibatalkan',
            'data' => $appointment
        ]);
    }

    /**
     * Complete appointment
     */
    public function completeAppointment(Appointment $appointment)
    {
        // Hanya admin atau doctor yang bersangkutan yang bisa complete
        if (!Auth::user()->is_admin && Auth::id() !== $appointment->doctor->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }

        // Hanya bisa complete jika status pending
        if (!$appointment->canBeCompleted()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment tidak dapat diselesaikan karena statusnya bukan pending'
            ], 422);
        }

        $appointment->status = 'completed';
        $appointment->save();

        $appointment->load(['doctor.user', 'schedule', 'user']);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment berhasil diselesaikan',
            'data' => $appointment
        ]);
    }
}
