<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bibag extends Model
{
    protected $fillable = [
        'name',
    ];
    use HasFactory;
    use SoftDeletes;
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function srenis()
    {
        return $this->hasMany(Sreni::class);
    }
}