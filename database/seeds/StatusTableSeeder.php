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
            'name' => 'Pending',
            'description' => 'Pending',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'Approved',
            'description' => 'Approved',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'Open',
            'description' => 'Open',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'Completed',
            'description' => 'Completed',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'Ongoing',
            'description' => 'Ongoing',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'Active',
            'description' => 'Active',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('statuses')->insert([
            'name' => 'Inactive',
            'description' => 'Inactive',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
