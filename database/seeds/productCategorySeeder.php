<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class productCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\ProductCategory::class,1000)->create();
        
        $faker = Faker::create();

        foreach (range(1, 5) as $index)
        {
        	DB::table('product_categories')->insert([
	            'brand_name' => $faker->company,
	            'slug' => $faker->name,
                'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-3 years', 'now'),
        	]);
        }
    }
}
