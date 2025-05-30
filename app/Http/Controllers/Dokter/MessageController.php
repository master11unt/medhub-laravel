<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Tampilkan daftar konsultasi yang dimiliki dokter
    public function index()
    {
        $doctorId = Auth::user()->doctor->id;
        $consultations = Consultation::where('doctor_id', $doctorId)->with('user')->orderBy('consultation_date', 'desc')->get();
        return view('Dokter.Messages.indexM', compact('consultations'));
    }

    // Tampilkan chat pada satu konsultasi
    public function show($consultation_id)
    {
        $consultation = Consultation::with('user')->findOrFail($consultation_id);
        $messages = Message::where('consultation_id', $consultation_id)->with('sender')->orderBy('sent_at', 'asc')->get();
        return view('Dokter.Messages.chat', compact('consultation', 'messages'));
    }

    // Kirim pesan baru
    public function store(Request $request, $consultation_id)
    {
        $request->validate([
            'message_text' => 'required|string',
            'attachment' => 'nullable|file|max:2048'
        ]);

        $data = [
            'consultation_id' => $consultation_id,
            'sender_id' => Auth::id(),
            'message_text' => $request->message_text,
            'sent_at' => now(),
        ];

        // Jika ada attachment
        if ($request->hasFile('attachment')) {
            $data['attachment_path'] = $request->file('attachment')->store('attachments', 'public');
        }

        Message::create($data);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
