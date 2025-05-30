<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // Mengambil data dokter berdasarkan role "dokter"
        $doctors = Doctor::whereHas('user', function ($query) {
            $query->where('role', 'dokter'); // Memastikan hanya yang berrole "dokter" yang ditampilkan
        })->get();

        // Mengirim data dokter ke view
        return view('Admin.Dokter.indexD', compact('doctors'));
    }


    public function updateSpecialization(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->is_specialist = $request->input('is_specialist');
        $doctor->save();

        return redirect()->route('index.dokter')->with('success', 'Spesialisasi berhasil diperbarui.');
    }

    public function toggleConsultationStatus($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['error' => 'Dokter tidak ditemukan.'], 404);  // Menangani error jika dokter tidak ditemukan
        }

        $doctor->is_in_consultation = !$doctor->is_in_consultation;
        $doctor->save();

        return response()->json(['success' => true, 'is_in_consultation' => $doctor->is_in_consultation]);
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('index.dokter')->with('success', 'Dokter berhasil dihapus.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('Admin.Dokter.editD', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user;

        $doctor->specialization = $request->input('specialization');
        $doctor->education = $request->input('education');
        $doctor->practice_place = $request->input('practice_place');
        $doctor->license_number = $request->input('license_number');
        $doctor->average_rating = $request->input('average_rating');
        $doctor->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images/doctors', 'public');
            $user->image = $image;
            $user->save();
        }

        return redirect()->route('index.dokter')->with('success', 'Dokter berhasil diperbarui.');
    }

}
