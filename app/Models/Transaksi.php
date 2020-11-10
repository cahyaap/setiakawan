<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function seller(){
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function detail(){
        return $this->hasMany(DetailTransaksi::class);
    }
}
