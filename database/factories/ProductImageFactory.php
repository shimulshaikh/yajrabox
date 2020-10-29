<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductImage;
use App\Product;
use Faker\Generator as Faker;

$factory->define(App\ProductImage::class, function (Faker $faker) {
    return [
        	'img_title' => $this->faker->name,
            'product_id' => $this->faker->App\Product::all()->random()->id,
            'slug' => $this->faker->name
    ];
});
