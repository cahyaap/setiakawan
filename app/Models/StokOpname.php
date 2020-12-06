<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    protected $guarded = [];

    public function detail()
    {
        return $this->hasMany(DetailStokOpname::class, 'stok_opname_id', 'id');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($stokOpname) {
             $stokOpname->detail()->delete();
        });
    }
}
