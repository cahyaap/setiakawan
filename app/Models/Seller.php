<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function hutang(){
        return $this->hasMany(Hutang::class, 'seller_id', 'id');
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class, 'seller_id', 'id');
    }
}
