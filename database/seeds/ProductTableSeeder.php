<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index)
        {
        	DB::table('products')->insert([
	            'product_name' => $faker->name,
	            'product_desc' => $faker->sentence(5),
	            'price' => $faker->randomDigit,
	            'category_id' => App\ProductCategory::inRandomOrder()->first()->id,
	            'slug' => $faker->name,
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
        	]);
        }
    }
}
