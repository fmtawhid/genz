<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'merchant_id',
        'course_id',
        'name',
        'email',
        'phone',
        'goal',
        'attachment',
        'status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}