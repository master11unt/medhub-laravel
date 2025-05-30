<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message_text',
        'attachment_path',
        'sent_at',
    ];

    // Relasi
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
}
