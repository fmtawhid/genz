<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gallery extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Add 'note' to the fillable array
    protected $fillable = [
        'note',  // Add this line
        'date',
        'image',
    ];
}