<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HealthRecordController extends Controller
{
    public function index()
    {
        $healthRecords = HealthRecord::latest()->get();
        $users = User::all();
        return view('Admin.Rekdis.indexR', compact('healthRecords', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'blood_type' => 'nullable|string|max:5',
            'birth_date' => 'nullable|date',
            'age' => 'nullable|integer',
            'allergies' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'current_conditions' => 'nullable|string',
            'medical_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('medical_document')) {
            $request->merge([
                'medical_document' => $request->file('medical_document')->store('medical_documents', 'public')
            ]);
        }

        HealthRecord::create($request->all());

        Session::flash('success', 'Health record created successfully!');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $healthRecord = HealthRecord::findOrFail($request->id);
        $healthRecord->delete();

        Session::flash('delete', 'Health record deleted successfully!');
        return redirect()->back();
    }
}
