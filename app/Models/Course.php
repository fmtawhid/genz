<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'image', 'short_description',
        'long_description', 'price', 'duration'
    ];

    // Many-to-Many Topics
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'course_topic')->withTimestamps();
    }

    // Teachers সম্পর্ক (Many-to-Many)
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher')->withTimestamps();
    }

    // Students সম্পর্ক (Many-to-Many)
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student')->withTimestamps();
    }
}
