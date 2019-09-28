<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        DB::table('services')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'To Do',
            'description' => 'To Do management.',
            'service_type_id' => '11ab9b8d-ec77-485b-a0c4-6e9140a83230',
            'service_type_pricing_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'id' => 'ccd75aba-0be6-4d09-9928-91d1dbb55a40',
            'name' => 'Accounting',
            'description' => 'Accounting management.',
            'service_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'service_type_pricing_id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'id' => '7d8740bc-3bb2-4209-b014-b94791c64a66',
            'name' => 'Product Management',
            'description' => 'Product management.',
            'service_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'service_type_pricing_id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'id' => '94edb615-211b-4b22-bb8d-4f654c19e239',
            'name' => 'Inventory Management',
            'description' => 'Inventory management.',
            'service_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'service_type_pricing_id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'id' => '6b981987-5cf4-4d0d-97a4-cb4446c6e8d2',
            'name' => 'Sales Management',
            'description' => 'Sales management.',
            'service_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'service_type_pricing_id' => '11ab9b8d-ec77-485b-a0c4-6e9140a83230',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'id' => '9ceae639-20c0-495e-ac31-fe23e39683ba',
            'name' => 'Expenses Management',
            'description' => 'Expenses management.',
            'service_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'service_type_pricing_id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'id' => 'b361c144-7d91-4f95-aa33-00df50fbb4b6',
            'name' => 'Project Management',
            'description' => 'Project management.',
            'service_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'service_type_pricing_id' => '11ab9b8d-ec77-485b-a0c4-6e9140a83230',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
