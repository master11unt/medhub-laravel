<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name', 
        'price', 
        'description', 
        'composition', 
        'packaging', 
        'benefits', 
        'category', 
        'dose',
        'presentation',
        'storage',
        'attention',
        'side_effects',
        'mims_standard_name',
        'registration_number',
        'drug_class',
        'remarks',
        'reference',
        'k24_url',
        'is_prescription',
        'image',
        'share_link',
    ];
    protected $casts = [
        'is_prescription' => 'boolean',
    ];
    // Relasi
    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class);
    }
}
