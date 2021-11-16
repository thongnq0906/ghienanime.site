<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate_post extends Model
{
    protected $guarded = [];

    public function Post()
    {
        return $this->hasMany(Post::class, 'cate_post_id');
    }
}
