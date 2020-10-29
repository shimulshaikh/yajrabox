<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(productCategorySeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
