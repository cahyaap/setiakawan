<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $guarded = [];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
