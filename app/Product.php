<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    
    protected $fillable = [
                            "product_name",
                            "product_desc",
                            "price",
                            "category_id",
                            "slug",
                            "status"
                           ];

    public function productCatagory()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }           

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

}
