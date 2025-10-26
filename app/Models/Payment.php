<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'reciept_no',
        'date',
        'name',
        'dhakila_number',
        'address',
        'purpose_id',
        'amount',
        'amount_in_words',
        'sreni_id',
        'bibag_id',
    ];

    public function sreni()
    {
        return $this->belongsTo(Sreni::class);
    }

    public function bibag()
    {
        return $this->belongsTo(Bibag::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }

    public function attachments()
    {
        return $this->hasMany(PaymentAttachment::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'dhakila_number');
    }

}
