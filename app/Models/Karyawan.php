<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $guarded = [];

    public function absensi(){
        return $this->hasMany(Absensi::class, 'karyawan_id', 'id');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($karyawan) {
             $karyawan->absensi()->delete();
        });
    }
}
