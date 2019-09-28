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
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'business',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_types')->insert([
            'id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'name' => 'personal',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_types')->insert([
            'id' => '11ab9b8d-ec77-485b-a0c4-6e9140a83230',
            'name' => 'both',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
