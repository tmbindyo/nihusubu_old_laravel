<?php

use Illuminate\Database\Seeder;

class RepeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('repeats')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Week',
            'number_of_days' => '7',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => 'fc8849a7-6abb-465e-9309-59f804f6684b',
            'name' => '2 Weeks',
            'number_of_days' => '14',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => 'cd7aa46f-0596-4dec-a00b-c22d69a68e44',
            'name' => 'Month',
            'number_of_days' => '30',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => '7872f51e-63d0-4862-a899-22ff78c0ee2b',
            'name' => '2 Months',
            'number_of_days' => '60',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => 'b6ff7bdc-3d76-4618-a8bf-a60eefa67af3',
            'name' => '3 Months',
            'number_of_days' => '90',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => '6ab683b8-a189-4ac4-a6c5-6921e2e93fe0',
            'name' => '6 Months',
            'number_of_days' => '180',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => 'e5b3f71f-8444-4a60-918d-808aeec11dac',
            'name' => '1 Year',
            'number_of_days' => '365',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => '8a925c96-3bb5-4034-9545-2c934f9efdbc',
            'name' => '2 Years',
            'number_of_days' => '730',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('repeats')->insert([
            'id' => '2e53e309-379b-46c7-9e75-2d3c3819b051',
            'name' => '3 Years',
            'number_of_days' => '1095',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
