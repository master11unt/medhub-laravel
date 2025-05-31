<?php

use App\Http\Controllers\Admin\CategoryEducationController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\HealthRecordController;
use App\Http\Controllers\Admin\MedicinesController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\BaseDokterController;
use App\Http\Controllers\Dokter\MessageController;
use App\Http\Controllers\Dokter\ScheduleController;
use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::controller(BaseController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('index.dashboard');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard/user', 'index')->name('index.user');        
        Route::post('/dashboard/user/create', 'create')->name('create.user');        
        Route::delete('/dashboard/user/delete', 'delete')->name('delete.user');        
    });
    Route::controller(DoctorController::class)->group(function () {
        Route::get('/dashboard/dokter', 'index')->name('index.dokter'); // Menampilkan daftar dokter
        Route::post('/dashboard/dokter/create', 'store')->name('create.dokter'); // Menambahkan dokter baru
        Route::delete('/dashboard/dokter/delete/{id}', 'destroy')->name('delete.dokter'); // Menghapus dokter
        Route::put('/dashboard/dokter/update/{id}', 'update')->name('update.dokter'); // Mengupdate data dokter
        Route::get('/dashboard/dokter/edit/{id}', 'edit')->name('edit.dokter');
    });
    Route::controller(CategoryEducationController::class)->group(function () {
        Route::get('/dashboard/education-categories', 'index')->name('index.education-categories');
        Route::post('/dashboard/education-categories/create', 'create')->name('create.education-categories');
        Route::delete('/dashboard/education-categories/delete', 'delete')->name('delete.education-categories');
        Route::put('/dashboard/education-categories/update/{id}', 'update')->name('update.education-categories');
    });
    Route::controller(EducationController::class)->group(function () {
        Route::get('/dashboard/educations', 'index')->name('index.educations');
        Route::post('/dashboard/educations/create', 'create')->name('create.educations');
        Route::delete('/dashboard/educations/delete', 'delete')->name('delete.educations');
        Route::put('/dashboard/educations/update/{id}', 'update')->name('update.educations');
    });
    Route::controller(PrescriptionController::class)->group(function () {
        Route::get('/dashboard/prescriptions', 'index')->name('index.prescriptions');
        Route::post('/dashboard/prescriptions/create', 'create')->name('create.prescriptions');
        Route::delete('/dashboard/prescriptions/delete', 'delete')->name('delete.prescriptions');
        Route::put('/dashboard/prescriptions/update/{id}', 'update')->name('update.prescriptions');
    });
    Route::controller(ConsultationController::class)->group(function () {
        Route::get('/dashboard/consultations', 'index')->name('index.consultations');
        Route::post('/dashboard/consultations/create', 'store')->name('create.consultations');
        Route::delete('/dashboard/consultations/delete', 'destroy')->name('delete.consultations');
        Route::put('/dashboard/consultations/update/{id}', 'update')->name('update.consultations');
    });
    Route::controller(HealthRecordController::class)->group(function () {
        Route::get('/dashboard/health_records', 'index')->name('index.health_records');
        Route::post('/dashboard/health_records/create', 'store')->name('create.health_records');
        Route::delete('/dashboard/health_records/delete', 'destroy')->name('delete.health_records');
    });
    Route::controller(MedicinesController::class)->group(function () {
        Route::get('/dashboard/obat', 'index')->name('index.obat');
        Route::get('/dashboard/obat/create', 'create')->name('create.obat'); // <-- Tambahkan ini untuk halaman create
        Route::post('/dashboard/obat/store', 'store')->name('store.obat');   // <-- Ganti nama route POST agar tidak bentrok
        Route::get('/dashboard/obat/edit/{id}', 'edit')->name('edit.obat');
        Route::put('/dashboard/obat/update/{id}', 'update')->name('update.obat');
        Route::delete('/dashboard/obat/delete/{id}', 'destroy')->name('delete.obat');
    });

    Route::resource('doctors', DoctorController::class);

    Route::put('doctors/{id}/specialization', [DoctorController::class, 'updateSpecialization'])->name('doctors.updateSpecialization');

    Route::post('doctors/{id}/toggle-consultation', [DoctorController::class, 'toggleConsultationStatus'])->name('doctors.toggleConsultation');
    
});

Route::prefix('doctor')->middleware(['auth', 'isDoctor'])->group(function () {
    Route::controller(BaseDokterController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dokter.dashboard');
    });
    Route::controller(DokterController::class)->group(function () {
        Route::get('/complete-profile', 'showCompleteProfileForm')->name('doctor.complete-profile');
        Route::post('/complete-profile', 'storeCompleteProfile');
        Route::get('/dashboard/dokter/edit/{id}', 'edit')->name('edit.dokter');
        Route::put('/dashboard/dokter/update/{id}', 'update')->name('update.dokter'); // Mengupdate data dokter
        // Route::post('/status-online', 'updateStatusOnline')->name('dokter.status_online'); // Untuk update status online/offline

    });

    Route::get('consultations', [MessageController::class, 'index'])->name('dokter.consultations');
    Route::get('consultations/{id}/chat', [MessageController::class, 'show'])->name('dokter.consultations.chat');
    Route::post('consultations/{id}/chat', [MessageController::class, 'store'])->name('dokter.consultations.chat.send');

    Route::get('/doctor/profile', [DokterController::class, 'showProfile'])->name('doctor.profile');
    Route::put('/dokter/update-status', [DokterController::class, 'updateStatus'])->name('dokter.updateStatus');
    Route::get('/dokter/short-profile', [DokterController::class, 'showShortProfile'])->name('dokter.shortProfile');

    Route::get('/schedules', [ScheduleController::class, 'index'])->name('dokter.schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('dokter.schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('dokter.schedules.store');
    Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('dokter.schedules.edit');
    Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->name('dokter.schedules.update');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('dokter.schedules.destroy');

});