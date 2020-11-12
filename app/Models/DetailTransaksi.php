<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
