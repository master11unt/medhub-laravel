<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $doctorId = Auth::user()->doctor->id;
        $schedules = Schedule::where('doctor_id', $doctorId)->orderBy('date')->get();
        return view('Dokter.Schedules.indexS', compact('schedules'));
    }

    public function create()
    {
        return redirect()->route('dokter.schedules.create');
    }

    public function store(Request $request)
    {
        $doctorId = Auth::user()->doctor->id;
        $request->validate([
            'date' => 'required|date',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        Schedule::create([
            'doctor_id' => $doctorId,
            'date' => $request->date,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return redirect()->route('dokter.schedules.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return redirect()->route('dokter.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $request->validate([
            'date' => 'required|date',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        $schedule->update($request->only(['date', 'day', 'start_time', 'end_time']));
        return redirect()->route('dokter.schedules.index')->with('success', 'Jadwal berhasil diupdate!');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('dokter.schedules.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
