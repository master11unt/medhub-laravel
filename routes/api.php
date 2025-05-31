<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryEducationController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\HealthRecordController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\PrescriptionItemController;
use App\Http\Controllers\Api\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/update-profile-image', [AuthController::class, 'updateImage'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->put('/update-profile', [AuthController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->put('/health-records/me', [HealthRecordController::class, 'updateMe']);

Route::apiResource('/api-doctors', DoctorController::class)->middleware('auth:sanctum');
// Route::apiResource('/doctors', DoctorController::class);

Route::apiResource('/api-categories', CategoryEducationController::class)->middleware('auth:sanctum');
Route::apiResource('/api-educations', EducationController::class)->middleware('auth:sanctum');
// Route::apiResource('/api-prescriptionItems', PrescriptionItemController::class)->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/consultations', ConsultationController::class)->only(['index', 'show']);
    Route::apiResource('/prescriptions', PrescriptionController::class)->only(['index', 'show']);
    Route::apiResource('/prescription-items', PrescriptionItemController::class)->only(['index', 'show']);
    Route::apiResource('/messages', MessageController::class)->only(['index', 'show']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/health-records/me', [HealthRecordController::class, 'me']);
    Route::get('/health-records', [HealthRecordController::class, 'show']);
    Route::post('/health-records', [HealthRecordController::class, 'store']);
    Route::put('/health-records/{id}', [HealthRecordController::class, 'update']);

    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::get('/schedules/{id}', [ScheduleController::class, 'show']);
});