<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'Admin').'_'.rand(1,100)),
            'name' => 'Admin',
            'description' => 'Nihusubu administrator account',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_types')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'User').'_'.rand(1,100)),
            'name' => 'User',
            'description' => 'Nihusubu user account',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
