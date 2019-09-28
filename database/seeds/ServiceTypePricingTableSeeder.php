<?php

use Illuminate\Database\Seeder;

class ServiceTypePricingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        DB::table('service_type_pricings')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Free',
            'description' => 'Free for all.',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_type_pricings')->insert([
            'id' => '49ff607b-257a-4289-aaed-4deb03f6edc6',
            'name' => 'Standard',
            'description' => 'Standard fee.',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_type_pricings')->insert([
            'id' => '11ab9b8d-ec77-485b-a0c4-6e9140a83230',
            'name' => 'Dependent',
            'description' => 'Dependent on number of users.',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_type_pricings')->insert([
            'id' => '8d99fc4f-2104-4290-98b2-16ee52b18509',
            'name' => 'Complimentary free',
            'description' => 'Complimentary if one pays for another.',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('service_type_pricings')->insert([
            'id' => 'af8e9886-f2ff-42c2-bbf8-406e20759453',
            'name' => 'Complimentary discounted',
            'description' => 'Complimentary discounted if one pays for another.',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
