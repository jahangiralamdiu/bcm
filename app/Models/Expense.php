<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    protected $fillable = ['product_id', 'quantity', 'unit', 'amount', 'expense_date', 'source_of_money', 'expended_by',
        'status', 'details'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function expendedBy()
    {
        return $this->belongsTo(User::class, 'expended_by', 'id');
    }

}
