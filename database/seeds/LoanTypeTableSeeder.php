<?php

use Illuminate\Database\Seeder;

class LoanTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        DB::table('income_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Loaner',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('income_types')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Lonee',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
