<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate_product extends Model
{
    protected $table = 'cate_products';
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(Product::class, 'cate_product_id');
    }
}
