<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function Cate_post()
    {

        return $this->belongsTo('App\Models\Cate_post', 'cate_post_id', 'id');
    }
    public function getShortDec(){
        if (strlen($this->title) > 150){
            return substr($this->title, 0,strpos($this->title, ' ', 150)) . ' ...';
        } else {
        return $this->title;
        }
    }
}
