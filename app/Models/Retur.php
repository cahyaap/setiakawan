<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    protected $guarded = [];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function detail(){
        return $this->hasMany(DetailRetur::class, 'retur_id', 'id');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($retur) {
            $retur->detail()->delete();
        });
    }
}
