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

        //factory(App\Product::class,100)->create();
        
        $faker = Faker::create();

        foreach (range(1, 1000) as $index)
        {
        	DB::table('products')->insert([
	            'product_name' => $faker->name,
	            'product_desc' => $faker->sentence(5),
	            'price' => $faker->numberBetween(1000, 10000),
	            'category_id' => App\ProductCategory::inRandomOrder()->first()->id,
	            'slug' => $faker->name,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
        	]);
        }
    }
}
