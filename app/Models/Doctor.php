<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'specialization', 
        'education', 
        'practice_place', 
        'description', 
        'license_number', 
        'is_specialist',
        'is_online',
        'is_in_consultation',
        'average_rating', 
    ];

    // Relasi dengan tabel users (user_id)
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke model User
    }

    // Relasi dengan tabel ratings (misalnya jika ada tabel ratings untuk dokter)
    public function ratings()
    {
        return $this->hasMany(Rating::class); // Satu dokter bisa memiliki banyak rating
    }

    // Relasi dengan tabel consultations (jika ada tabel consultations yang terkait dengan dokter)
    public function consultations()
    {
        return $this->hasMany(Consultation::class); // Satu dokter bisa memiliki banyak konsultasi
    }

    // Relasi dengan tabel prescriptions (jika ada tabel prescriptions yang terkait dengan dokter)
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class); // Satu dokter bisa memiliki banyak resep
    }
    // Relasi dengan tabel messages (jika ada tabel messages yang terkait dengan dokter)
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id'); // Satu dokter bisa mengirim banyak pesan
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class); // Satu dokter bisa memiliki banyak jadwal
    }
}
