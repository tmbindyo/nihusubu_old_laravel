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
        $this->call([AgricultureTypeTableSeeder::class]);
        // $this->call([IndustryTableSeeder::class]);
        $this->call([StatusTableSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([UserTypeTableSeeder::class]);
    }
}
