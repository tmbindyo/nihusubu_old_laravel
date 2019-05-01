<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'Active').'_'.rand(1,100)),
            'name' => 'Active',
            'description' => 'Active',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'Inactive').'_'.rand(1,100)),
            'name' => 'Inactive',
            'description' => 'Inactive',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
