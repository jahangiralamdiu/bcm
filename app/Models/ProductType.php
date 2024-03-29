<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_types';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
