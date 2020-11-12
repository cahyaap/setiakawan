<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function hutang(){
        return $this->hasOne(Hutang::class);
    }
}