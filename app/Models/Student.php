<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'form_number',
        'dhakila_number',
        'dhakila_date',
        'student_name',
        'father_name',
        'mobile',
        'district',
       
        'bibag_id',
        'type',
        'email',
        'emergency_contact',
        'date_of_birth',
        'image',
        'gender',
        'slug',

    ];


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')->withTimestamps();
    }

    
    public function attachments()
    {
        return $this->hasMany(StudentAttachment::class);
    }



        public function bibag()
    {
        return $this->belongsTo(Bibag::class, 'bibag_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'dhakila_number', 'dhakila_number');
    }

   
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'student_dhakila_number', 'dhakila_number');
    }

}
