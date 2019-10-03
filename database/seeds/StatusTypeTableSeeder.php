<?php

use Illuminate\Database\Seeder;

class StatusTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'To Do',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //

        DB::table('status_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Product',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //

        DB::table('status_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Contact',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //

        DB::table('status_types')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Record',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // active, inactive

        DB::table('status_types')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Business',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //

        DB::table('status_types')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Inventory',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //

        DB::table('status_types')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Project Billing',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // Approved,
    }
}
