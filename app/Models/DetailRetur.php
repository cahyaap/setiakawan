<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRetur extends Model
{
    protected $guarded = [];

    public function retur()
    {
        return $this->belongsTo(Retur::class, 'retur_id');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
