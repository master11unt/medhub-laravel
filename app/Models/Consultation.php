<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'schedule_id',
        'consultation_date',
        'status',
        'join_message',
    ];

    protected $casts = [
        'consultation_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Relasi ke Schedule
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Relasi ke Messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Relasi ke Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Scope untuk status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
