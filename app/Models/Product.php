<?php

namespace App\Models;


use Vanilo\Foundation\Models\Product as BaseProduct;

class Product extends BaseProduct
{
    protected $guarded = [];

    // App\Models\Product.php

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }


}

