<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductCategory;
use Faker\Generator as Faker;


$factory->define(App\Product::class, function (Faker $faker) {
    return [
        	'product_name' => $this->faker->name,
            'product_desc' => $this->faker->sentence(5),
            'price' => $this->faker->randomDigit,
            'category_id' => $this->faker->App\ProductCategory::all()->random()->id,
            'slug' => $this->faker->name
    ];
});
