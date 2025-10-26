<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'sreni_id',
        'bibag_id', 
        'subject_id', 
        'lesson_date', 
        'title', 
        'note', 
        'pdf_file'
    ];

    // Relationship with Sreni
    public function bibag()
    {
        return $this->belongsTo(Bibag::class); // Each lesson belongs to a Sreni
    }
    public function sreni()
    {
        return $this->belongsTo(Sreni::class); // Each lesson belongs to a Sreni
    }

    // Relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class); // Each lesson belongs to a Subject
    }
}
