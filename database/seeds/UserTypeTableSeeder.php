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
            'name' => 'Admin',
            'description' => 'Admin',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_types')->insert([
            'name' => 'User',
            'description' => 'User',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_types')->insert([
            'name' => 'Investor',
            'description' => 'Investor',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_types')->insert([
            'name' => 'Project Manager',
            'description' => 'project manager',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
