<?php

use Illuminate\Database\Seeder;

class ExpenseTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expense_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Product',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('expense_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Investment',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // This includes farms,

        DB::table('expense_types')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Project',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
