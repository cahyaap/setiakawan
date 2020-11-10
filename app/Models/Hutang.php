<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hutang extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function seller(){
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
