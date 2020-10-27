<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "product_categories";
    
    protected $fillable = ["brand_name","slug","status"];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
