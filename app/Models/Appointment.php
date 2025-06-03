<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'schedule_id',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User (pasien yang membuat appointment)
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
     * Relasi ke Consultation
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk appointment yang pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk appointment yang completed
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope untuk appointment yang cancelled
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Accessor untuk mendapatkan tanggal dan waktu appointment dari schedule
     */
    public function getAppointmentDateAttribute()
    {
        if ($this->schedule) {
            // Assuming schedule has date and time information
            return $this->schedule->date . ' ' . $this->schedule->start_time;
        }
        return null;
    }

    /**
     * Check if appointment can be cancelled
     */
    public function canBeCancelled()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if appointment can be completed
     */
    public function canBeCompleted()
    {
        return $this->status === 'pending';
    }
}
