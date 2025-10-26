<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sreni extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_sreni');
    }
}