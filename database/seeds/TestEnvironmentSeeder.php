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
            'description' => 'Test warehouse',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'is_primary' => True,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
