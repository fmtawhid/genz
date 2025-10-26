<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'expense_head_id',
        'name',
        'invoice_no',
        'date',
        'amount',
        'note',
    ];

    /**
     * Get the expense head that owns the expense.
     */
    public function expenseHead()
    {
        return $this->belongsTo(ExpenseHead::class);
    }

    /**
     * Get the attachments for the expense.
     */
    public function attachments()
    {
        return $this->hasMany(ExpenseAttachment::class);
    }
}