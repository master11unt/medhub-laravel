<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'jenis_kelamin',
        'no_ktp',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id'); // Satu dokter bisa mengirim banyak pesan
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    
}
