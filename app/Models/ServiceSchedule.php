<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_place',
        'service_description',
        'location_id',
        'date',
        'time_start',
        'time_end',
        'terms_and_conditions', // syarat dan ketentuan
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
