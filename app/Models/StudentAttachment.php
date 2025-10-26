<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'file_path',
        'file_name',
        'file_type'
    ];

    /**
     * Get the student that owns the attachment.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}