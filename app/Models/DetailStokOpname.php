<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailStokOpname extends Model
{
    protected $guarded = [];

    public function stokOpname()
    {
        return $this->belongsTo(StokOpname::class, 'stok_opname_id');
    }
}
