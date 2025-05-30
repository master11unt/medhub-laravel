<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // List semua pesan pada konsultasi milik user yang login
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $messages = Message::with(['consultation', 'sender'])
            ->whereHas('consultation', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->orderBy('sent_at', 'asc')
            ->get();

        return response()->json([
            'status' => 'Sukses',
            'data' => $messages
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // Detail pesan
    public function show($id, Request $request)
    {
        $userId = $request->user()->id;
        $message = Message::with(['consultation', 'sender'])
            ->where('id', $id)
            ->whereHas('consultation', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->first();

        if (!$message) {
            return response()->json([
                'status' => 'Gagal',
                'pesan' => 'Pesan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'Sukses',
            'data' => $message
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
