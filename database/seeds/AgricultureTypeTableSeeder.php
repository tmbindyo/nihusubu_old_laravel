<?php

use Illuminate\Database\Seeder;

class AgricultureTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agriculture_types')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'Industrialized Agriculture').'_'.rand(1,100)),
            'name' => 'Industrialized Agriculture',
            'description' => 'Industrialized Agriculture',
            'user_id' => 1,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('agriculture_types')->insert([
            'slug' => strtolower(str_replace(' ', '_', 'Subsistence Agriculture').'_'.rand(1,100)),
            'name' => 'Subsistence Agriculture',
            'description' => 'Subsistence Agriculture',
            'user_id' => 1,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
