<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'title', 
        'content', 
        'type', 
        'thumbnail', 
        'source', 
        'institution_logo', 
        'author_name', 
        'published_at', 
        'video_url', 
        'share_link', 
        'education_category_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi
    public function category()
    {
        return $this->belongsTo(EducationCategory::class, 'education_category_id');
    }
    
}
