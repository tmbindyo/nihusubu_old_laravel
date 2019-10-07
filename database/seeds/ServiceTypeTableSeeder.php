<?php

use Illuminate\Database\Seeder;

class ServiceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        DB::table('service_types')->insert([
            'id' => '0666f072-a597-4892-80b5-d019533b932a',
            'name' => 'business',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_types')->insert([
            'id' => 'fff5bab0-5c27-4d46-87f4-1705680d60aa',
            'name' => 'personal',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_types')->insert([
            'id' => '9be0c621-d96d-4fa0-9d1c-1e01006b20ec',
            'name' => 'both',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
