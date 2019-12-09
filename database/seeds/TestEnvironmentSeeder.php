<?php

use Illuminate\Database\Seeder;

class TestEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Units
        DB::table('units')->insert([
            'id' => 'ee731ec9-2d3a-4f5b-a58f-c67c6b591855',
            'name' => 'ML',
            'description' => 'Millilitres',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('units')->insert([
            'id' => '049c14ed-5ab2-46b6-898f-d4011f7ae450',
            'name' => 'Litre',
            'description' => 'Litres',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('units')->insert([
            'id' => 'aca0bd83-d861-4f7b-932f-28f412836e0e',
            'name' => 'Dozen',
            'description' => '12 items in product',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('units')->insert([
            'id' => 'de63c87d-98cb-4c5b-b40a-a16fcbd01853',
            'name' => 'KG',
            'description' => 'Kilograms',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Taxes
        DB::table('taxes')->insert([
            'id' => '661e9884-37d4-4401-a408-ce5fac44a022',
            'name' => 'VAT',
            'amount' => '16',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'is_percentage' => True,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('taxes')->insert([
            'id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',
            'name' => 'Catering Levy',
            'amount' => '6',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'is_percentage' => True,
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('warehouses')->insert([
            'id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',
            'name' => 'Test',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'address_id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',
            'user_id' => 1,
            'is_primary' => True,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('addresses')->insert([
            'id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',

            'email' => 'warehouse@nihusubu.com',
            'phone_number' => '0708085128',
            'town' => 'Nairobi',
            'po_box' => '73919',
            'postal_code' => '00100',
            'address_line_1' => 'General Accident Houses, 2nd Floor',
            'address_line_2' => 'Woodley',
            'street' => 'Ralph Bunche Road',

            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'address_type_id' => 'f7e388be-1eaa-4acc-9929-daf50bb0b5d1',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);




        DB::table('payment_terms')->insert([
            'id' => '953af05b-8bae-4d71-a0d0-0a83cffa9366',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 15',
            'number_of_days' => '15',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'e6cfeee5-42cd-4a4d-afed-6d117f61ca4a',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 30',
            'number_of_days' => '30',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '08edaea3-39be-49f1-9ce7-ccd1c91ea493',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 45',
            'number_of_days' => '45',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'a0fecc93-877e-4f04-a1e0-f2af7d960172',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 60',
            'number_of_days' => '60',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '41e5bd3e-6a90-4759-976f-f8f5a00d7c28',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due End Of Month',
            'number_of_days' => '0',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'b3bf096e-0f21-474e-9e1d-3b0566dd3e6e',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due End Of Next Month',
            'number_of_days' => '0',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '7f59d7eb-fdb4-480f-ae07-b1e74fe1af37',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due On Receipt',
            'number_of_days' => '0',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
