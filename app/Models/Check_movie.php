<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check_movie extends Model
{
    protected $table = 'check_movies';
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
