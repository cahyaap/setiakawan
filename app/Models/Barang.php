<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
