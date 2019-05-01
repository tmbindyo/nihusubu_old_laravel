<?php

use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('genders')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'Male').'_'.rand(1,100)),
            'name' => 'Male',
            'description' => 'Male',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('genders')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'Female').'_'.rand(1,100)),
            'name' => 'Female',
            'description' => 'Female',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
