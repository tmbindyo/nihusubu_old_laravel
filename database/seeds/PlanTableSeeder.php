<?php

use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('plans')->insert([
            'id' => '03694a66-206d-4b19-8a89-42d96899b59d',
            'name' => 'Personal Finance',
            'description' => 'Personal Finance',
            'price' => '100',
            'plan_type_id' => 'a2e58e16-6578-4ca1-8058-b12a347fdc69',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

        DB::table('plans')->insert([
            'id' => '410f31ed-47be-4658-930a-a47f2839ebf5',
            'name' => 'Personal Finance',
            'description' => 'Personal Finance',
            'price' => '500',
            'plan_type_id' => '7dd05c3c-7526-498b-9fbb-d0c766a678ac',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

        DB::table('plans')->insert([
            'id' => '34ae6893-5329-46b4-99a9-3cde1367fb55',
            'name' => 'Personal Finance',
            'description' => 'Personal Finance',
            'price' => '900',
            'plan_type_id' => '7dd05c3c-7526-498b-9fbb-d0c766a678ac',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

    }
}
