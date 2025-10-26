<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $fillable = [
        'name', 
        'designation',
        'image',
        'phone_number',
        'email',
        'address',
        'facebook_link',
        'date_of_joining',
        'salary',
        'qualification',
        'status',
        'years_of_experience',
        'department',
        'staff_type',
        'date_of_birth',
        'blood_group',
        'user_id',
        'nid_number', // 👈 Add this line
    ];

    // Teacher এর সাথে attachments সম্পর্ক
    public function attachments()
    {
        return $this->hasMany(TeacherAttachment::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'teacher_id');
    }
}