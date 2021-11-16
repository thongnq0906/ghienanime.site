<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Narration extends Model
{
    protected $table = 'narrations';
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
