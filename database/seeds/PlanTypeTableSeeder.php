<?php

use Illuminate\Database\Seeder;

class PlanTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('plan_types')->insert([
            'id' => '7dd05c3c-7526-498b-9fbb-d0c766a678ac',
            'name' => 'Business',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

        DB::table('plan_types')->insert([
            'id' => 'a2e58e16-6578-4ca1-8058-b12a347fdc69',
            'name' => 'Personal',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

    }
}
