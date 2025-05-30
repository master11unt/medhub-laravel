<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'height', 
        'weight', 
        'blood_type', 
        'birth_date', 
        'age', 
        'allergies', 
        'current_medications', 
        'current_conditions', 
        'medical_document'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
