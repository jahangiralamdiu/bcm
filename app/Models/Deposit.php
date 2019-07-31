<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposits';

    protected $fillable = ['depositor_id', 'amount', 'deposit_date', 'remarks'];

    public function depositor()
    {
        return $this->hasOne(User::class, 'id', 'depositor_id');
    }
}
