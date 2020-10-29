<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(App\ProductCategory::class, function (Faker $faker) {
    return [
        	'brand_name' => $this->faker->company,
            'slug' => $this->faker->name
    ];
});
