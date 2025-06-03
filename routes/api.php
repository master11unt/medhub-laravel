<?php

use App\Http\Controllers\Api\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\CategoryEducationController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\HealthRecordController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\EdukasiApiController;
use App\Http\Controllers\Api\LokasiController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\PrescriptionItemController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ObatApiController;
use App\Http\Controllers\Api\RegistrantApiController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\ServiceScheduleController;

// ==================== AUTH ====================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/update-profile-image', [AuthController::class, 'updateImage'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/update-profile', [AuthController::class, 'updateProfile']);
});

// ==================== DOCTOR ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/doctors', DoctorController::class);
});

// ==================== CATEGORY & EDUCATION ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/api-categories', CategoryEducationController::class);
    Route::apiResource('/api-educations', EducationController::class);
});

// ==================== HEALTH RECORD ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/health-records/me', [HealthRecordController::class, 'me']);
    Route::get('/health-records', [HealthRecordController::class, 'show']);
    Route::post('/health-records', [HealthRecordController::class, 'store']);
    Route::put('/health-records/{id}', [HealthRecordController::class, 'update']);
    Route::put('/health-records/user/{user_id}', [HealthRecordController::class, 'updateByUserId']);
    // Route::put('/health-records/me', [HealthRecordController::class, 'updateMe']);
});

// ==================== SCHEDULE ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::get('/schedules/{id}', [ScheduleController::class, 'show']);
    Route::get('/schedules/doctor/{doctorId}', [ScheduleController::class, 'getSchedulesByDoctorId']);
    Route::get('/schedules/check-availability', [ScheduleController::class, 'checkAvailability']);
});

// ==================== CONSULTATION, PRESCRIPTION, MESSAGE ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/consultations', ConsultationController::class);
    Route::apiResource('/prescriptions', PrescriptionController::class);
    Route::apiResource('/prescription-items', PrescriptionItemController::class);
    Route::apiResource('/api-prescriptionItems', PrescriptionItemController::class);
    Route::apiResource('/messages', MessageController::class);
});

// ==================== APPOINTMENT ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/appointments', AppointmentController::class);
    Route::get('/appointments/user/current', [AppointmentController::class, 'getCurrentUserAppointments']);
    Route::get('/appointments/doctor/{doctorId}', [AppointmentController::class, 'getAppointmentsByDoctor']);
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancelAppointment']);
    Route::post('/appointments/{appointment}/complete', [AppointmentController::class, 'completeAppointment']);



    Route::get('/service-schedules/{id}', [ServiceScheduleController::class, 'show']);
    Route::put('/service-schedules/{id}', [ServiceScheduleController::class, 'update']);
    Route::delete('/service-schedules/{id}', [ServiceScheduleController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn(Request $request) => $request->user());
    Route::put('/update-profile', [AuthController::class, 'updateProfile']);
});

// ==================== LOCATION ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/locations', [LokasiController::class, 'index']);
    Route::post('/locations', [LokasiController::class, 'store']);
    Route::get('/locations/{id}', [LokasiController::class, 'show']);
    Route::put('/locations/{id}', [LokasiController::class, 'update']);
    Route::delete('/locations/{id}', [LokasiController::class, 'destroy']);
});

// ==================== REGISTRANT ====================

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/registrants', RegistrantApiController::class);
});
Route::apiResource('/obat', ObatApiController::class);Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/registrants', RegistrantApiController::class);
    Route::apiResource('/obat', ObatApiController::class);
});

Route::apiResource('/edukasi', EdukasiApiController::class);