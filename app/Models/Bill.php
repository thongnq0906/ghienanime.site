<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $guarded = [];

    public function BillDetail()
    {
        return $this->hasMany(BillDetail::class, 'bill_id');
    }
}
