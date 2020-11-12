<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function barang(){
        return $this->hasMany(Barang::class, 'kategori_id', 'id');
    }
}
