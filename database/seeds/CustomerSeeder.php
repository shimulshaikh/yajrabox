<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1000) as $index)
        {
        	DB::table('customers')->insert([
	            'customer_name' => $faker->name,
	            'email' => $faker->email,
	            'phone' => $faker->e164PhoneNumber,
                'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-3 years', 'now'),
        	]);
        }
    }
}
