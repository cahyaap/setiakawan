<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function harga(){
        return $this->hasMany(Harga::class, 'barang_id', 'id');
    }

    public function stok(){
        return $this->hasMany(DetailTransaksi::class, 'barang_id', 'id');
    }

    public function stokOpname(){
        return $this->hasMany(DetailStokOpname::class, 'barang_id', 'id');
    }
}
