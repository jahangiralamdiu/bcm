<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'product_type_id', 'description'];

    public function productType ()
    {
        return $this->hasOne(ProductType::class);
    }
}
