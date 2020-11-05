<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\ProductImage::class,100)->create();
        
        $faker = Faker::create();

        foreach (range(1, 1000) as $index)
        {
        	DB::table('product_images')->insert([
	            'img_title' => $faker->name,
	            'product_id' => App\Product::inRandomOrder()->first()->id,
	            'slug' => $faker->name,
                'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-3 years', 'now'),
        	]);
        }
    }
}
