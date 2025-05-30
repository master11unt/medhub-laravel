<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class BaseDokterController extends Controller
{
    public function index() {
        $doctor = Doctor::where('user_id', Auth::id())->first();
        if (!$doctor) {
            return redirect()->route('doctor.complete-profile')->with('warning', 'Lengkapi data dokter terlebih dahulu.');
        }
        return view('Dokter.dashboard');
    }
}
