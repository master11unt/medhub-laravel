<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConsultationController extends Controller
{
    public function index()
    {
        // Mengambil semua konsultasi
        $consultations = Consultation::latest()->get();

        // Mengambil semua user dengan role 'user' dan 'dokter'
        $users = User::where('role', 'user')->get();  // Hanya role user
        $doctors = User::where('role', 'dokter')->get();  // Hanya role dokter

        return view('Admin.Konsul.indexK', compact('consultations', 'users', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'consultation_date' => 'required|date',
            'consultation_type' => 'required|in:umum,spesialis',
            'status' => 'required|in:ongoing,completed',
        ]);

        Consultation::create($request->all());

        Session::flash('success', 'Consultation created successfully!');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $consultation = Consultation::findOrFail($request->id);
        $consultation->delete();

        Session::flash('delete', 'Consultation deleted successfully!');
        return redirect()->back();
    }
}
