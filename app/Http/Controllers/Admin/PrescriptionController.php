<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('consultation')->get();
        $consultations = Consultation::all();
        return view('Admin.Prescription.indexP', compact('prescriptions', 'consultations'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'medicine_name' => 'required|string|max:255',
            'instructions' => 'required|string',
        ]);

        Prescription::create([
            'consultation_id' => $request->consultation_id,
            'medicine_name' => $request->medicine_name,
            'instructions' => $request->instructions,
        ]);

        return redirect()->route('index.prescriptions')->with('success', 'Prescription created successfully.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:prescriptions,id',
        ]);

        $prescription = Prescription::findOrFail($request->id);
        $prescription->delete();

        return redirect()->route('index.prescriptions')->with('delete', 'Prescription deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'medicine_name' => 'required|string|max:255',
            'instructions' => 'required|string',
        ]);

        $prescription = Prescription::findOrFail($id);
        $prescription->update([
            'consultation_id' => $request->consultation_id,
            'medicine_name' => $request->medicine_name,
            'instructions' => $request->instructions,
        ]);

        return redirect()->route('index.prescriptions')->with('success', 'Prescription updated successfully.');
    }
}
