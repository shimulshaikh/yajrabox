<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "product_images";
    
    protected $fillable = [
                            "img_title",
                            "product_image",
                            "product_id",
                            "slug",
                            "status"
                           ];


    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
                           
}
