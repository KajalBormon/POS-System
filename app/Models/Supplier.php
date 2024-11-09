<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->hasMany(Purchase::class, 'purchase_id');
    }

    public function order(){
        return $this->hasMany(Purchase::class,'purchase_id');
    }
}
