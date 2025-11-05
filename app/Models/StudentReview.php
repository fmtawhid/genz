<?php

// app/Models/StudentReview.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'student_name',
        'position_name',
        'image',
        'video_url',
        'body',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Convenience accessor (fallback image)
    public function getPhotoUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('img/reviews/'.$this->image))) {
            return asset('img/reviews/'.$this->image);
        }
        return 'https://via.placeholder.com/100x100.png?text=Student';
    }
}
