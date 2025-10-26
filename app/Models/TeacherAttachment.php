<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
