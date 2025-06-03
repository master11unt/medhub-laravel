<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'birth_date',
        'gender',
        'address',
        'phone_number',
        'identity_number',
        'has_medical_history',
        'special_notes',
        'agreement',
    ];

}
