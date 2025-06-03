<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DokterController extends Controller
{
    public function showCompleteProfileForm()
    {
        return view('Dokter.complete_profile');
    }

    public function storeCompleteProfile(Request $request)
    {
        $request->validate([
            'specialization' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'practice_place' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'license_number' => 'required|string|max:255|unique:doctors,license_number',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto profil di storage
        $imagePath = $request->file('image')->store('user_images', 'public');

        // Update kolom image di tabel users
        $user = User::findOrFail(Auth::id()); // dijamin instance Eloquent User
        $user->image = $imagePath;
        $user->save();

        Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization,
            'education' => $request->education,
            'practice_place' => $request->practice_place,
            'description' => $request->description,
            'license_number' => $request->license_number,
            // field boolean default otomatis
        ]);

        return redirect()->route('dokter.dashboard')->with('success', 'Profil dokter berhasil dilengkapi!');
    }

    public function showProfile()
    {
        $user = Auth::user();
        $doctor = $user->doctor; // relasi: User hasOne Doctor

        return view('Dokter.profile', compact('user', 'doctor'));
    }

    public function updateStatus(Request $request)
    {
        $doctor = Doctor::findOrFail($request->doctor_id);

        // Toggle status online/offline
        $doctor->is_online = !$doctor->is_online;
        $doctor->save();

        return redirect()->route('dokter.shortProfile')->with('success', 'Status dokter berhasil diperbarui!');
    }

    public function showShortProfile()
    {
        // Ambil data dokter berdasarkan user yang sedang login
        $user = Auth::user();
        $doctor = $user->doctor; // relasi User hasOne Doctor

        return view('Dokter.shortProfile', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('Dokter.edit_profile', compact('doctor'));
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

        return redirect()->route('doctor.profile')->with('success', 'Profil dokter berhasil diperbarui.');
    }
}
