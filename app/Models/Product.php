<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->hasMany(Category::class, 'category_id');
    }

    public function brand(){
        return $this->hasMany(Brand::class, 'brand_id');
    }

}
