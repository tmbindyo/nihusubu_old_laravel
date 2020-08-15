<?php

use Illuminate\Database\Seeder;

class UploadTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        DB::table('service_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'avatar',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

        DB::table('service_types')->insert([
            'id' => 'b2004522-e7aa-41dd-b033-7252d0a642b7',
            'name' => 'product',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

        DB::table('service_types')->insert([
            'id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'name' => 'file',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

        // tax methods
        DB::table('tax_methods')->insert([
            'id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'name' => 'Inclusive',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

        DB::table('tax_methods')->insert([
            'id' => 'b2004522-e7aa-41dd-b033-7252d0a642b7',
            'name' => 'Exclusive',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


    }
}
